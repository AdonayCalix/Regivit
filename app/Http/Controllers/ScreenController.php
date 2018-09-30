<?php

namespace App\Http\Controllers;

use App\Revision;
use Illuminate\Http\Request;
use App\UserDocument;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ScreenController extends Controller
{
    public function saveJobForm(Request $request)
    {
        $result = $this->validateFile();
        if ($result->isNotEmpty()) {
            $document_id = $this->findJobFormId($this->findCoordinatorId());
            $id = DB::table('users_documents')
                ->where('document_id', '=', $document_id)
                ->where('users_id', '=', auth()->user()->id)
                ->value('id');
            $path = $this->getPathExit($document_id);
            $user_document = UserDocument::where('id', $id)
                ->update([
                    'path' => $this->createExcel()
                ]);
            File::delete(public_path('/uploades/' . $path));

            return response()->json(['status' => true]);

        } else {
            $user_document = new UserDocument;
            $user_document->document_id = $this->findJobFormId($this->findCoordinatorId());
            $user_document->users_id = auth()->user()->id;
            $user_document->path = $this->createExcel();
            $user_document->status = 1;
        }

        if ($user_document->save()) {
            $revision = new Revision;
            $revision->form = 1;
            $revision->status = 1;
            $revision->users_id = auth()->user()->id;
            return response()->json(['status' => $revision->save()]);
        }
    }

    public function validateIfExit()
    {
        $validate = DB::table('revision')
            ->where('users_id', '=', auth()->user()->id)
            ->where('form', '=', 1)
            ->where('status', '=', 1)
            ->get();
        return response()->json(['status' => $validate->isNotEmpty()]);
    }

    public function validateFile()
    {
        return DB::table('revision')
            ->where('users_id', '=', auth()->user()->id)
            ->where('form', '=', 1)
            ->where('status', '=', 1)
            ->get();
    }

    public function findCoordinatorId()
    {
        return DB::table('users_faculties')
            ->where('users_id', '=', auth()->user()->id)
            ->value('coordinator_id');
    }

    public function findJobFormId($coordinator_id)
    {
        return DB::table('documents')
            ->where('users_id', '=', $coordinator_id)
            ->where('name', '=', 'Solicitud de empleo REG-RH.102')
            ->value('id');
    }

    public function getPathExit($document_id)
    {
        return DB::table('users_documents')
            ->where('users_id', '=', auth()->user()->id)
            ->where('document_id', '=', $document_id)
            ->value('path');
    }

    public function createExcel()
    {
        $general_id = $this->getGeneralDataId();
        $job_application = $this->getJobFormId($general_id);
        $educations = $this->getEducation($job_application);
        $references = $this->getReferences($job_application);
        $competences = $this->getCompetences($job_application);
        $knowledges = $this->getKnowledges($job_application);
        $skills = $this->getSkill($job_application);
        $job_applications = $this->getJobForm();
        $economics = $this->getEconomics($general_id);
        $experiences_job = $this->getExperienceJob($job_application);
        $experiences_job_id = $this->getExperienceJobId($job_application);
        $activities = $this->getActivities($experiences_job_id);

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(public_path('excel/SolicitudEmpleo.xlsx'));

        $sheet = $spreadsheet->getActiveSheet();
        foreach ($job_applications as $item) {
            $sheet->setCellValue('C8', $item->aspire_position);
            $sheet->setCellValue('A14', auth()->user()->first_surname);
            $sheet->setCellValue('D14', auth()->user()->second_surname);
            $sheet->setCellValue('G14', auth()->user()->first_name);
            $sheet->setCellValue('J14', auth()->user()->second_name);
            $sheet->setCellValue('B20', $item->telefono);
            $sheet->setCellValue('E20', $item->celular);
            $sheet->setCellValue('H20', auth()->user()->email);
            $sheet->setCellValue('H20', auth()->user()->email);
            $sheet->setCellValue('A22', 'Honduras');
            $sheet->setCellValue('D22', $item->civil_status);
            $sheet->setCellValue('G22', $item->age);
            $sheet->setCellValue('J22', auth()->user()->identity);
            $sheet->setCellValue('A25', $item->birthdate);
            $sheet->setCellValue('D25', $item->ihss);
            $sheet->setCellValue('G25', $item->rap);
            $sheet->setCellValue('J25', $item->blood_type);
            $sheet->setCellValue('A29', $item->parish_name);
            $sheet->setCellValue('H29', $item->priest_name);
            $sheet->setCellValue('F32', $item->catholic_movement);

            if ($item->pastoral_activity == 1) {
                $sheet->setCellValue('D35', 'X');
            } else {
                $sheet->setCellValue('G35', 'X');
            }
            if ($item->family_university == 1) {
                $sheet->setCellValue('D38', 'X');
            } else {
                $sheet->setCellValue('G38', 'X');
            }

            $contador = 44;
            foreach ($references as $reference) {
                $sheet->setCellValue('A' . $contador, $reference->name);
                $sheet->setCellValue('E' . $contador, $reference->address);
                $sheet->setCellValue('I' . $contador, $reference->relationship);
                $sheet->setCellValue('K' . $contador, $reference->number);
                $contador++;
            }

            $contador = 54;
            foreach ($competences as $competence) {
                if ($contador < 57) {
                    $sheet->setCellValue('B' . $contador, $competence->description);
                    $sheet->setCellValue('H' . $contador, $competence->description);
                }
                $contador++;
            }

            foreach ($educations as $education) {
                if ($education->level == 'Primaria') {
                    $sheet->setCellValue('C61', $education->time_education);
                    $sheet->setCellValue('E61', $education->school_name);
                    $sheet->setCellValue('I61', $education->degree);
                }
                if ($education->level == 'Secundaria') {
                    $sheet->setCellValue('C62', $education->time_education);
                    $sheet->setCellValue('E62', $education->school_name);
                    $sheet->setCellValue('I62', $education->degree);
                }
                if ($education->level == 'Universitaria') {
                    $sheet->setCellValue('C63', $education->time_education);
                    $sheet->setCellValue('E63', $education->school_name);
                    $sheet->setCellValue('I63', $education->degree);
                }
            }

            $contador = 66;
            foreach ($knowledges as $knowledge) {
                if ($contador < 69) {
                    $sheet->setCellValue('B' . $contador, $knowledge->description);
                    $sheet->setCellValue('H' . $contador, $knowledge->description);
                }
                $contador++;
            }

            $contador = 71;
            foreach ($skills as $skill) {
                if ($contador < 74) {
                    $sheet->setCellValue('B' . $contador, $skill->description);
                    $sheet->setCellValue('H' . $contador, $skill->description);

                }
                $contador++;
            }

            foreach ($experiences_job as $experience) {
                $sheet->setCellValue('A78', $experience->company_name);
                $sheet->setCellValue('D78', $experience->position);
                $sheet->setCellValue('D78', $experience->experience_age);
            }

            $contador = 78;
            foreach ($activities as $activity) {
                $sheet->setCellValue('H' . $contador, $activity->description);
                $contador++;
            }

            $contador = 93;
            foreach ($economics as $economic) {
                $sheet->setCellValue('A' . $contador, $economic->name);
                $sheet->setCellValue('D' . $contador, $economic->relationship);
                $sheet->setCellValue('F' . $contador, $economic->age);
                $sheet->setCellValue('H' . $contador, $economic->address);
                $contador++;
            }

            $sheet->setCellValue('E96', $item->minimum_salary);
            $sheet->setCellValue('A102', 'La Ceiba Atlantida ' . Carbon::now()->format('d \d\e m \d\e\l Y'));

            if ($item->signature_path !== 'No Ok') {
                $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                $drawing->setName('Firma');
                $drawing->setDescription('Firma');
                $drawing->setPath(public_path('uploades/' . $item->signature_path));
                $drawing->setHeight('100');
                $drawing->setWidth('252');
                $drawing->setCoordinates('H98');
                $drawing->setWorksheet($sheet);
            }
        }

        $path = uniqid() . auth()->user()->id;
        $writer = new Xlsx($spreadsheet);
        $writer->save(public_path('uploades/' . $path) . '.xlsx');

        return $path . '.xlsx';
    }
    public function getGeneralDataId()
    {
        return DB::table('general_data')
            ->where('users_id', '=', auth()->user()->id)
            ->value('id');
    }

    public function getJobFormId($general_data_id)
    {
        return DB::table('job_application')
            ->where('general_data_id', '=', $general_data_id)
            ->value('id');
    }

    public function getEducation($job_applicaton_id)
    {
        return DB::table('education')->where('job_application_id', $job_applicaton_id)->get();
    }

    public function getCompetences($job_applicaton_id)
    {
        return DB::table('competencies')->where('job_application_id', $job_applicaton_id)->get();
    }

    public function getKnowledges($job_applicaton_id)
    {
        return DB::table('knowledges')->where('job_application_id', $job_applicaton_id)->get();
    }

    public function getReferences($job_applicaton_id)
    {
        return DB::table('references')->where('job_application_id', $job_applicaton_id)->get();
    }

    public function getSkill($job_applicaton_id)
    {
        return DB::table('skills')->where('job_application_id', $job_applicaton_id)->get();
    }

    public function getEconomics($general_data)
    {
        return DB::table('dependents')
            ->where('general_data_id', $general_data)
            ->get();

    }

    public function getExperienceJob($job_application)
    {
        return DB::table('experiences_job')
            ->where('job_application_id', $job_application)
            ->get();
    }

    public function getExperienceJobId($job_application)
    {
        return DB::table('experiences_job')
            ->where('job_application_id', $job_application)
            ->value('id');
    }

    public function getActivities($experiences_job_id)
    {
        return DB::table('activities')
            ->where('experiences_job_id', $experiences_job_id)
            ->get();
    }

    public function getPathSignature($general_id)
    {
        return DB::table('job_application')
            ->where('general_data_id', $general_id)
            ->value('signature_path');
    }

    public function getIdCoordinator()
    {
        return DB::table('users_faculties')
            ->where('users_id', auth()->user()->id)
            ->value('coordinator_id');
    }

    public function getIdJobFormDocuments($coordinador_id)
    {
        return DB::table('documents')
            ->where('users_id', '=', $coordinador_id)
            ->where('name', '=', 'Solicitud de empleo REG-RH.102')
            ->value('id');
    }

    public function getPathJobForm($id_job_form)
    {
        return DB::table('users_documents')
            ->where('users_id', '=', auth()->user()->id)
            ->where('document_id', '=', $id_job_form)
            ->value('path');
    }

    public function getExperiencesJobId($job_application_id)
    {
        return DB::table('experiences_job')
            ->where('job_application_id', '=', $job_application_id)
            ->value('id');
    }

    public function getActivitiesId($experiences_id)
    {
        return DB::table('activities')
            ->where('experiences_job_id', $experiences_id)
            ->get()
            ->toArray();
    }

    public function getJobForm()
    {
        return DB::select("
            select job_application.*, general_data.*, blood.description as blood_type, blood.id as tipo_sangre, 
              civil_status.descripcion as civil_status, civil_status.id as tipo_estado_civil, parish.name as parish_name, parish.id as id_parish,
              parish_priest.name as priest_name, parish_priest.id as id_parish_priest
        from users,
            general_data,
            job_application,
            civil_status,
            blood,
            parish_priest,
            parish
        where general_data.users_id = users.id
              and general_data.civil_status_id = civil_status.id
              and general_data.priest_id = parish_priest.id
              and general_data.parish_id = parish.id
              and general_data.id = job_application.general_data_id
              and job_application.blood_id = blood.id
              and users.id = ?;
        ", [auth()->user()->id]);
    }
}
