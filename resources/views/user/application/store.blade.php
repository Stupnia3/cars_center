@extends('layout')

@section('title')
    Оставить заявку
@endsection

@section('content')
    <div class="container mt-5">
        <h2>Оставить заявку</h2>
        @if(session('success'))
            <div class="alert alert-success mt-2 mb-2">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <ul class="alert alert-danger mt-2 mb-2">
                @foreach($errors->all() as $error)
                    <li class="mb-1">{{$error}}</li>
                @endforeach
            </ul>
        @endif
        <form method="post" action="{{ route('user.application.store') }}">
            @csrf
            <div class="form-group">
                <label for="carNumber">Номер автомобиля:</label>
                <input type="text" class="form-control" id="carNumber" name="car_number" placeholder="А000АА116" required>
            </div>
            <div class="form-group">
                <label for="violationDescription">Описание нарушения:</label>
                <textarea class="form-control" id="violationDescription" name="description" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Отправить заявку</button>
        </form>
    </div>
@endsection
