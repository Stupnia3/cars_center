@extends('layout')

@section('title')
    Ваши заявки
@endsection

@section('content')
    <div class="container mt-5">
        <h2>Мои заявки</h2>
        @if($applications->isEmpty())
            <p>У вас нет заявок.</p>
        @else
            @foreach($applications as $application)
                <div class="mt-4">
                    <strong>Номер автомобиля:</strong> {{ $application->car_number }}<br>
                    <strong>Описание:</strong> {{ $application->description }}
                </div>
                <hr>
            @endforeach
        @endif
    </div>
@endsection
