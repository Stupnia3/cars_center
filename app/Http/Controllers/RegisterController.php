<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        // Исключаем лишние поля из запроса
        $data = $request->except(['_token', 'password_confirmation']);

        if ($request->hasFile('license')) {
            // Получаем файл из запроса
            $file = $request->file('license');
            // Генерируем уникальное имя файла
            $fileName = time() . '_' . $file->getClientOriginalName();
            // Сохраняем файл на сервере
            $file->storeAs('public/img/licenses', $fileName);
            // Добавляем имя файла к данным пользователя
            $data['license'] = $fileName;
        }

        $data['latitude'] = $request->input('latitude');
        $data['longitude'] = $request->input('longitude');

        // Хешируем пароль
        $data['password'] = Hash::make($data['password']);
        // Устанавливаем роль и статус
        $data['role'] = RoleEnum::USER->value;
        $data['status'] = StatusEnum::NEW->value;

        // Создаем пользователя
        User::create($data);

        // Редирект на страницу входа
        return redirect()->route('login');
    }
}
