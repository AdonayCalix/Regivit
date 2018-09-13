<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TabDisabledController extends Controller
{
    public function index_tab_one()
    {
        $document_list = json_decode(json_encode($this->getDocumentListUser()), true);
        return view('candidate.solapa_uno_disabled', compact('document_list'));
    }

    public function index_tab_two()
    {
        $document_list = json_decode(json_encode($this->getDocumentListUser2()), true);
        return view('candidate.solapa_two_disabled', compact('document_list'));
    }

    public function getDocumentListUser()
    {
        return DB::select("
            select documents.id, documents.name, " .
            "case " .
            "when (select status from users_documents where document_id = documents.id and users_documents.users_id = ?) = '1' then 'Upload' " .
            "when (select status from users_documents where document_id = documents.id and users_documents.users_id = ?) is null then 'No Upload' " .
            "END as status " .
            "from documents, users_documents " .
            "where documents.tab = ? " .
            "group by documents.id, documents.name", [auth()->user()->id, auth()->user()->id, 1]
        );
    }

    public function getDocumentListUser2()
    {
        return DB::select("
            select documents.id, documents.name, " .
            "case " .
            "when (select status from users_documents where document_id = documents.id and users_documents.users_id = ?) = '1' then 'Upload' " .
            "when (select status from users_documents where document_id = documents.id and users_documents.users_id = ?) is null then 'No Upload' " .
            "END as status " .
            "from documents, users_documents " .
            "where documents.tab = ? " .
            "group by documents.id, documents.name", [auth()->user()->id, auth()->user()->id, 2]
        );
    }

    public static function validateTime()
    {
        $star_date = DB::table('users_limit_time')->where('users_id', auth()->user()->id)->value('start_date');
        $limit_date = DB::table('users_limit_time')->where('users_id', auth()->user()->id)->value('end_date');
        $current_date = Carbon::now();
        if ($current_date->greaterThanOrEqualTo($star_date) && $current_date->lessThanOrEqualTo($limit_date)) {
            return true;
        } else {
            return false;
        };
    }
}
