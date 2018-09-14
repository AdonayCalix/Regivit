<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\UserDocument;
use App\Revision;

class ScreenFormController extends Controller
{
    public function savePersonalData(Request $request)
    {
        $result = $this->validateIfExit(2);
        if($result->isEmpty()){
            $user_document = new UserDocument;
            $user_document->document_id = $this->findJobFormId($this->findCoordinatorId());
            $user_document->users_id = auth()->user()->id;
            $user_document->path = $this->saveSignature($request->data_uri);
            $user_document->status = 1;
            if ($user_document->save()) {
                $revision = new Revision;
                $revision->form = 2;
                $revision->status = 1;
                $revision->users_id = auth()->user()->id;
                return response()->json(['status' => $revision->save()]);
            }
        }else {
            return response()->json(['status' => false]);
        }

    }
    public function validateIfExit($form)
    {
        return DB::table('revision')
            ->where('users_id', '=', auth()->user()->id)
            ->where('form', '=', $form)
            ->where('status', '=', 1)
            ->get();
    }

    public function saveSignature($data_uri)
    {

        $encoded_image = explode(",", $data_uri)[1];
        $decoded_image = base64_decode($encoded_image);
        $file_name = mt_rand() . time() . auth()->user()->id . '.png';
        file_put_contents(public_path() . '/uploades/' . $file_name, $decoded_image);

        return $file_name;
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
            ->where('name', '=', 'Ficha de datos personales RG-RH.120')
            ->value('id');
    }
}
