<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.show', ['user' => $user]);
    }
    public function search_click(Request $request)
    {
        $query = User::query();

        // Логирование входящих данных запроса
        Log::info('Search Request Data: ', $request->all());

        // Обработка ключевого слова для поиска по нескольким полям
        if ($request->filled('keyword')) {
            $keyword = '%' . $request->keyword . '%';
            $query->where(function($q) use ($keyword) {
                $q->where('full_name', 'like', $keyword)
                    ->orWhere('address', 'like', $keyword)
                    ->orWhere('name_company', 'like', $keyword)
                    ->orWhere('description', 'like', $keyword);
            });
        }

        // Обработка фильтра по городу
        if ($request->filled('location')) {
            $query->where('address', 'like', '%' . $request->location . '%');
        }

        // Обработка фильтра по видам работ
        if ($request->filled('shinomontazh')) {
            $query->where('shinomontazh', true);
        }
        if ($request->filled('sto')) {
            $query->where('sto', true);
        }
        if ($request->filled('diagnostika')) {
            $query->where('diagnostika', true);
        }
        if ($request->filled('remont_mkpp_akpp')) {
            $query->where('remont_mkpp_akpp', true);
        }
        if ($request->filled('remont_dvigatelya')) {
            $query->where('remont_dvigatelya', true);
        }

        // Сортировка
        if ($request->filled('sort')) {
            $query->orderBy('created_at', $request->sort == 1 ? 'desc' : 'asc');
        }

        // Фильтрация по роли и статусу пользователя
        $query->where('role', '!=', 'admin')->where('status', 'active');

        // Логирование SQL-запроса
        Log::info('SQL Query: ', ['query' => $query->toSql(), 'bindings' => $query->getBindings()]);

        $users = $query->get();

        // Логирование полученных пользователей
        Log::info('Filtered Users: ', ['users' => $users]);

        return view('search', compact('users'));
    }
}
