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
                <label for="name_company" class="form-label">Название компании:</label>
                <input type="text" class="form-control" id="name_company" name="name_company" value="{{ $user->name_company }}" required>
            </div>

            <!-- Форма для загрузки изображений -->
            <div class="mb-3">
                <label for="gallery_images" class="form-label">Загрузить изображения:</label>
                <input type="file" class="form-control-file" id="gallery_images" name="gallery_images[]" multiple accept="image/*">
            </div>

            <!-- Отображение загруженных изображений -->
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @if($user->images && $user->images->isNotEmpty())
                    @foreach ($user->images as $image)
                        <div class="col">
                            <div class="card h-100">
                                <img src="{{ Storage::url($image->image_path) }}" class="card-img-top img-fluid" alt="Image" style="max-height: 100%; max-width: 100%;">
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col">
                        <p>Нет загруженных изображений.</p>
                    </div>
                @endif
            </div>




            <div class="mb-3">
                <label for="full_name" class="form-label">ФИО директора:</label>
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

            <div class="mb-3">
                <label for="address" class="form-label">Адрес:</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Описание:</label>
                <textarea class="form-control" id="description" name="description" required>{{ $user->description }}</textarea>
            </div>

            <div class="mb-3 img_license_form">
                <label for="license" class="form-label">Лицензия:</label>
                @if($user->license)
                    <p>Текущая лицензия:</p>
                    <img class="img_license" src="{{ Storage::url($user->license) }}" alt="Лицензия">
                @else
                    <p>Нет загруженной лицензии.</p>
                @endif
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

            <div class="form-group">
                <label for="latitude">Широта:</label>
                <input type="text" class="form-control" id="latitude" name="latitude" value="{{ $user->latitude }}">
            </div>

            <div class="form-group">
                <label for="longitude">Долгота:</label>
                <input type="text" class="form-control" id="longitude" name="longitude" value="{{ $user->longitude }}">
            </div>
            <div id="map"></div>


            <div class="d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-success">Сохранить</button>
                <a href="{{ route('user.show', auth()->user()->id) }}" class="btn btn-primary">Посмотреть мою карточку</a>
            </div>
        </form>
    </div>

    <script>
        ymaps.ready(function () {
            var myPlacemark,
                myMap = new ymaps.Map('map', {
                    center: [57.5262, 38.3061], // Углич
                    zoom: 11,
                    behaviors: ['default', 'scrollZoom']
                }, {
                    balloonMaxWidth: 200,
                    searchControlProvider: 'yandex#search'
                });

            // Слушаем клик на карте.
            myMap.events.add('click', function (e) {
                var coords = e.get('coords');

                // Если метка уже создана – просто передвигаем ее.
                if (myPlacemark) {
                    myPlacemark.geometry.setCoordinates(coords);
                }
                // Если нет – создаем.
                else {
                    myPlacemark = createPlacemark(coords);
                    myMap.geoObjects.add(myPlacemark);
                    // Слушаем событие окончания перетаскивания на метке.
                    myPlacemark.events.add('dragend', function () {
                        var newCoords = myPlacemark.geometry.getCoordinates();
                        getAddress(newCoords);
                        updateCoordinatesInputs(newCoords);
                    });
                }
                getAddress(coords);
                updateCoordinatesInputs(coords);
            });

            // Создание метки.
            function createPlacemark(coords) {
                return new ymaps.Placemark(coords, {
                    iconCaption: 'поиск...'
                }, {
                    preset: 'islands#violetDotIconWithCaption',
                    draggable: true
                });
            }

            // Определение местоположения пользователя
            ymaps.geolocation.get().then(function (res) {
                var mapContainer = $('#map'),
                    bounds = res.geoObjects.get(0).properties.get('boundedBy'),
                    // Рассчитываем видимую область для текущего положения пользователя.
                    mapState = ymaps.util.bounds.getCenterAndZoom(
                        bounds,
                        [mapContainer.width(), mapContainer.height()]
                    );
                myMap.setCenter(mapState.center, mapState.zoom);
            }, function (e) {
                // Если местоположение невозможно получить, то просто оставляем карту без изменений.
            });

            function getAddress(coords) {
                myPlacemark.properties.set('iconCaption', 'поиск...');
                ymaps.geocode(coords).then(function (res) {
                    var firstGeoObject = res.geoObjects.get(0);
                    var address = firstGeoObject.getAddressLine();
                    // Заполняем поле с адресом
                    document.getElementById('address').value = address;

                    myPlacemark.properties
                        .set({
                            // Формируем строку с данными об объекте.
                            iconCaption: [
                                // Название населенного пункта или вышестоящее административно-территориальное образование.
                                firstGeoObject.getLocalities().length ? firstGeoObject.getLocalities() : firstGeoObject.getAdministrativeAreas(),
                                // Получаем путь до топонима, если метод вернул null, запрашиваем наименование здания.
                                firstGeoObject.getThoroughfare() || firstGeoObject.getPremise()
                            ].filter(Boolean).join(', '),
                            // В качестве контента балуна задаем строку с адресом объекта.
                            balloonContent: address
                        });
                });
            }

            // Обновление значений широты и долготы в полях ввода
            function updateCoordinatesInputs(coords) {
                document.getElementById('latitude').value = coords[0];
                document.getElementById('longitude').value = coords[1];
            }

            // Добавление обработчика для двойного клика для увеличения карты
            myMap.events.add('dblclick', function (e) {
                var newZoom = myMap.getZoom() + 1;
                myMap.setZoom(newZoom, { duration: 400 });
            });
        });

    </script>
@endsection

