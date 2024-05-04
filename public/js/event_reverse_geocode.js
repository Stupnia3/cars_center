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
