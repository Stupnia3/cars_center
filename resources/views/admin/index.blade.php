@extends('layout')

@section('title', 'Личный кабинет')

@php
    $user = \Illuminate\Support\Facades\Auth::user();
@endphp

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Добро пожаловать, {{ $user->full_name }}</h2>
                    </div>
                    <div class="card-body">
                        <p class="lead">Это ваша административная панель, где вы можете управлять заявками.</p>
                        <h3 class="mt-4">Дополнительная информация:</h3>
                        <ul class="list-group">
                            <li class="list-group-item">Логин: {{ $user->login }}</li>
                            <!-- Добавьте другие поля пользователя, если необходимо -->
                        </ul>
                    </div>
                    <div class="card-footer text-center">
                        <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
                            <a href="{{ route('admin.application.index') }}" class="btn btn-primary">Все заявки</a>
                            <a href="{{ route('add-admin') }}" class="btn btn-warning">Добавить администратора</a>
                            <a href="{{ route('logout') }}" class="btn btn-danger">Выход</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
