<?php

namespace App\Http\Controllers;

use App\Revision;
use App\Campus;
use Illuminate\Http\Request;
use App\UserDocument;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class ScreenFormController extends Controller
{
    public function savePersonalData(Request $request)
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
            $revision->form = 2;
            $revision->status = 1;
            $revision->users_id = auth()->user()->id;
            return response()->json(['status' => $revision->save()]);
        }
    }

    public function validateIfExit()
    {
        $validate = DB::table('revision')
            ->where('users_id', '=', auth()->user()->id)
            ->where('form', '=', 2)
            ->where('status', '=', 1)
            ->get();
        return response()->json(['status' => $validate->isNotEmpty()]);
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
            ->where('name', '=', 'Ficha de datos personales RG-RH.120')
            ->value('id');
    }

    public function getPathExit($document_id)
    {
        return DB::table('users_documents')
            ->where('users_id', '=', auth()->user()->id)
            ->where('document_id', '=', $document_id)
            ->value('path');
    }

    public function validateFile()
    {
        return DB::table('revision')
            ->where('users_id', '=', auth()->user()->id)
            ->where('form', '=', 2)
            ->where('status', '=', 1)
            ->get();
    }

    public function createExcel()
    {
        $result = DB::select('select general_data.*, civil_status.descripcion as \'civil_status\', parish.name as \'parish\', parish_priest.name as \'priest\'' .
            'from general_data, ' .
            'civil_status, ' .
            'parish, ' .
            'parish_priest ' .
            'where general_data.civil_status_id = civil_status.id ' .
            'and general_data.parish_id = parish.id ' .
            'and general_data.priest_id = parish_priest.id ' .
            'and general_data.users_id = ?', [auth()->user()->id]);
        $values = json_decode(json_encode($result), true);
        $degree_education = $this->getEducation();
        $campus = Campus::all();
        $personal_datas = $this->getPersonalData();
        $dependents = $this->getDependents();
        $path_personal_data_form = $this->getPathPersonalData($this->getIdJobFormDocuments($this->getIdCoordinator()));

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(public_path('excel/FichaDatosPersonales.xlsx'));

        $sheet = $spreadsheet->getActiveSheet();
        foreach ($personal_datas as $personal_data) {
            foreach ($values as $value) {
                $sheet->setCellValue('F6', $personal_data->current_position);

                $sheet->setCellValue('B8', auth()->user()->first_name);
                $sheet->setCellValue('J8', auth()->user()->second_name);
                $sheet->setCellValue('T8', auth()->user()->first_surname);
                $sheet->setCellValue('AA8', auth()->user()->second_surname);
                switch ($value['civil_status']) {
                    case 'Soltero (a)':
                        $sheet->setCellValue('L11', 'X');
                        break;
                    case 'Casado (a)':
                        $sheet->setCellValue('R11', 'X');
                        break;
                    case 'Union libre':
                        $sheet->setCellValue('Y11', 'X');
                        break;
                    case 'Viuda':
                        $sheet->setCellValue('AF11', 'X');
                        break;
                    default:
                        break;
                }

                $sheet->setCellValue('F13', auth()->user()->identity);

                $fecha = explode('/', $value['birthdate']);
                $sheet->setCellValue('V13', $fecha[2]);
                $sheet->setCellValue('AA13', $fecha[1]);
                $sheet->setCellValue('AE13', $fecha[0]);

                $sheet->setCellValue('H16', $value['address']);
                $sheet->setCellValue('V17', auth()->user()->email);
                $sheet->setCellValue('H18', $personal_data->telefono_casa);
                $sheet->setCellValue('S18', $personal_data->telefono_oficina);
                $sheet->setCellValue('AB18', $personal_data->telefono_otro);

                foreach ($degree_education as $degree) {
                    switch ($degree->level) {
                        case 'Primaria':
                            $sheet->setCellValue('M22', $degree->degree);
                            break;
                        case 'Secundaria':
                            $sheet->setCellValue('X22', $degree->degree);
                            break;
                        case 'Universitaria':
                            $sheet->setCellValue('G23', $degree->degree);
                            break;
                        default:
                            break;
                    }
                }

                $sheet->setCellValue('X23', $personal_data->postgrado);
                $sheet->setCellValue('X23', $personal_data->postgrado);
                $sheet->setCellValue('D24', $value['ihss']);
                $sheet->setCellValue('V24', $value['rap']);
                $sheet->setCellValue('N25', $personal_data->personal_school_number);
                $sheet->setCellValue('J26', $personal_data->driver_license);
                $sheet->setCellValue('J26', $personal_data->driver_license);
                $sheet->setCellValue('O27', $personal_data->job_card);
                $sheet->setCellValue('H28', $personal_data->admission_date);
                $sheet->setCellValue('I29', $personal_data->bamer_account_numer);

                foreach ($campus as $campu) {
                    $sheet->setCellValue('K30', $campu->name);
                }

                if ($personal_data->vehiculo === 1) {
                    $sheet->setCellValue('J32', 'X');
                } else {
                    $sheet->setCellValue('M32', 'X');
                }

                $sheet->setCellValue('R32', $personal_data->marca_vehiculo);
                $sheet->setCellValue('Z32', $personal_data->modelo_vehiculo);
                $sheet->setCellValue('AF32', $personal_data->anio_vehiculo);

                $sheet->setCellValue('J33', $personal_data->spouse_name);
                $sheet->setCellValue('N34', $personal_data->emergency);
                $sheet->setCellValue('C35', $personal_data->emergency_number);
                $sheet->setCellValue('L36', $value['parish']);
                $sheet->setCellValue('J37', $value['priest']);
                $sheet->setCellValue('AA37', $value['catholic_movement']);

                $contador = 40;
                foreach ($dependents as $dependent) {
                    $sheet->setCellValue('B' . $contador, $dependent->name);
                    $sheet->setCellValue('N' . $contador, $dependent->relationship);
                    $sheet->setCellValue('Y' . $contador, $dependent->birthdate);
                    $contador++;
                }

                $sheet->setCellValue('U50', Carbon::now()->format('d-m-Y'));

                $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                $drawing->setName('Firma');
                $drawing->setDescription('Firma');
                $drawing->setPath(public_path('uploades/' . $personal_data->signature_path));
                $drawing->setHeight('100');
                $drawing->setWidth('252');
                $drawing->setCoordinates('B47');
                $drawing->setWorksheet($sheet);
            }

            $path = uniqid() . auth()->user()->id;
            $writer = new Xlsx($spreadsheet);
            $writer->save(public_path('uploades/' . $path) . '.xlsx');

            return $path . '.xlsx';
        }
    }

    public
    function getGeneralDataId()
    {
        return DB::table('general_data')
            ->where('users_id', '=', auth()->user()->id)
            ->value('id');
    }

    public function getIdCoordinator()
    {
        return DB::table('users_faculties')
            ->where('users_id', auth()->user()->id)
            ->value('coordinator_id');
    }

    public
    function getEducation()
    {
        return DB::table('job_application')
            ->join('general_data', 'general_data.id', '=', 'job_application.general_data_id')
            ->join('education', 'education.job_application_id', '=', 'job_application.id')
            ->where('general_data.users_id', '=', auth()->user()->id)
            ->select('level', 'degree')
            ->get();
    }

    public
    function getPersonalData()
    {
        return DB::table('general_data')
            ->join('job_application', 'job_application.general_data_id', '=', 'general_data.id')
            ->join('personal_data', 'personal_data.general_data_id', '=', 'general_data.id')
            ->where('general_data.users_id', '=', auth()->user()->id)
            ->get();
    }

    public
    function getDependents()
    {
        return DB::table('general_data')
            ->join('dependents', 'general_data.id', '=', 'dependents.general_data_id')
            ->where('general_data.users_id', auth()->user()->id)
            ->get();
    }


    public
    function getIdJobFormDocuments($coordinador_id)
    {
        return DB::table('documents')
            ->where('users_id', '=', $coordinador_id)
            ->where('name', '=', 'Ficha de datos personales RG-RH.120')
            ->value('id');
    }

    public
    function getPathPersonalData($id_personal_data_form)
    {
        return DB::table('users_documents')
            ->where('users_id', '=', auth()->user()->id)
            ->where('document_id', '=', $id_personal_data_form)
            ->value('path');
    }
}
