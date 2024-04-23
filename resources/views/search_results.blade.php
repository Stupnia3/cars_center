@extends('layout')

@section('title', 'Результаты поиска')

@section('content')
    <div class="container">
        <h1 class="mt-4">Результаты поиска</h1>
        <input type="text" id="searchInput" class="form-control" placeholder="Введите запрос">
        <ul id="searchResults" class="list-group mt-3"></ul>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                var query = $(this).val();
                if (query.length >= 3) { // Проверяем, что введено минимум 3 символа
                    $.ajax({
                        url: '{{ route("search") }}',
                        method: 'GET',
                        data: { query: query },
                        success: function(response) {
                            $('#searchResults').empty();
                            $.each(response.users, function(index, user) {
                                $('#searchResults').append('<li class="list-group-item">' + user.full_name + '</li>');
                            });
                        }
                    });
                } else {
                    $('#searchResults').empty(); // Очищаем результаты, если запрос слишком короткий
                }
            });
        });
    </script>
@endpush
