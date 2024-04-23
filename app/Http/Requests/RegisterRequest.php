<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class RegisterRequest extends FormRequest
    {
        /**
         * Determine if the user is authorized to make this request.
         */
        public function authorize(): bool
        {
            return true;
        }


        /**
         * Get the validation rules that apply to the request.
         *
         * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
         */
        public function rules(): array
        {
            return [
                'login' => ['required', 'string', 'unique:users,login'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
                'full_name' => ['required', 'string'],
                'phone' => ['required', 'regex:/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/'],
                'email' => ['required', 'email', 'unique:users,email'],
                'INN' => ['required', 'string', 'unique:users,INN'],
            ];
        }


        public function attributes(): array
        {
            return [
                'login' => 'логин',
                'password' => 'пароль',
                'full_name' => 'ФИО',
                'phone' => 'телефон',
                'email' => 'почта',
                'INN' => 'ИНН',
                'license' => 'Лицензия',
            ];
        }
    }
