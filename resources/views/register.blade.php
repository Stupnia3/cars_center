@extends('layout')

@section('title')
    Оставить заявку
@endsection

@section('content')
    <div class="container mt-5">
        <h2>Оставить заявку</h2>
        @if($errors->any())
            <ul class="alert alert-danger mt-2 mb-2">
                @foreach($errors->all() as $error)
                    <li class="mb-1">{{$error}}</li>
                @endforeach
            </ul>
        @endif
        <form method="post" action="{{ route('registration') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="login">Логин:</label>
                <input type="text" class="form-control" id="login" name="login" required>
            </div>
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Подтвердите пароль:</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>
            <div class="form-group">
                <label for="full_name">Имя (директор):</label>
                <input type="text" class="form-control" id="full_name" name="full_name" required>
            </div>
            <div class="form-group">
                <label for="phone">Телефон:</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="+7(XXX)-XXX-XX-XX" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="INN">ИНН:</label>
                <input type="text" class="form-control" id="INN" name="INN" required>
            </div>
            <div class="form-group">
                <label for="License">Лицензия (в форматах .pdf, .png, .jpg):</label>
                <input type="file" id="License" name="license" accept=".pdf,.png,.jpg" required>
            </div>
            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{asset('jquery.mask.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(function(){
            $("#phone").mask("+7 (999) 999-99-99");
        });
    </script>
@endsection
