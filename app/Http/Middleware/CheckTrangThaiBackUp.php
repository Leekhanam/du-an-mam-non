<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\NamHoc;
class CheckTrangThaiBackUp
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
        $backup = NamHoc::find($request->id)->backup;
        if ($backup != 0) {
            return redirect()->route('nam-hoc.index');
        }
        return $next($request);
    }
}
