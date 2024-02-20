document.addEventListener("DOMContentLoaded", function() {
    // Получаем элементы формы
    var innInput = document.getElementById("INN");

    // Применяем маску при вводе
    innInput.addEventListener("input", function(event) {
        var value = event.target.value.replace(/\D/g, ''); // Удаляем все нецифровые символы

        if (value.length > 12) { // Если ИНН более 12 символов, обрезаем до 12
            value = value.substring(0, 12);
        }

        if (value.length === 10) { // Если ИНН юридическое лицо
            value = value.replace(/(\d{2})(\d{3})(\d{3})(\d{2})/, "$1 $2 $3 $4");
        } else if (value.length === 12) { // Если ИНН физическое лицо
            value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{3})/, "$1 $2 $3 $4");
        }

        event.target.value = value;
    });
});

document.addEventListener("DOMContentLoaded", function() {
    // Получаем элемент input с типом file
    var fileInput = document.getElementById("License");

    // Добавляем обработчик события change
    fileInput.addEventListener("change", function(event) {
        // Получаем выбранные файлы
        var files = event.target.files;

        // Проверяем каждый файл
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var extension = file.name.split('.').pop().toLowerCase(); // Получаем расширение файла

            // Проверяем расширение файла
            if (extension !== 'pdf' && extension !== 'png' && extension !== 'jpg') {
                alert('Допустимы только файлы форматов .pdf, .png, .jpg');
                event.target.value = ''; // Сбрасываем значение input, чтобы пользователь мог выбрать другой файл
                return;
            }
        }
    });
});

