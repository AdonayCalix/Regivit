<?php

namespace App\Http\Controllers;

use App\CoordinadorFaculties;
use App\Document;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Faculty;
use App\UserFaculty;
use function Symfony\Component\VarDumper\Tests\Caster\reflectionParameterFixture;

class MasterUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $faculties_campus = Faculty::all();
        return view('master_user.usuarios')->with('users', $users)->with('faculties_campus', $faculties_campus);
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
            if ($request->user_type == 2) {
                for ($i= 0; $i < count($request->input('faculty')); $i++) {
                    $coordinator_faculties = new CoordinadorFaculties;
                    $coordinator_faculties->users_id = $this->getIdUser($request->identity);
                    $coordinator_faculties->faculties_code = $request->input('faculty')[$i];
                    $status = $coordinator_faculties->save();

                    $document = new Document;
                    $document->name = 'Solicitud de empleo REG-RH.102';
                    $document->tab = 1;
                    $document->visibility = 2;
                    $document->faculties_code = $request->input('faculty')[$i];
                    $document->users_id = $this->getIdUser($request->identity);
                    $document->save();

                    $document = new Document;
                    $document->name = 'Ficha de datos personales RG-RH.120';
                    $document->tab = 2;
                    $document->visibility = 2;
                    $document->faculties_code = $request->input('faculty')[$i];
                    $document->users_id = $this->getIdUser($request->identity);
                    $document->save();

                }
            }
            if ($request->user_type == 3 || $request->user_type == 4) {
                $user_faculty = new UserFaculty;
                $user_faculty->users_id = $this->getIdUser($request->identity);
                $user_faculty->faculties_code = $request->faculty_user;
                $status = $user_faculty->save();
            }

            return response()->json(['status' => $status]);
        }
    }

    public function getIdUser($identity)
    {
        return DB::table('users')->where('identity', $identity)->value('id');
    }

    public function edit(Request $request)
    {
        return response()->json(DB::table('users')
            ->where('identity', '=', $request->identity)
            ->get()->toArray());
    }

    public function changeStatus(Request $request)
    {
        if ($request->ajax()) {
            if ($request->status == 1) {
                $status = User::where('identity', $request->identity)
                    ->update(['status' => 0]);
            } else if ($request->status == 2) {
                $status = User::where('identity', $request->identity)
                    ->update(['status' => 1]);
            }
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
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
            return response()->json(['status' => true]);
        }
    }

    public function getCampus()
    {
        return DB::table('users')->where('identity', auth()->user()->identity)->value('campus_id');
    }
}
