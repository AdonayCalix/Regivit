<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadedController extends Controller
{
    public function index()
    {
        return view('coordinator_user.asignar_documentos');
    }
    public function uploadDocuments(Request $request)
    {
        if ($request->ajax()) {
            $status = false;
            for ($i = 0; $i < count($request->input('tab')); $i++) {
                $document = new Document;
                $document->name = $request->input('tab')[$i];
                $document->tab = $request->input('number_tab');
                $document->users_id = auth()->user()->id;
                $document->faculties_code = $this->getFacultiesCode();
                $document->visibility = 1;
                $status = $document->save();
            }
        }

        return response()->json(['status' => $status]);
    }
}
