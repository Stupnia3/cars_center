@extends('layout')

@section('title', 'Личный кабинет')

@section('content')
    <div class="container bg-white p-4 rounded shadow mt-4">
        <h2>Личный кабинет</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="full_name" class="form-label">ФИО:</label>
                <input type="text" class="form-control" id="full_name" name="full_name" value="{{ $user->full_name }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Телефон:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required>
            </div>

            <div class="mb-3">
                <label for="INN" class="form-label">ИНН:</label>
                <input type="text" class="form-control" id="INN" name="INN" value="{{ $user->INN }}" required>
            </div>

            <div style="width: 200px; height: fit-content;" class="mb-3">
                <img src="{{ Storage::url('img/licenses/' . $user->license) }}" alt="License">
            </div>

            <div class="mb-3">
                <label for="license" class="form-label">Лицензия:</label>
                <input type="file" class="form-control-file" id="license" name="license" accept=".pdf,.png,.jpg">
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="shinomontazh" name="shinomontazh" value="1" @if($user->shinomontazh) checked @endif>
                <label class="form-check-label" for="shinomontazh">Шиномонтаж</label>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="sto" name="sto" value="1" @if($user->sto) checked @endif>
                <label class="form-check-label" for="sto">СТО</label>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="diagnostika" name="diagnostika" value="1" @if($user->diagnostika) checked @endif>
                <label class="form-check-label" for="diagnostika">Диагностика</label>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remont_mkpp_akpp" name="remont_mkpp_akpp" value="1" @if($user->remont_mkpp_akpp) checked @endif>
                <label class="form-check-label" for="remont_mkpp_akpp">Ремонт мкпп и АКПП</label>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remont_dvigatelya" name="remont_dvigatelya" value="1" @if($user->remont_dvigatelya) checked @endif>
                <label class="form-check-label" for="remont_dvigatelya">Работа и ремонт двигателя</label>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-success">Сохранить</button>
                <a href="{{ route('user.show', auth()->user()->id) }}" class="btn btn-primary">Посмотреть мою карточку</a>
            </div>
        </form>
    </div>
@endsection
