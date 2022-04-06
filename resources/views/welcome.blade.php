<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Kelas Produktif HIMATIF</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="antialiased">
        <div id="vue-app"></div>
    </body>
</html>
