<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class adminonly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if($user->id_role != 1 ){
            return response()->json([
                "status" => false,
                "message" => "data tidak ditemukan",
                "data" => null
            ]);
        }

        return $next($request);
    }
}
