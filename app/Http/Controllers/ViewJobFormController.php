<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class ViewJobFormController extends Controller
{
    public function index()
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
        $path_siganture = $this->getPathSignature($general_id);

        return view('candidate.vista_solicitud_empleo', compact('job_applications', 'educations',
            'competences', 'references', 'knowledges', 'skills', 'economics', 'experiences_job', 'activities', 'path_siganture'));
    }

    public function getJobForm()
    {
        return DB::select("
            select job_application.*, general_data.*, blood.description as blood_type,
              civil_status.descripcion as civil_status, parish.name as parish_name,
              parish_priest.name as priest_name
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
}
