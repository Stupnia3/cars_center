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




    public function search(Request $request)
    {
        $query = User::query();


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


        $users = $query->get();


        return view('search', compact('users'));
    }
}
