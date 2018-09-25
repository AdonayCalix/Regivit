<?php

namespace App\Http\Controllers;

use App\Revision;
use Illuminate\Http\Request;
use App\UserDocument;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ScreenController extends Controller
{
    public function saveJobForm(Request $request)
    {
        $result = $this->validateFile();
        if ($result->isNotEmpty()) {
            $document_id =  $this->findJobFormId($this->findCoordinatorId());
            $id = DB::table('users_documents')
                ->where('document_id', '=', $document_id)
                ->where('users_id', '=', auth()->user()->id)
                ->value('id');
            $path = $this->getPathExit($document_id);
            $user_document = UserDocument::where('id', $id)
                ->update([
                    'path' => $this->saveSignature($request->data_uri)
                ]);
            File::delete(public_path('/uploades/' . $path));

            return response()->json(['status' => true]);

        } else {
            $user_document = new UserDocument;
            $user_document->document_id = $this->findJobFormId($this->findCoordinatorId());
            $user_document->users_id = auth()->user()->id;
            $user_document->path = $this->saveSignature($request->data_uri);
            $user_document->status = 1;
        }

        if ($user_document->save()) {
            $revision = new Revision;
            $revision->form = 1;
            $revision->status = 1;
            $revision->users_id = auth()->user()->id;
            return response()->json(['status' => $revision->save()]);
        }
    }

    public function saveSignature($data_uri)
    {

        $encoded_image = explode(",", $data_uri)[1];
        $decoded_image = base64_decode($encoded_image);
        $file_name = mt_rand() . time() . auth()->user()->id . '.png';
        file_put_contents(public_path() . '/uploades/' . $file_name, $decoded_image);

        return $file_name;
    }

    public function validateIfExit()
    {
        $validate = DB::table('revision')
            ->where('users_id', '=', auth()->user()->id)
            ->where('form', '=', 1)
            ->where('status', '=', 1)
            ->get();
        return response()->json(['status' => $validate->isNotEmpty()]);
    }

    public function validateFile()
    {
        return DB::table('revision')
            ->where('users_id', '=', auth()->user()->id)
            ->where('form', '=', 1)
            ->where('status', '=', 1)
            ->get();
    }

    public function findCoordinatorId()
    {
        return DB::table('users_faculties')
            ->where('users_id', '=', auth()->user()->id)
            ->value('coordinator_id');
    }

    public function findJobFormId($coordinator_id)
    {
        return DB::table('documents')
            ->where('users_id', '=', $coordinator_id)
            ->where('name', '=', 'Solicitud de empleo REG-RH.102')
            ->value('id');
    }

    public function getPathExit($document_id)
    {
        return DB::table('users_documents')
            ->where('users_id', '=', auth()->user()->id)
            ->where('document_id', '=', $document_id)
            ->value('path');
    }
}
