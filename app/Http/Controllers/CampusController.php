<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Campus;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CampusRequest;
class CampusController extends Controller
{
    public function index()
    {
        $campus = Campus::all();
        return view('master_user.campus', compact('campus'));
    }

    public function edit(Request $request)
    {
        return response()->json(DB::table('campus')
            ->where('campus_code', '=', $request->campus_code)
            ->get()->toArray());
    }

    public function store(CampusRequest $request)
    {
        $campus = new Campus;
        $campus->campus_code = $request->campus_code;
        $campus->name = $request->name;
        $campus->city = $request->city;
        $campus->status = 1;
        return response()->json([
            'status' => $campus->save()
        ]);
    }

    public function changeStatus(Request $request)
    {
        if ($request->ajax()) {
            if ($request->status == 1) {
                $status = Campus::where('campus_code', $request->campus_code)
                    ->update(['status' => 0]);
            } else if ($request->status == 2) {
                $status = Campus::where('campus_code', $request->campus_code)
                    ->update(['status' => 1]);
            }
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function editCampus(Request $request)
    {
        if ($request->ajax()) {
            $campus = Campus::where('campus_code', $request->campus_code)
                ->update([
                    'name' => $request->name,
                    'city' => $request->city,
                ]);
            return response()->json(['status' => true]);
        }
    }
}
