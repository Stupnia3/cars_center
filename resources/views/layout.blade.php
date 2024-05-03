<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>@yield('title')</title>
    <style>
        #map {
            height: 400px;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <header class="header">
        <div class="header__container container flex">
            <div class="logo__container flex">
                <a href="{{route('welcome')}}" class="logo__picture">
                    <img src="{{asset('storage/img/images/Black logo - no background.svg')}}" alt="Логотип компании">
                </a>
                <a href="{{route('welcome')}}" class="logo__name font-size-average">Автосервисы</a>
            </div>
            <nav class="navigation">
                <ul class="navigation__user ">
                    <li>
                        <a href="{{route('search')}}" class="navigation__user__link">
                            Поиск
                        </a>
                    </li>
                    @if(!\Illuminate\Support\Facades\Auth::user())
                    <li class="navigation__user__item ">
                        <a class="navigation__user__link" href="{{route('register')}}">Оставить заявку</a>
                    </li>
                    <li class="navigation__user__item ">
                        <a class="navigation__user__link login__btn border border-dark p-3 rounded text-white" href="{{ route('login') }}">Войти</a>
                    </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->role === \App\Enums\RoleEnum::USER->value)
                        <li class="navigation__user__item ">
                            <a class="navigation__user__link" href="{{route('user')}}">Личный кабинет</a>
                        </li>
                        <li class="navigation__user__item">
                            <a class="navigation__user__link" href="{{ route('user.show', auth()->user()->id) }}">Моя карточка</a>
                        </li>
                        <li class="navigation__user__item">
                            <a class="navigation__user__link login__btn border border-red p-3 rounded text-white" href="{{route('logout')}}">Выход</a>
                        </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->role === \App\Enums\RoleEnum::ADMIN->value)
                        <li class="navigation__user__item ">
                            <a class="navigation__user__link" href="{{route('user')}}">Личный кабинет</a>
                        </li>
                        <li class="navigation__user__item">
                            <a class="navigation__user__link" href="{{route('admin.application.index')}}">Все заявки</a>
                        </li>
                        <li class="navigation__user__item">
                            <a class="navigation__user__link" href="{{route('add-admin')}}">Добавить администратора</a>
                        </li>
                        <li class="navigation__user__item">
                            <a class="navigation__user__link exit__btn border border-red p-3 rounded text-white login__btn" href="{{route('logout')}}">Выход</a>
                        </li>
                    @endif
                </ul>
            </nav>
            <button class="burger-button burger"></button>
        </div>
    </header>
{{--                    <form class="form-inline my-2 my-lg-0 ml-auto" action="{{ route('search') }}" method="GET"--}}
{{--                          id="searchForm">--}}
{{--                        <input class="form-control mr-sm-2" placeholder="Поиск" aria-label="Search" name="query"--}}
{{--                               type="text" id="searchInput">--}}
{{--                        --}}{{--                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Найти</button>--}}
{{--                        <div id="searchResults" class="position-absolute bg-light border rounded"--}}
{{--                             style="display: none; top: 4rem!important; z-index: 10"></div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </nav>--}}
{{--        <div class="container position-relative">--}}
{{--            <div id="searchResults" class="position-absolute bg-light border rounded mt-1" style="display: none;"></div>--}}
{{--        </div>--}}
    @yield('content')
    <div id="debug" style="display: none"></div>
</div>
<script src="{{ asset('js/inn_validator.js') }}"></script>
<script src="{{ asset('js/burger.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('jquery.mask.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{asset('js/smooth-scroll.js')}}"></script>
<script>
    // Получаем ссылку на поле ввода, блок результатов поиска и блок для отладки
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');
    const debug = document.getElementById('debug');

    // Слушаем событие ввода в поле поиска
    searchInput.addEventListener('input', function () {
        // Получаем значение введенного текста
        const query = searchInput.value.trim();

        // Если введенный текст не пустой
        if (query !== '') {
            // Отправляем AJAX-запрос на сервер для выполнения поиска
            fetch(`{{ route('search') }}?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    // Очищаем блок результатов поиска
                    searchResults.innerHTML = '';

                    // Отображаем полученные данные для отладки
                    debug.textContent = JSON.stringify(data);

                    // Создаем счетчик для ограничения количества отображаемых карточек
                    let count = 0;

                    // Если есть результаты поиска, добавляем только совпадающие
                    if (data.users && data.users.length > 0) {
                        const listGroup = document.createElement('div');
                        listGroup.className = 'list-group';
                        data.users.forEach(user => {
                            // Проверяем, содержит ли пользователь хотя бы одно поле, совпадающее с запросом
                            if (
                                user.full_name.toLowerCase().includes(query.toLowerCase()) ||
                                user.name_company.toLowerCase().includes(query.toLowerCase()) ||
                                user.address.toLowerCase().includes(query.toLowerCase()) ||
                                user.description.toLowerCase().includes(query.toLowerCase()) ||
                                (user.shinomontazh && query.toLowerCase() === 'шиномонтаж') ||
                                (user.sto && query.toLowerCase() === 'сто') ||
                                (user.diagnostika && query.toLowerCase() === 'диагностика') ||
                                (user.remont_mkpp_akpp && query.toLowerCase() === 'ремонт мкпп или акпп') ||
                                (user.remont_dvigatelya && query.toLowerCase() === 'ремонт двигателя')
                            ) {

                                // Формируем текст для отображения в элементе списка
                                let text = `${user.name_company}, ${user.full_name}, ${user.address}`;
                                if (user.shinomontazh) {
                                    text += ', Шиномонтаж';
                                }
                                if (user.sto) {
                                    text += ', СТО: Да';
                                }
                                if (user.diagnostika) {
                                    text += ', Диагностика';
                                }
                                if (user.remont_mkpp_akpp) {
                                    text += ', Ремонт МКПП и АКПП';
                                }
                                if (user.remont_dvigatelya) {
                                    text += ', Работа и ремонт двигателя';
                                }

                                // Создаем элемент списка для каждого пользователя
                                const listItem = document.createElement('a');
                                listItem.textContent = text;
                                listItem.className = 'list-group-item list-group-item-action';

                                // Добавляем обработчик события для выбора результата
                                listItem.addEventListener('click', function () {
                                    window.location.href = `/users/${user.id}`; // Перенаправляем на страницу пользователя
                                });

                                // Добавляем элемент списка в блок результатов поиска
                                listGroup.appendChild(listItem);

                                // Увеличиваем счетчик отображенных карточек
                                count++;

                                // Ограничиваем вывод результатов до трех
                                if (count >= 3) {
                                    return;
                                }
                            }
                        });

                        // Если найдены совпадения, отображаем блок результатов поиска
                        if (listGroup.children.length > 0) {
                            searchResults.appendChild(listGroup);
                            searchResults.style.display = 'block';
                        } else {
                            // Если результаты не найдены, отображаем сообщение
                            const message = document.createElement('div');
                            message.textContent = 'Результаты не найдены';
                            message.className = 'alert alert-warning';
                            searchResults.appendChild(message);
                            searchResults.style.display = 'block';
                        }
                    } else {
                        // Если результаты не найдены, отображаем сообщение
                        const message = document.createElement('div');
                        message.textContent = 'Результаты не найдены';
                        message.className = 'alert alert-warning';
                        searchResults.appendChild(message);
                        searchResults.style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Ошибка при выполнении поиска:', error);
                });
        } else {
            // Если введенный текст пустой, очищаем блок результатов поиска и скрываем его
            searchResults.innerHTML = '';
            searchResults.style.display = 'none';
        }
    });
</script>
</body>
</html>

