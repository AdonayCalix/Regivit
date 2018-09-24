<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\File;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function getCountFilesUpload($identity)
    {
        return DB::table('users_documents')
            ->join('documents', 'documents.id', '=', 'users_documents.document_id')
            ->where('users_documents.users_id', '=', $identity)
            ->where('documents.tab', '=', 1)
            ->where('documents.users_id', '=', auth()->user()->id)
            ->count();
    }

    public function getTotalCount()
    {
        return DB::table('documents')
            ->where('documents.tab', '=', 1)
            ->where('documents.users_id', '=', auth()->user()->id)
            ->count();
    }

    public function getCountFilesUpload2($identity)
    {
        return DB::table('users_documents')
            ->join('documents', 'documents.id', '=', 'users_documents.document_id')
            ->where('users_documents.users_id', '=', $identity)
            ->where('documents.users_id', '=', auth()->user()->id)
            ->where('documents.tab', '=', 2)
            ->count();
    }

    public function getTotalCount2()
    {
        return DB::table('documents')
            ->where('documents.tab', '=', 2)
            ->where('documents.users_id', '=', auth()->user()->id)
            ->where('documents.users_id', '=', auth()->user()->id)
            ->count();
    }

    public function previewContent($path)
    {
        $headers = array(
            'Content-Type: application/pdf',
        );
        return response()->download(public_path() . '/uploades/' . $path);
    }

    public function previewContentTab($path)
    {
        $headers = array(
            'Content-Type: application/pdf',
        );
        return response()->download(public_path() . '/uploades/' . $path);
    }

    public function getListDOcuments($identity)
    {
        return DB::table('users_documents')
            ->join('documents', 'documents.id', '=', 'users_documents.document_id')
            ->where('users_documents.users_id', '=', $identity)
            ->where('documents.tab', '=', '1')
            ->where('documents.users_id', '=', auth()->user()->id)
            ->get();
    }


    public function getListDOcuments2($identity)
    {
        return DB::table('users_documents')
            ->join('documents', 'documents.id', '=', 'users_documents.document_id')
            ->where('users_documents.users_id', '=', $identity)
            ->where('documents.users_id', '=', auth()->user()->id)
            ->where('documents.tab', '=', '2')
            ->get();
    }

    public function getInformationContact($identity)
    {
        return DB::select("
            select general_data.birthdate,
       personal_data.vehiculo,
       personal_data.marca_vehiculo,
       personal_data.modelo_vehiculo,
       personal_data.anio_vehiculo,
       education.degree as pregrado,
       personal_data.postgrado,
       personal_data.admission_date,
       users.first_name,
       users.second_name,
       users.first_surname,
       users.second_surname,
       faculties.name,
       faculties.code
from personal_data,
     general_data,
     job_application,
     education,
     users,
     users_faculties,
     faculties
where users.id = general_data.users_id
  and users.id = users_faculties.users_id
  and users_faculties.faculties_code = faculties.code
  and general_data.id = job_application.general_data_id
  and general_data.id = personal_data.general_data_id
  and job_application.id = education.job_application_id
  and general_data.users_id = ? 
  and education.level = 'Universitaria';", [$identity]);
    }

    public function showReport(Request $request)
    {
        $total_count = $this->getTotalCount();
        $count_uploades2 = $this->getCountFilesUpload2($request->data_report);
        $total_count2 = $this->getTotalCount2();
        $list_document = $this->getListDOcuments($request->data_report);
        $count_uploades = $this->getCountFilesUpload($request->data_report);
        $list_document_two = $this->getListDOcuments2($request->data_report);
        $information_contact = $this->getInformationContact($request->data_report);
        return response()->json(['information_personal' => $information_contact,
            'list_document' => $list_document,
            'list_document_two' => $list_document_two,
            'count_uploades' => $count_uploades,
            'total_count' => $total_count,
            'count_uploades2' => $count_uploades2,
            'total_count2' => $total_count2]);
    }

    public function showGeneralReport()
    {
        $list_users = $this->getListUsers();
        return view('coordinator_user.general_report', compact('list_users'));
    }

    public function getListUsers()
    {
        return DB::select('
            select users.id,
            users.identity,
       users.first_name,
       users.second_name,
       users.first_surname,
       users.second_surname,
       faculties.name as nombre_facultad,
       round(((count(users_documents.id) / (select count(*) from documents where users_id = ?)) *
              100)) as porcentaje
from users_faculties,
     users,
     users_documents,
     faculties
where users.id = users_faculties.users_id
  and users_faculties.coordinator_id = ?
  and users.id = users_documents.users_id
  and users_faculties.faculties_code = faculties.code
  and faculties.code = ?
group by users.id, faculties.name;
        ', [auth()->user()->id, auth()->user()->id, 'IF01002']);
    }
}
