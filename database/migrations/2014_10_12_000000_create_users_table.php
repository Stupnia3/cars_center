<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique()->nullable();
            $table->string('login')->unique();
            $table->string('phone')->nullable();
            $table->string('password');
            $table->string('INN')->unique()->nullable();
            $table->string('address')->nullable();
            $table->string('name_company')->nullable();
            $table->string('license')->nullable();
            $table->string('status')->default(\App\Enums\StatusEnum::NEW->value);
            $table->string('role');
            $table->rememberToken();
            $table->timestamps();
        });
        // Создание пользователя с ролью "admin"
        $adminUser = [
            'full_name' => 'Мунин Ярослав',
            'email' => 'munin@mail.ru',
            'login' => 'admin',
            'phone' => '+7 (987) 419-01-05',
            'status' => 'active',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ];

        User::create($adminUser);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
