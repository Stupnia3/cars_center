<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Получаем поисковой запрос из запроса
        $query = $request->input('query');

        // Выполняем поиск пользователей по запросу
        $users = User::where('full_name', 'like', '%'.$query.'%')
            ->orWhere('email', 'like', '%'.$query.'%')
            ->orWhere('description', 'like', '%'.$query.'%')
            ->orWhere('address', 'like', '%'.$query.'%')
            ->orWhere('shinomontazh', true)
            ->orWhere('sto', true)
            ->orWhere('diagnostika', true)
            ->orWhere('remont_mkpp_akpp', true)
            ->orWhere('remont_dvigatelya', true)
            ->get();

        // Возвращаем результаты в формате JSON
        return response()->json(['users' => $users]);
    }
}


