<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function auth(Request $request)
    {
        $credentials = $request->only(['login', 'password']);
        if (Auth::attempt($credentials, true)) {
            $user = Auth::user();
            if ($user->role === RoleEnum::USER->value){
                return redirect()->route('user');
            }
            if ($user->role === RoleEnum::ADMIN->value) {
                return redirect()->route('admin');
            }
        }
        return redirect()->back()->with('error', "Пользователь не найден");
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
