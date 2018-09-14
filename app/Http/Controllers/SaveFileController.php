<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserDocument;
use Illuminate\Support\Facades\DB;


class SaveFileController extends Controller
{
    public function saveFile(Request $request)
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
            return response()->json(['status' => true]);
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
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }
    public
    function validateIfEsxistDocument($document_id)
    {
        return DB::table('users_documents')
            ->where('document_id', '=', $document_id)
            ->where('users_id', '=', auth()->user()->id)
            ->get();
    }
}
