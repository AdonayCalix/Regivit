<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Document;
use App\UserDocument;
use http\Env\Response;

class
TabTwoController extends Controller
{
    public function index()
    {
        $document_list = json_decode(json_encode($this->getDocumentListUser()), true);
        $end_date = $this->getEndDate();
        return view('candidate.solapa_dos', compact('document_list', 'end_date'));
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
            "where documents.tab = ? and documents.users_id = ?  " .
            "group by documents.id, documents.name", [auth()->user()->id, auth()->user()->id, 2, $this->getCoordinatorId()]
        );
    }

    public function edit(Request $request)
    {
        $result = $this->getDocument($request->document_id);
        if ($result->isNotEmpty()) {
            return response()->json(['status' => $result]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function getDocument($id)
    {
        return DB::table('users_documents')
            ->where('document_id', '=', $id)
            ->where('users_id', '=', auth()->user()->id)
            ->select('path')
            ->get();
    }

    public function getEndDate()
    {
        return DB::table('users_limit_time')
            ->where('users_id', '=', auth()->user()->id)
            ->value('end_date');
    }

    public function getCoordinatorId()
    {
        return DB::table('users_faculties')
            ->where('users_id', auth()->user()->id)
            ->value('coordinator_id');

    }


}
