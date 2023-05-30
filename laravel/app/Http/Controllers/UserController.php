<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class UserController extends Controller {
    public function recuperarPasswordView() {
        return view('recuperarPassword');
    }

    public function enviarLink(Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['correuEnviat' => __($status)])
            : back()->with(['correuError' => __($status)]);
    }

    public function reiniciarPasswordView(string $token) {
        return view('reiniciarPassword', ['token' => $token]);
    }

    public function reiniciarPassword(Request $request) {
        
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:6|confirmed',
            ]);
         
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function (User $user, string $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));
         
                    $user->save();
         
                    event(new PasswordReset($user));
                }
            );
         
            return $status === Password::PASSWORD_RESET
                        ? redirect()->route('auth.login')->with('correuEnviat', __($status))
                        : back()->with(['correuError' => [__($status)]]);
    }
    
}
