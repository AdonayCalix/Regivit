<?php

namespace App\Http\Controllers;

use App\Document;
use App\User;
use App\UserDocument;
use http\Env\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class TabOneController extends Controller
{
    public function index()
    {
        $end_date = $this->getEndDate();
        $document_list = json_decode(json_encode($this->getDocumentListUser()), true);
        return view('candidate.solapa_uno', compact('document_list', 'end_date'));
    }

    public function store(Request $request)
    {
        $result = $this->validateIfEsxistDocument($request->document_type);

        if ($result->isNotEmpty()) {
            $file = $request->file('file');
            $path = public_path() . '/uploades';
            $file_name = uniqid() . $file->getClientOriginalName();

            $file->move($path, $file_name);

            $status = UserDocument::where('document_id', $request->document_type)
                ->where('users_id', auth()->user()->id)
                ->update(['path' => $file_name]);
            exit;
        }
        $file = $request->file('file');
        $path = public_path() . '/uploades';
        $file_name = uniqid() . $file->getClientOriginalName();

        $file->move($path, $file_name);

        $users_document = new UserDocument();

        $users_document->users_id = auth()->user()->id;
        $users_document->path = $file_name;
        $users_document->status = 1;
        $users_document->document_id = $request->document_type;
        if ($users_document->save()) {
            return Response::json('success', 200);
        } else {
            return Response::json('error', 400);
        }
    }

    public
    function getDocumentListUser()
    {
        return DB::select("
            select documents.id, documents.name, " .
            "case " .
            "when (select status from users_documents where document_id = documents.id and users_documents.users_id = ?) = '1' then 'Upload' " .
            "when (select status from users_documents where document_id = documents.id and users_documents.users_id = ?) is null then 'No Upload' " .
            "END as status " .
            "from documents, users_documents " .
            "where documents.tab = ? and documents.users_id = ? " .
            "group by documents.id, documents.name", [auth()->user()->id, auth()->user()->id, 1, $this->getCoordinatorId()]
        );
    }

    public
    function validateIfEsxistDocument($document_id)
    {
        return DB::table('users_documents')
            ->where('document_id', '=', $document_id)
            ->where('users_id', '=', auth()->user()->id)
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
