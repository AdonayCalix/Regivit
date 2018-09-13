<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Parish;


class ParishController extends Controller
{
    public function index()
    {
        $parishes = Parish::all();
        return view('master_user.parroquias', compact('parishes'));
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validateData = $request->validate([
                'name' => 'required|string'
            ]);

            $parish = new Parish;
            $parish->name = $request->name;
            return response()->json(['status' => $parish->save()]);
        }
    }

    public function edit(Request $request)
    {
        return response()->json(DB::table('parish')
            ->where('id', '=', $request->parish_id)
            ->get()->toArray());
    }

    public function editParish(Request $request)
    {
        if ($request->ajax()) {

            $validateData = $request->validate([
                'id' => 'required|numeric',
                'name' => 'required|string'
            ]);

            $campus = Parish::where('id', $request->id)
                ->update([
                    'name' => $request->name,
                ]);
            return response()->json(['status' => true]);
        }
    }
}
