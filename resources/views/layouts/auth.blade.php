<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->

    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet" />
    @yield('style')
    <title>Blue Bear</title>
  </head>
  <body>

    
    <div class="container mt-5">
        @yield('content')
      </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    
    <script src="{{ secure_asset('js/app.js') }}"></script>
    @yield('js')
    
  </body>
</html>