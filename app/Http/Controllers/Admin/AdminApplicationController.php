<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicationResource;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Application;

class AdminApplicationController extends Controller
{
    public function index()
    {
        // Получаем всех пользователей
        $users = User::all();

        // Передаем данные в представление
        return view('admin.application.index', compact('users'));
    }

    public function update(User $user, Request $request)
    {

        if ($request->status === 'deleted') {
            $user->status = 'deleted';
            $user->save();
            return redirect()->back()->with('success', 'Пользователь удален успешно.');
        }
        $user->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Статус пользователя обновлен');
    }

}
