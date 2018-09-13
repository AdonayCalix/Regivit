<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\DB;

class CheckDate2
{

    public function handle($request, Closure $next)
    {
        if (!$this->validateTime($this->getEndDate(), $this->getStarDate())) {
            return redirect()->route('tab_two_disabled');
        }
        return $next($request);
    }

    public function getEndDate()
    {
        return DB::table('users_limit_time')->where('users_id', auth()->user()->id)->value('end_date');
    }

    public function getStarDate()
    {
        return DB::table('users_limit_time')->where('users_id', auth()->user()->id)->value('start_date');
    }

    public function validateTime($limit_date, $star_date)
    {
        $current_date = Carbon::now();
        return ($current_date->greaterThanOrEqualTo($star_date) && $current_date->lessThanOrEqualTo($limit_date));
    }
}
