<?php

namespace App\Http\Controllers;

use App\UserDocument;
use Illuminate\Http\Request;
use App\UserFaculty;
use App\UserLimitTime;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificacionDate;

class DocumentDateController extends Controller
{
    public function index()
    {
        $faculties_user = DB::table('coordinator_faculties')
            ->join('faculties', 'faculties.code', '=', 'coordinator_faculties.faculties_code')
            ->where('coordinator_faculties.users_id', auth()->user()->id)
            ->select('faculties.code', 'faculties.name')->groupBy('faculties.code')->get();
        return view('coordinator_user.asignar_hora', compact('faculties_user', 'users_faculty'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'faculty_coordinator' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        $status = false;

        $users_faculties = DB::table('users_faculties')
            ->where('faculties_code', $request->faculty_coordinator)->get();

        if ($request->has('name')) {
            if (count($request->input('name')) > 0) {
                for ($i = 0; $i < count($request->input('name')); $i++) {
                    $result = $this->existUsers($request->input('name')[$i]);
                    $start_date = Carbon::createFromFormat('Y-d-m H:i', $request->start_date);
                    $end_date =  Carbon::createFromFormat('Y-d-m H:i', $request->end_date);
                    if ($result->isEmpty()) {
                        $user_limit = new UserLimitTime;
                        $user_limit->users_id = $request->input('name')[$i];
                        $user_limit->start_date = $start_date;
                        $user_limit->end_date = $end_date;
                        if ($user_limit->save()) {
                            Mail::to($this->getEmail($request->input('name')[$i]))->send(new NotificacionDate($start_date, $end_date));
                            $status = true;
                        }
                    } else {
                        $user_document = UserLimitTime::where('users_id', $request->input('name')[$i])
                            ->update([
                                'start_date' => Carbon::createFromFormat('Y-d-m H:i', $request->start_date),
                                'end_date' => Carbon::createFromFormat('Y-d-m H:i', $request->end_date)
                            ]);
                        Mail::to($this->getEmail($request->input('name')[$i]))->send(new NotificacionDate($start_date, $end_date));
                        $status = true;
                    }
                }
            }
        } else {
            foreach ($users_faculties as $users_faculty) {
                $result = $this->existUsers($users_faculty->users_id);
                $start_date = Carbon::createFromFormat('Y-d-m H:i', $request->start_date);
                $end_date =  Carbon::createFromFormat('Y-d-m H:i', $request->end_date);
                if ($result->isEmpty()) {
                    $user_limit = new UserLimitTime;
                    $user_limit->users_id = $users_faculty->users_id;
                    $user_limit->start_date = $start_date;
                    $user_limit->end_date = $end_date;
                    if ($user_limit->save()) {
                        Mail::to($this->getEmail($users_faculty->users_id))->send(new NotificacionDate($start_date, $end_date));
                        $status = true;
                    }
                } else {
                    $user_document = UserLimitTime::where('users_id', $users_faculty->users_id)
                        ->update([
                            'start_date' => Carbon::createFromFormat('Y-d-m H:i', $request->start_date),
                            'end_date' => Carbon::createFromFormat('Y-d-m H:i', $request->end_date)
                        ]);
                    Mail::to($this->getEmail($users_faculty->users_id))->send(new NotificacionDate($start_date, $end_date));
                    $status = true;
                }
            }
        }
        return response()->json(['status' => $status]);
    }

    public function edit($id)
    {
        return response()->json(['status' => $this->getUserFaculty($id)]);
    }

    public function getUserFaculty($id)
    {
        return DB::table('users')
            ->join('users_faculties', 'users.id', '=', 'users_faculties.users_id')
            ->where('faculties_code', '=', $id)
            ->where('users_id', '!=', auth()->user()->id)
            ->select('users.id', 'users.first_name', 'users.second_name', 'users.first_surname', 'users.second_surname')
            ->get();
    }

    function existUsers($user_id)
    {
        return DB::table('users_limit_time')
            ->where('users_id', '=', $user_id)
            ->get();
    }

    public function getCodeFaculty()
    {
        return DB::table('users_faculties')->where('users_id', auth()->user()->id)->value('faculties_code');
    }

    public function getEmail($user_id)
    {
        return DB::table('users')
            ->where('id', $user_id)
            ->value('email');
    }
}
