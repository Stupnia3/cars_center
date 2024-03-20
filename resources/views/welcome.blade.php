@extends('layout')

@section('title', 'Главная страница')

@section('content')
    <div class="container">
        <h1 class="mt-4">Карточки пользователей</h1>
        <div class="row">
            @foreach($users as $user)
                @if($user->role !== 'admin' && $user->status === 'active')
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow">
                            <div class="card-body">
                                <h5 class="card-title">{{ $user->name_company }}</h5>
                                <p class="card-text">Email: {{ $user->email }}</p>
                                <p class="card-text">Телефон: {{ $user->phone }}</p>
                                <p class="card-text">Адрес: {{ $user->address }}</p>
                                <!-- Добавьте другие данные пользователя, если необходимо -->
                            </div>
                            <div class="card-footer bg-info d-flex justify-content-between align-items-center">
                                <a href="{{ route('user.show', $user->id) }}" class="btn btn-light">Подробнее</a>
                                @if(auth()->check() && auth()->user()->isAdmin())
                                    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                                        @csrf
                                        @method('PUT') <!-- Изменяем метод на PUT -->
                                        <input type="hidden" name="_method" value="PUT"> <!-- Добавляем скрытое поле _method -->
                                        <button type="submit" name="status" value="deleted" class="btn btn-danger ml-2">Удалить</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
