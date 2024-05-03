<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserCardController extends Controller
{
    public function index()
    {
        $users = User::all(); // Получение всех пользователей
        return view('welcome', compact('users')); // Передача данных в представление
    }
    public function search()
    {
        $users = User::all(); // Получение всех пользователей
        return view('search', compact('users')); // Передача данных в представление
    }
}
