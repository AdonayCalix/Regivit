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
                    'celular' => $request->celular
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

}
