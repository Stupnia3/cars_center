@extends('layout')

@section('title', 'Добавить админа')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Добавить админа</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.users.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="full_name">Имя:</label>
                                <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" required>
                                @error('full_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="login">Логин:</label>
                                <input type="text" class="form-control @error('login') is-invalid @enderror" id="login" name="login" required>
                                @error('login')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Пароль:</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Добавьте другие поля, если необходимо -->
                            <button type="submit" class="btn btn-primary">Добавить админа</button>
                        </form>
                        @if(session('error'))
                            <div class="alert alert-danger mt-3">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
