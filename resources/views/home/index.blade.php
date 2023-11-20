<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.2/css/bootstrap.min.css">
</head>
<body>

    <div class="d-flex flex-column justify-content-between min-vh-100 text-center"> {{-- d-flex flex-column все элементы в одной строчке--}}

        @include('includes.header') {{-- 'includes.header.foo.bar' - если вложен не один каталог в файл, вставляем код для header из другого файла--}}

        <main class="flex-grow-1 py-3"> {{--занимает все свободное пространство между шапкой и подвалом--}}
            <h1>

                Главная страница

            </h1>
        </main>

        @include('includes.footer')

    </div>

{{--@php // @php($foo = 'bar') директивы - это команды, которые мы можем указывать и они выполняют определенные функции, начинаются с @, дальше в коде объявленная здесь переменная будет доступна, подходит для мелкого вывода на страницах, лучше создавать в других разделах, закрывающая директива endphp
    $foo = '<h2>Привет</h2>';
    $time = time();
@endphp--}} {{--Закрывающая директива--}}

{{--@if($foo === 'bar2')
    <p>
        Да
    </p>
@else
    <p>
        Нет
    </p>
@endif--}}

{{--{{ $foo }}--}} {{--можно вводить php код, сложение или строки, значение переменных, внутри интерполяции laravel очищает значение, код выводится текстом, защищая от уязвимостей --}}
{{--{!! $foo !!}--}} {{--чтобы отобразить html код не текстом, использовать с осторожностью, когда опасный код удален--}}
{{--@{{ $foo }}--}} {{--если нужно оставить скобки для шаблона javascript, или шаблонов vue.js, добавляем в начале @, иначе blade распознает как свои скобки--}}
{{--@json(['foo' => 'bar']) --}}{{--функция принимает массив и выводит json {"foo":"bar"}--}}{{--

<script>
    window.App = @json(['locale' => config('app.locale')]) /*выводим язык приложения через json*/
    /*window.App = {
        locale: "{{ config('app.locale') }}" /!*выводим язык приложения*!/
    }*/
</script>--}}
{{--@foreach([1,2,3] as $value) --}}{{--цикл в который можно передать массив, как значение--}}{{--
    {{ $value }} --}}{{--интерполяция {{  }}, вывести значение переменной--}}{{--
@endforeach--}}

{{--@for($i = 0; $i < 10; $i++) --}}{{--цикл for--}}{{--
{{ $i }}
@endfor--}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.2/js/bootstrap.min.js"></script>

</body>
</html>
