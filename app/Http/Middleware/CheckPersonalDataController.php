<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class CheckPersonalDataController
{

    public function handle($request, Closure $next)
    {
        $result = $this->chechekPersonalData();
        if ($result->isNotEmpty()) {
            return redirect()->route('view_personal.index');
        }
        return $next($request);
    }

    public function chechekPersonalData()
    {
        return DB::table('general_data')
            ->join('personal_data', 'general_data.id', '=', 'personal_data.general_data_id')
            ->where('general_data.users_id', '=', auth()->user()->id)
            ->get();
    }
}
