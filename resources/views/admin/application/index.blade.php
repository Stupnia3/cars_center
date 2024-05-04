@extends('layout')

@section('title')
    Все заявки
@endsection

@section('content')
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        form {
            display: inline-block;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .confirm-button {
            background-color: #4caf50;
            color: white;
        }

        .confirm-button:hover {
            background-color: #45a049;
        }

        .reject-button {
            background-color: #f44336;
            color: white;
        }

        .reject-button:hover {
            background-color: #d32f2f;
        }

        .cancel-button {
            background-color: #d32f2f;
            color: white;
        }

        .cancel-button:hover {
            background-color: #b71c1c;
        }
    </style>

    <div class="container mt-5">
        <h1>Список пользователей</h1>
        <table>
            <thead>
            <tr>
                <th>Имя пользователя</th>
                <th>E-mail</th>
                <th>Телефон</th>
                <th>ИНН</th>
                <th>Лицензия</th>
                <th>Роль</th>
                <th>Статус заявки</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users->reverse() as $user)
                @if($user->role !== 'admin' && $user->status !== 'deleted')
                    <tr>
                        <td>{{ $user->full_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td style="text-wrap: nowrap;">{{ $user->phone }}</td>
                        <td>{{ $user->INN }}</td>
                        <td><img src="{{ Storage::url('img/licenses/' . $user->license) }}" alt="License"></td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->status }}</td>
                        <td>
                            <form action="{{ route('admin.users.update', $user->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <button type="submit" name="status" value="active" class="confirm-button">Активировать</button>
                                <button type="submit" name="status" value="blocked" class="btn btn-warning mt-2">Заблокировать</button>
                            @if ($user->status !== 'new')
                                    <button type="submit" name="status" value="deleted" class="btn btn-danger mt-2">Удалить</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
