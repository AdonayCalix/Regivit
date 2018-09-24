<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class CheckJobForm
{

    public function handle($request, Closure $next)
    {
        $result = $this->chechekGeneralData();

        if($result->isNotEmpty()) {
            return redirect()->route('view_job_form.index');
        }

        return $next($request);
    }

    public function chechekGeneralData()
    {
        return DB::table('general_data')
            ->where('users_id', '=', auth()->user()->id)
            ->get();
    }
}
