<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Activity;
use App\Competence;
use App\Dependent;
use App\Education;
use App\ExperienceJob;
use App\Knowledge;
use App\Reference;
use App\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\JobFormRequest;
use App\Blood;
use App\CivilStatus;
use App\Parish;
use App\ParihPriest;
use App\GeneralData;
use App\JobApplication;
use App\UserDocument;

class JobFormController extends Controller
{
    public $status = false;

    public function index()
    {
        $civil_status = CivilStatus::all();
        $blood = Blood::all();
        $parishes = Parish::all();
        $priests = ParihPriest::all();

        return view('candidate.solicitud_empleo', compact('civil_status', 'blood', 'parishes', 'priests'));
    }

    public function store(JobFormRequest $request)
    {
        if ($request->ajax()) {
            $general_data = new GeneralData;
            $general_data->address = $request->address;
            $general_data->nationality = $request->nationality;
            $general_data->ihss = $request->ihss;
            $general_data->rap = $request->rap;
            $general_data->birthdate = $request->birthdate;
            $general_data->catholic_movement = $request->catholic_movement;
            $general_data->users_id = auth()->user()->id;
            $general_data->civil_status_id = $request->civil_status;
            $general_data->parish_id = $request->parish;
            $general_data->priest_id = $request->priest;
            $general_data->save() ? $this->status = true : $this->status = false;

            $job_application = new JobApplication;
            $job_application->age = $request->age;
            $job_application->pastoral_activity = $request->pastoral_activity;
            $job_application->family_university = $request->family_university;
            $job_application->minimum_salary = $request->minimun_salary;
            $job_application->signature_path = $this->saveSignature($request->signature_path);
            $job_application->married_surname = $request->married_surname;
            $job_application->aspire_position = $request->aspire_position;
            $job_application->general_data_id = $this->getGeneralDataId();
            $job_application->blood_id = $request->blood;
            $job_application->place_date = $request->place_date;
            $job_application->save() ? $this->status = true : $this->status = false;

            $id_job_application = $this->getJobFormId($this->getGeneralDataId());

            for ($i = 0; $i < count($request->input('education_years')); $i++) {
                $education = new Education;
                $education->time_education = $request->input('education_years')[$i];
                $education->school_name = $request->input('education_school_name')[$i];
                $education->degree = $request->input('education_degree')[$i];
                $education->level = ($i + 1);
                $education->job_application_id = $id_job_application;
                $education->save() ? $this->status = true : $this->status = false;
            }

            for ($i = 0; $i < count($request->input('skill')); $i++) {
                $skill = new Skill;
                $skill->description = $request->input('skill')[$i];
                $skill->job_application_id = $id_job_application;
                $skill->save() ? $this->status = true : $this->status = false;
            }

            for ($i = 0; $i < count($request->input('competence')); $i++) {
                $competence = new Competence;
                $competence->description = $request->input('competence')[$i];
                $competence->job_application_id = $id_job_application;
                $competence->save() ? $this->status = true : $this->status = false;
            }

            for ($i = 0; $i < count($request->input('knowledge')); $i++) {
                $knowledge = new Knowledge;
                $knowledge->description = $request->input('knowledge')[$i];
                $knowledge->job_application_id = $id_job_application;
                $knowledge->save() ? $this->status = true : $this->status = false;
            }

            for ($i = 0; $i < count($request->input('reference_name')); $i++) {
                $reference = new Reference;
                $reference->name = $request->input('reference_name')[$i];
                $reference->relationship = $request->input('reference_relationship')[$i];
                $reference->address = $request->input('reference_address')[$i];
                $reference->number = $request->input('reference_number')[$i];
                $reference->job_application_id = $id_job_application;
                $reference->save() ? $this->status = true : $this->status = false;
            }

            $experience = new ExperienceJob;
            $experience->company_name = $request->company_name;
            $experience->position = $request->position;
            $experience->experience_age = $request->experience_age;
            $experience->job_application_id = $id_job_application;
            $experience->save() ? $this->status = true : $this->status = false;

            $experience_id = $this->getExperiencesJobId($id_job_application);

            for ($i = 0; $i < count($request->input('activity')); $i++) {
                $activity = new Activity;
                $activity->description = $request->input('activity')[$i];
                $activity->experiences_job_id = $experience_id;
                $activity->save() ? $this->status = true : $this->status = false;
            }

            for ($i = 0; $i < count($request->input('dependent_name')); $i++) {
                $dependent = new Dependent;
                $dependent->name = $request->input('dependent_name')[$i];
                $dependent->address = $request->input('dependent_address')[$i];
                $dependent->relationship = $request->input('dependent_relationship')[$i];
                $dependent->age = $request->input('dependent_age')[$i];
                $dependent->general_data_id = $this->getGeneralDataId();
                $dependent->save();
            }

            if ($this->status) {
                $user_document = new UserDocument;
                $user_document->document_id = 1;
                $user_document->users_id = auth()->user()->id;
                $user_document->path = $this->saveSignature($request->capture);
                $user_document->status = 1;
                if ($user_document->save()){
                    $this->status = true;
                }
            }
            return response()->json(['status' => $this->status]);

        }
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

    public function getExperiencesJobId($job_application_id)
    {
        return DB::table('experiences_job')
            ->where('job_application_id', '=', $job_application_id)
            ->value('id');
    }

    public function getDatesUploadDocuments()
    {
        return DB::table('users_limit_time')->where('users_id', '=', 24)->value('end_date');
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
}
