<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return redirect()->route('admin.login')->with('warning', 'Silakan login terlebih dahulu untuk mengakses dashboard admin.');
        }

        $user = Auth::user();
        if (! in_array($user->role, ['superadmin', 'admin'], true)) {
            Auth::logout();

            return redirect()->route('admin.login')->with('error', 'Akses ditolak. Anda tidak memiliki izin staf/admin.');
        }

        return $next($request);
    }
}
