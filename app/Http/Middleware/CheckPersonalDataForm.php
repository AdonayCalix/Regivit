<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class CheckPersonalDataForm
{
    public function handle($request, Closure $next)
    {
        $result = $this->chechekJoApplicationlData();
        if($result->isEmpty()) {
            return redirect()->route('error_personal');
        }
        return $next($request);
    }

    public function chechekJoApplicationlData()
    {
        return DB::table('general_data')
            ->join('job_application', 'general_data.id', '=', 'job_application.general_data_id')
            ->where('general_data.users_id', '=', auth()->user()->id)
            ->get();
    }
}
