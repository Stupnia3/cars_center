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
            cursor: pointer;
        }

        th {
            background-color: #f2f2f2;
        }

        th.sorted-asc::after {
            content: " ▲";
        }

        th.sorted-desc::after {
            content: " ▼";
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
        <table id="userTable">
            <thead>
            <tr>
                <th onclick="sortTable(0)" data-column="0">Имя пользователя</th>
                <th onclick="sortTable(1)" data-column="1">E-mail</th>
                <th onclick="sortTable(2)" data-column="2">Телефон</th>
                <th onclick="sortTable(3)" data-column="3">ИНН</th>
                <th onclick="sortTable(4)" data-column="4">Лицензия</th>
                <th onclick="sortTable(5)" data-column="5">Роль</th>
                <th onclick="sortTable(6)" data-column="6">Статус заявки</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users->reverse() as $user)
                @if($user->role !== 'admin' && $user->status !== 'deleted')
                    <tr>
                        <td>{{ $user->full_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->INN }}</td>
                        <td>@if($user->license)
                                <img class="img_license" src="{{ Storage::url($user->license) }}" alt="Лицензия">
                            @else
                                <p class="text-danger">Нет лицензии</p>
                            @endif</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $statusTranslations[$user->status] }}</td>
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

    <script>
        function sortTable(columnIndex) {
            let table = document.getElementById("userTable");
            let rows = Array.from(table.rows).slice(1);
            let sortedAsc = table.querySelectorAll('th')[columnIndex].classList.contains('sorted-asc');

            rows.sort((a, b) => {
                let aText = a.cells[columnIndex].innerText.toLowerCase();
                let bText = b.cells[columnIndex].innerText.toLowerCase();

                if (!isNaN(aText) && !isNaN(bText)) {
                    return sortedAsc ? aText - bText : bText - aText;
                } else {
                    return sortedAsc ? aText.localeCompare(bText) : bText.localeCompare(aText);
                }
            });

            rows.forEach(row => table.tBodies[0].appendChild(row));

            let ths = table.querySelectorAll('th');
            ths.forEach(th => th.classList.remove('sorted-asc', 'sorted-desc'));
            ths[columnIndex].classList.add(sortedAsc ? 'sorted-desc' : 'sorted-asc');
        }
    </script>
@endsection
