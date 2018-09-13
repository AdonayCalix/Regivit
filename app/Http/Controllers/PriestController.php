<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\ParihPriest;

class PriestController extends Controller
{
    public function index()
    {
        $priests = ParihPriest::all();
        return view('master_user.parrocos', compact('priests'));
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validateData = $request->validate([
                'name' => 'required|string'
            ]);

            $priest = new ParihPriest;
            $priest->name = $request->name;
            return response()->json(['status' => $priest->save()]);
        }
    }

    public function edit(Request $request)
    {
        return response()->json(DB::table('parish_priest')
            ->where('id', '=', $request->priest_id)
            ->get()->toArray());
    }

    public function editpriest(Request $request)
    {
        if ($request->ajax()) {

            $validateData = $request->validate([
                'id' => 'required|numeric',
                'name' => 'required|string'
            ]);

            $campus = ParihPriest::where('id', $request->id)
                ->update([
                    'name' => $request->name,
                ]);
            return response()->json(['status' => true]);
        }
    }

}