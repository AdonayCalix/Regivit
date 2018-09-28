<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Blood;
use App\CivilStatus;
use App\Competence;
use App\Dependent;
use App\Education;
use App\ExperienceJob;
use App\GeneralData;
use App\JobApplication;
use App\Knowledge;
use App\ParihPriest;
use App\Parish;
use App\Reference;
use App\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Http\Requests\JobFormRequest;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ViewJobFormController extends Controller
{
    public function index()
    {
        $status_civil = CivilStatus::all();
        $bloods = Blood::all();
        $parishes = Parish::all();
        $priests = ParihPriest::all();
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
        $path_siganture = $this->getPathSignature($general_id);
        $path_job_form = $this->getPathJobForm($this->getIdJobFormDocuments($this->getIdCoordinator()));
        $this->createExcel();
        return view('candidate.vista_solicitud_empleo', compact('job_applications', 'educations',
            'competences', 'references', 'knowledges', 'skills', 'economics', 'experiences_job', 'activities', 'path_siganture', 'path_job_form', 'id_education',
            'status_civil', 'bloods', 'parishes', 'priests'));
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

    //UPDATE JOB FORM X(

    public function store(JobFormRequest $request)
    {
        if ($request->ajax()) {
            $general_data = GeneralData::where('id', $this->getGeneralDataId())
                ->update([
                    'address' => $request->address,
                    'nationality' => $request->nationality,
                    'ihss' => $request->ihss,
                    'rap' => $request->rap,
                    'birthdate' => $request->birthdate,
                    'catholic_movement' => $request->catholic_movement,
                    'users_id' => auth()->user()->id,
                    'civil_status_id' => $request->civil_status,
                    'parish_id' => $request->parish,
                    'priest_id' => $request->priest
                ]);

            $job_application = JobApplication::where('general_data_id', $this->getGeneralDataId())
                ->update([
                    'age' => $request->age,
                    'pastoral_activity' => $request->pastoral_activity,
                    'family_university' => $request->family_university,
                    'minimum_salary' => $request->minimun_salary,
                    'married_surname' => $request->married_surname,
                    'aspire_position' => $request->aspire_position,
                    'general_data_id' => $this->getGeneralDataId(),
                    'blood_id' => $request->blood,
                    'place_date' => $request->place_date,
                    'telefono' => $request->telefono,
                    'celular' => $request->celular,
                    'signature_path' => $this->saveSignature($request->signature_paht)
                ]);

            $job_form_id = $this->getJobFormId($this->getGeneralDataId());

            $id_education = DB::table('education')->where('job_application_id', $job_form_id)->get()->toArray();
            foreach ($id_education as $index => $value) {
                $education = Education::where('id', $value->id)
                    ->update([
                        'time_education' => $request->input('education_years')[$index],
                        'school_name' => $request->input('education_school_name')[$index],
                        'degree' => $request->input('education_degree')[$index],
                        'level' => ($index + 1)
                    ]);
            }

            $skills = DB::table('skills')->where('job_application_id', $job_form_id)->get()->toArray();
            foreach ($skills as $index => $value) {
                $skill = Skill::where('id', $value->id)
                    ->update([
                        'description' => $request->input('skill')[$index]
                    ]);
            }

            $competences = DB::table('competencies')->where('job_application_id', $job_form_id)->get()->toArray();
            foreach ($competences as $index => $value) {
                $competence = Competence::where('job_application_id', $value->id)
                    ->update([
                        'description' => $request->input('competence')[$index],
                    ]);
            }

            $knowledges = DB::table('knowledges')->where('job_application_id', $job_form_id)->get()->toArray();
            foreach ($knowledges as $index => $value) {
                $knowledge = Knowledge::where('job_application_id', $value->id)
                    ->update([
                        'description' => $request->input('knowledge')[$index],
                    ]);
            }

            $references = DB::table('references')->where('job_application_id', $job_form_id)->get()->toArray();
            foreach ($references as $index => $value) {
                $reference = Reference::where('job_application_id', $value->id)
                    ->update([
                        'name' => $request->input('reference_name')[$index],
                        'relationship' => $request->input('reference_relationship')[$index],
                        'address' => $request->input('reference_address')[$index],
                        'number' => $request->input('reference_number')[$index],
                    ]);
            }

            $experience = ExperienceJob::where('job_application_id', $job_form_id)
                ->update([
                    'company_name' => $request->company_name,
                    'position' => $request->position,
                    'experience_age' => $request->worked_years,
                ]);

            $experience_id = $this->getActivitiesId($this->getExperienceJobId($job_form_id));

            foreach ($experience_id as $index => $value) {
                $activity = Activity::where('id', $value->id)
                    ->update([
                        'description' => $request->input('activity')[$index],
                    ]);
            }

            $dependets = DB::table('dependents')->where('general_data_id', '=', $this->getGeneralDataId())->get()->toArray();
            foreach ($dependets as $index => $value) {
                $dependent = Dependent::where('id', $value->id)
                    ->update([
                        'name' => $request->input('dependent_name')[$index],
                        'address' => $request->input('dependent_address')[$index],
                        'relationship' => $request->input('dependent_relationship')[$index],
                        'age' => $request->input('dependent_age')[$index]
                    ]);
            }
            return response()->json(['status' => true]);
        }
    }

    public function saveSignature($data_uri)
    {
        try {
            $encoded_image = explode(",", $data_uri)[1];
            $decoded_image = base64_decode($encoded_image);
            $file_name = mt_rand() . time() . auth()->user()->id . '.png';
            file_put_contents(public_path() . '/uploades/' . $file_name, $decoded_image);
        } catch (\Exception $e) {
            return 'No ok';
        }
        return $file_name;
    }

    public static function getGeneralData()
    {
        return DB::table('general_data')
            ->where('users_id', '=', auth()->user()->id)
            ->value('id');
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
                if($contador < 57) {
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
                if($contador > 68) {
                    $sheet->setCellValue('B' . $contador, $knowledge->description);
                    $sheet->setCellValue('H' . $contador, $knowledge->description);
                }
                $contador++;
            }

            $contador = 71;
            foreach ($skills as $skill) {
                if($contador > 73) {
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
            $sheet->setCellValue('A106',Carbon::now()->format('d \d\e m \d\e\l Y'));

        }

        $writer = new Xlsx($spreadsheet);
        $writer->save(public_path('uploades/' . uniqid() . auth()->user()->id) . '.xlsx');
    }
}
