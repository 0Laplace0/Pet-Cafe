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

    @include('layouts.navbar')

    @include('layouts.banner')

  <!-- Start  -->
    <div class="container mb-5">
      <div id="Info" class="row rounded-5 mt-5 col-12 col-sm-12 col-md-12 col-lg-12" data-aos="fade-up">
        <div id="Info01" class="col-lg-6 p-4">
          <img src="{{ asset('storage/uploads/food/sLoEleOCnxopKHj2LvJHOrqNp81CSa1Opokz4aDH.png') }}" class="img-fluid rounded-5" alt="...">
        </div>
        <div id="Info02" class="col-lg-5 p-3">
          <h3 class="fs-1 bw-bolder mt-3">Story</h3>
          <h5 class="mt-3">( กฤษฎิ์พนิช ธีระเกียรติกุล )</h5>
          <h5 class="fs-3 bw-bolder mt-3">Info : </h5>
          <h5 class="mt-3">Student ID : 2213110766</h5>
        </div>
      </div>
    </div>
  <!-- End  -->

  <!-- Start Product Title -->
    <div class="container mt-4" data-aos="fade-up">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-12">
          <div class="alert alert-dismissible fade show text-white" role="alert" style="background-color: #8D6E63; font-size: x-large;" data-aos="fade-up">
            <b>Recommend Menu</b>
          </div>
        </div>
      </div>
    </div>
    <!-- End Product Title -->

  <!-- Start Recommend Menu  -->
    <div class="container mt-2">
      <div class="row">
        <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3" data-aos="fade-up">
          <div id="card" class="card border-custom h-100" style="width: 100%;">
              <img src="{{ asset('storage/uploads/food/sLoEleOCnxopKHj2LvJHOrqNp81CSa1Opokz4aDH.png') }}" class="card-img-top">
              <div class="card-body">
                <h5 class="card-title">Mojo-Marinated Chicken</h5>
                <a id="bt" href="#" class="btn">View Recipes</a>
              </div>
          </div>
        </div>

        <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3" data-aos="fade-up">
          <div id="card" class="card border-custom h-100" style="width: 100%;">
              <img src="{{ asset('storage/uploads/food/sLoEleOCnxopKHj2LvJHOrqNp81CSa1Opokz4aDH.png') }}" class="card-img-top">
              <div class="card-body">
                <h5 class="card-title">Mojo-Marinated Chicken</h5>
                <a id="bt" href="#" class="btn">View Recipes</a>
              </div>
          </div>
        </div>

        <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3" data-aos="fade-up">
          <div id="card" class="card border-custom h-100" style="width: 100%;">
              <img src="{{ asset('storage/uploads/food/sLoEleOCnxopKHj2LvJHOrqNp81CSa1Opokz4aDH.png') }}" class="card-img-top">
              <div class="card-body">
                <h5 class="card-title">Mojo-Marinated Chicken</h5>
                <a id="bt" href="#" class="btn">View Recipes</a>
              </div>
          </div>
        </div>

        <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3" data-aos="fade-up">
          <div id="card" class="card border-custom h-100" style="width: 100%;">
              <img src="{{ asset('storage/uploads/food/sLoEleOCnxopKHj2LvJHOrqNp81CSa1Opokz4aDH.png') }}" class="card-img-top">
              <div class="card-body">
                <h5 class="card-title">Mojo-Marinated Chicken</h5>
                <a id="bt" href="#" class="btn">View Recipes</a>
              </div>
          </div>
        </div>
      </div>
    </div>
  <!-- end Recommend Menu  -->

  <div class="container mt-3 mb-2">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-12">
        <div class="alert alert-dismissible fade show text-white" role="alert" style="background-color: #8D6E63; font-size: x-large;" data-aos="fade-up">
          :: Show Pet ::
        </div>
      </div>
    </div>
  </div>
  @yield('navbar')

  <div class="container mt-2">
    <div class="row">
        @yield('showPet')
    </div>
  </div>
  <!-- end Pet  -->

  <!-- Start Footer -->
    @include('layouts.footer')
  <!-- End Footer -->
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="assets/bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js"></script>

    @yield('js_before')

  </body>
</html>
