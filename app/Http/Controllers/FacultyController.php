<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Faculty;
use App\Http\Requests\FacultyRequest;

class FacultyController extends Controller
{
    public function index()
    {
        $faculties = Faculty::all();
        return view('master_user.facultades', compact('faculties'));
    }

    public function edit(Request $request)
    {
        return response()->json(DB::table('faculties')
            ->where('code', '=', $request->code)
            ->get()->toArray());
    }

    public function store(FacultyRequest $request)
    {
        $faculties = new Faculty;
        $faculties->code = $request->code;
        $faculties->name = $request->name;
        $faculties->status = 1;
        return response()->json([
            'status' => $faculties->save()
        ]);
    }

    public function changeStatus(Request $request)
    {
        if ($request->ajax()) {
            if ($request->status == 1) {
                $status = Faculty::where('code', $request->code_faculty)
                    ->update(['status' => '2']);
            } else if ($request->status == 2) {
                $status = Faculty::where('code', $request->code_faculty)
                    ->update(['status' => '1']);
            }
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function editCampus(Request $request)
    {
        if ($request->ajax()) {
            $faculties = Faculty::where('code', $request->code)
                ->update([
                    'name' => $request->name,
                ]);
            return response()->json(['status' => true]);
        }
    }
}
