<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Ambil data login dari request
        $credentials = $request->only('email', 'password');

        // Cek apakah remember checkbox diaktifkan
        $remember = $request->has('remember');

        // Autentikasi dengan kredensial dan remember me
        if (Auth::attempt($credentials, $remember)) {
            // Regenerasi session untuk menghindari session fixation attacks
            $request->session()->regenerate();

            // Redirect ke halaman dashboard setelah login sukses
            return redirect()->intended(route('admin.dashboard.index'));
        }

        // Jika autentikasi gagal, kembalikan ke halaman login dengan pesan error
        return back()
            ->withErrors([
                'email' => 'Email atau password tidak valid.',
            ])
            ->onlyInput('email');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
