<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSuperAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna saat ini memiliki peran 'superadmin'
        if ($request->user() && $request->user()->role !== 'superadmin') {
            // Jika tidak, Anda bisa mengarahkan pengguna ke halaman lain
            return redirect()->route('/')->with('error', 'Anda tidak memiliki akses sebagai superadmin.');
        }

        // Lanjutkan permintaan jika pengguna adalah superadmin
        return $next($request);
    }
}
