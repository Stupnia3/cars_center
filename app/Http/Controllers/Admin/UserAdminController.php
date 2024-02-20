<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserAdminController extends Controller
{
    public function store(Request $request)
    {
        // Валидация данных
        $request->validate([
            'password' => 'required|min:4',
        ]);


        if(User::where('login', $request->login)->exists()) {
            return redirect()->route('add-admin')->with('error', 'Пользователь с таким логином уже существует');
        }

        // Создание нового пользователя с ролью admin
        $user = new User();
        $user->login = $request->login;
        $user->full_name = $request->full_name;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        return redirect()->route('add-admin')->with('success', 'Админ успешно добавлен');
    }
}
