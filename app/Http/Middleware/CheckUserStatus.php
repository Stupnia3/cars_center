<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Проверяем статус пользователя
            if ($user->status === 'active') {
                return $next($request); // Если статус "accepted", продолжаем выполнение запроса
            } else {
                Auth::logout(); // Выход пользователя из системы
                return redirect()->route('login')->withErrors(['status' => 'Ваша учетная запись не активирована.']);
            }
        }

        return $next($request);
    }
}
