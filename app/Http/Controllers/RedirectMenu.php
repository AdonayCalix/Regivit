<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectMenu extends Controller
{
    public function master_index(Request $request)
    {
        return view('index');
    }

    public function coordinator_index(Request $request)
    {
        return view('index_coordinador');
    }

    public function candidate_index(Request $request)
    {
        return view('index_aspirante');
    }
}
