<?php

namespace App\Http\Controllers;

use App\Campus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return view('candidate.vista_datos_personales', compact('values', 'degree_education', 'campus', 'personal_datas', 'dependents'));
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

}
