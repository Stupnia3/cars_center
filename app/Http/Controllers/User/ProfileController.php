<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserCard;


class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user(); // Получаем текущего пользователя
        return view('user.show', compact('user'));
    }

    // Метод для обновления данных пользователя
    public function update(Request $request)
    {
        $user = auth()->user(); // Получаем текущего пользователя

        // Обновляем данные пользователя
        if ($request->hasFile('license')) {
            // Получаем файл из запроса
            $file = $request->file('license');
            // Генерируем уникальное имя файла
            $fileName = time() . '_' . $file->getClientOriginalName();
            // Сохраняем файл на сервере
            $file->storeAs('public/img/licenses', $fileName);
            // Обновляем поле "license" в базе данных
            $user->update([
                'license' => $fileName,
                // Другие поля для обновления...
            ]);
        } else {
            $user->update([
                'full_name' => $request->input('full_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'INN' => $request->input('INN'),
                'address' => $request->input('address'),
                'name_company' => $request->input('name_company'),
                'description' => $request->input('description'),
                'shinomontazh' => $request->has('shinomontazh') ? true : false,
                'sto' => $request->has('sto') ? true : false,
                'diagnostika' => $request->has('diagnostika') ? true : false,
                'remont_mkpp_akpp' => $request->has('remont_mkpp_akpp') ? true : false,
                'remont_dvigatelya' => $request->has('remont_dvigatelya') ? true : false,
            ]);
        }

        return redirect()->route('user')->with('success', 'Данные успешно обновлены');
    }

    public function createUserCard(User $user)
    {
        // Создание новой карточки пользователя
        UserCard::create([
            'user_id' => $user->id,
            'full_name' => $user->full_name,
            'email' => $user->email,
            'phone' => $user->phone,
            // Другие поля, которые вы хотите добавить в карточку пользователя
        ]);
        return redirect()->route('user')->with('success', 'Карточка пользователя успешно создана');
    }
}
