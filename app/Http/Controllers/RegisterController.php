<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request){
        $data = $request->all(); // добавляем поле 'active' со значением 'nonactive'
        $data = $request->except(['_token', 'password_confirmation']);
        if ($request->hasFile('license')) {
            $file = $request->file('license');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/img/licenses', $fileName); // Сохранение файла в папку "storage/app/public/img/licenses"
            $data['license'] = $fileName; // Сохранение имени файла в базе данных
        }
        $data['password'] = bcrypt($data['password']);
        $data['role'] = RoleEnum::USER->value;
        $data['status'] = StatusEnum::NEW->value;

        User::create($data);


        return redirect()->route('login');
    }

}
