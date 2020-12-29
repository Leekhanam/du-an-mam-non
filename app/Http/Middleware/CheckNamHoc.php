<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\NamHoc;

class CheckNamHoc
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $count_nam_hoc = NamHoc::count();

        if (!$count_nam_hoc) {
            return redirect()->route('nam-hoc.khoi-tao');
        }
        return $next($request);
    }
}
