<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pet Cafe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="assets/bootstrap-5.3.7-dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @yield('css_before')
  </head>
  <body>

  @if(View::hasSection('content'))
    @yield('content')
  @else
    @yield('showLogin')
  @endif


  <!-- <div class="container mt-2">
    <div class="row">
        @yield('showLogin')
    </div>
  </div> -->
  <!-- end showLogin  -->
   
  <script src="assets/bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js"></script>

  @yield('js_before')

  </body>
</html>
