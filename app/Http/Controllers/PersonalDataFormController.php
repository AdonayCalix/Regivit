<?php

namespace App\Http\Controllers;

use App\Campus;
use App\PersonalData;
use Illuminate\Http\Request;
use App\Http\Requests\PersonalDataRequest;
use Illuminate\Support\Facades\DB;
use App\GeneralData;
use App\CivilStatus;
use App\User;
use App\JobApplication;
use App\ParihPriest;
use App\Parish;
use Carbon\Carbon;
use App\Dependent;

class PersonalDataFormController extends Controller
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
        $dependets = $this->getDependet();

        return view('candidate.datos_personales', compact('values', 'degree_education', 'campus', 'dependets'));
    }

    public function store(PersonalDataRequest $request)
    {
        if ($request->ajax()) {
            $personal_data = new PersonalData;
            $personal_data->current_position = $request->current_position;
            $personal_data->personal_school_number = $request->personal_school_number;
            $personal_data->driver_license = $request->driver_license;
            $personal_data->job_card = $request->job_card;
            $personal_data->campus_job = $request->campus_id;
            $personal_data->bamer_account_numer = $request->bamer_account_number;
            $personal_data->spouse_name = $request->spouse_name;
            $personal_data->emergency = $request->emergency;
            $personal_data->emergency_number = $request->emergency_number;
            $personal_data->signature_path = $this->saveSignature($request->signature_path);
            $personal_data->vehiculo = $request->has_car;
            $personal_data->marca_vehiculo = $request->marca;
            $personal_data->modelo_vehiculo = $request->modelo;
            $personal_data->anio_vehiculo = $request->anio;
            $personal_data->postgrado = $request->postgrade_education;
            $personal_data->telefono_casa = $request->telefono_casa;
            $personal_data->telefono_oficina = $request->telefono_oficina;
            $personal_data->telefono_otro = $request->telefono_otro;
            $personal_data->general_data_id = $this->getGeneralDataId();
            $status = $personal_data->save();

            for ($i = 0; $i < 3; $i++) {
                $dependent = Dependent::where('general_data_id', $this->getGeneralDataId())
                    ->update([
                       'birthdate' => $request->input('fecha_nacimiento_parentesco')[$i]
                    ]);
                $status = true;
            }

            return response()->json(['status' => $status]);
        }
    }

    public function getGeneralDataId()
    {
        return DB::table('general_data')
            ->where('users_id', '=', auth()->user()->id)
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

    public function getDependet()
    {
        return DB::table('general_data')
            ->join('dependents', 'general_data.id', '=', 'dependents.general_data_id')
            ->where('general_data.users_id', '=', auth()->user()->id)
            ->select('dependents.name', 'dependents.relationship')
            ->get();
    }
}
