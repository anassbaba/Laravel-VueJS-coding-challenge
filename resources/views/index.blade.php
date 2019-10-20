<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>

      @include('layouts.nav')

      @if(Session::has('message'))
      <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
      @endif
      <main class="py-4">
            <div class="flex-center position-ref full-height">
                <div class="content">
                  <div id="app">
                    <example-component></example-component>
                  </div>
                </div>
            </div>
      </main>




      <script src="{{ asset('js/app.js') }}"></script>
      <script src="{{ asset('js/main.js') }}"></script>
    </body>
</html>
