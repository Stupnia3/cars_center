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


    public function getClosestUsers(Request $request)
    {
        $closestUserIds = $request->input('closestUserIds');

        // Получаем данные о ближайших пользователях из базы данных
        $closestUsers = User::whereIn('id', $closestUserIds)
            ->select('id', 'name_company', 'description', 'email', 'phone', 'address', 'role')
            ->get();

        // Возвращаем данные о ближайших пользователях в виде JSON
        return response()->json($closestUsers);
    }




    public function search()
    {
        $users = User::all(); // Получение всех пользователей
        return view('search', compact('users')); // Передача данных в представление
    }
}
