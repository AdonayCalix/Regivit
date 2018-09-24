<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateUserRequest;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\UserFaculty;
use App\Http\Controllers\MasterUserController;

class TeacherUserController extends MasterUserController
{
    public function index()
    {
        $faculties = $this->getFaculties();
        $users = DB::select('select users.*
from users, users_faculties
where users.id = users_faculties.users_id
and users_faculties.coordinator_id = ? and users.user_type = 4', [auth()->user()->id]);
        return view('coordinator_user.usuario_catedratico', compact('users', 'faculties'));
    }

    public function store(CreateUserRequest $request)
    {
        if ($request->ajax()) {

            $user = new User;
            $user->identity = $request->identity;
            $user->first_name = $request->first_name;
            $user->second_name = $request->second_name;
            $user->first_surname = $request->first_surname;
            $user->second_surname = $request->second_surname;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->user_type = $request->user_type;
            $user->status = 1;
            $user->campus_id = $this->getCampus();
            $status = $user->save();

            $users_faculties = new UserFaculty;
            $users_faculties->users_id = $this->getId($request->identity);
            $users_faculties->faculties_code = $request->faculty;
            $users_faculties->coordinator_id  = auth()->user()->id;
            $users_faculties->save();

            $limit_time = new UserLimitTime;
            $start_date = Carbon::now();
            $end_date = $start_date->copy()->addDays(14);
            $limit_time->users_id = $this->getId($request->identity);
            $limit_time->start_date = $start_date;
            $limit_time->end_date = $end_date;
            $limit_time->save();

            return response()->json(['status' => $status]);
        }
    }

    public function getId($id)
    {
        return DB::table('users')
            ->where('identity', '=', $id)
            ->value('id');
    }

    public function getFaculty($id)
    {
        return DB::table('users_faculties')
            ->where('users_id', '=', $id)
            ->value('faculties_code');
    }
    public function changeStatus(Request $request)
    {
        return parent::changeStatus($request);
    }

    public function editUser(Request $request)
    {
        if ($request->ajax()) {
            $user = User::where('identity', $request->identity)
                ->update([
                    'first_name' => $request->first_name,
                    'second_name' => $request->second_name,
                    'email' => $request->email,
                    'first_surname' => $request->first_surname,
                    'second_surname' => $request->second_surname,
                    'user_type' => $request->user_type
                ]);

            $faculty = UserFaculty::where('users_id', $this->getId($request->identity))
                ->update([
                    'faculties_code' => $request->faculty
                ]);

            return response()->json(['status' => true]);
        }
    }
    public function edit(Request $request)
    {
        return parent::edit($request);
    }

    public function getFaculties()
    {
        return DB::table('coordinator_faculties')
            ->join('faculties', 'faculties.code', '=', 'coordinator_faculties.faculties_code')
            ->where('coordinator_faculties.users_id', '=', auth()->user()->id)
            ->get();
    }
}
