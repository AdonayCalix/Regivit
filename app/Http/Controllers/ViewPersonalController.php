<?php

namespace App\Http\Controllers;

use App\Campus;
use App\Http\Requests\PersonalDataRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\PersonalData;

class ViewPersonalController extends Controller
{
    public function index()
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
        return view('candidate.vista_datos_personales', compact('values', 'degree_education', 'campus', 'personal_datas', 'dependents', 'path_personal_data_form'));
    }

    public function store(PersonalDataRequest $request)
    {
        if ($request->ajax()) {
            $personal_data = PersonalData::where('general_data_id', $this->getGeneralId())
                ->update([
                    'current_position' => $request->current_position,
                    'personal_school_number' => $request->personal_school_number,
                    'driver_license' => $request->driver_license,
                    'job_card' => $request->job_card,
                    'campus_job' => $request->campus_id,
                    'bamer_account_numer' => $request->bamer_account_number,
                    'spouse_name' => $request->spouse_name,
                    'emergency' => $request->emergency,
                    'emergency_number' => $request->emergency_number,
                    'vehiculo' => $request->has_car,
                    'marca_vehiculo' => $request->marca,
                    'modelo_vehiculo' => $request->modelo,
                    'anio_vehiculo' => $request->anio,
                    'postgrado' => $request->postgrade_education,
                    'telefono_casa' => $request->telefono_casa,
                    'telefono_oficina' => $request->telefono_oficina,
                    'telefono_otro' => $request->telefono_otro,
                    'admission_date' => $request->admission_date,
                    'signature_path' => $this->saveSignature($request->signature_path)
                ]);

            return response()->json(['status' => true]);

        }
    }

    public function getGeneralId()
    {
        return DB::table('general_data')
            ->where('users_id', auth()->user()->id)
            ->value('id');
    }

    public function getEducation()
    {
        return DB::table('job_application')
            ->join('general_data', 'general_data.id', '=', 'job_application.general_data_id')
            ->join('education', 'education.job_application_id', '=', 'job_application.id')
            ->where('general_data.users_id', '=', auth()->user()->id)
            ->select('level', 'degree')
            ->get();
    }

    public function getPersonalData()
    {
        return DB::table('general_data')
            ->join('job_application', 'job_application.general_data_id', '=', 'general_data.id')
            ->join('personal_data', 'personal_data.general_data_id', '=', 'general_data.id')
            ->where('general_data.users_id', '=', auth()->user()->id)
            ->get();
    }

    public function getDependents()
    {
        return DB::table('general_data')
            ->join('dependents', 'general_data.id', '=', 'dependents.general_data_id')
            ->where('general_data.users_id', auth()->user()->id)
            ->get();
    }

    public function error()
    {
        return view('candidate.error_personal_data');
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
            ->where('name', '=', 'Ficha de datos personales RG-RH.120')
            ->value('id');
    }

    public function getPathPersonalData($id_personal_data_form)
    {
        return DB::table('users_documents')
            ->where('users_id', '=', auth()->user()->id)
            ->where('document_id', '=', $id_personal_data_form)
            ->value('path');
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

}
