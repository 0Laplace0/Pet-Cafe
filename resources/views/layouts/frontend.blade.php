<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pet Cafe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @yield('css_before')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
    <style>
      :root{
        --cream:#F6EDE3;
        --card:#D9C4AE;
        --brand:#8D6E63;
      }
      body{ background:var(--cream); }
      .slide-card{
        background:var(--card);
        border-radius:28px;
        padding:28px;
        height:100%;
        display:flex; flex-direction:column; align-items:center; justify-content:center;
      }
      .slide-photo{
        width:260px; height:260px;
        border-radius:50%;
        object-fit:cover;
        display:block;
        box-shadow:0 10px 30px rgba(0,0,0,.08);
      }
      .slide-name{ margin-top:12px; font-weight:700; color:#3d3d3d; }
      /* ปุ่มลูกศรกลม ๆ */
      .swiper-button-next, .swiper-button-prev{
        width:64px; height:64px;
        background:#e7aa9b;
        color:#fff; border-radius:50%;
        box-shadow:0 8px 24px rgba(0,0,0,.12);
      }
      .swiper-button-next::after, .swiper-button-prev::after{ font-size:24px; }
    </style>
  <body>

  @include('layouts.navbar')
  @include('layouts.banner')

  @if (request()->is('/'))
    @include('layouts.homeInfo')
  @endif

    <div class="container mb-5">
      <div class="container">
        <div class="row">
            @yield('showPet')
        </div>
      </div>
    </div>

  <!-- Start Footer -->
    @include('layouts.footer')
  <!-- End Footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="assets/bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
      new Swiper('.slide-swiper', {
        loop: true,
        spaceBetween: 32,
        slidesPerView: 1.1,
        grabCursor: true,
        breakpoints: {
          576:  { slidesPerView: 2 },
          992:  { slidesPerView: 3 },
          1400: { slidesPerView: 3 }
        },
        navigation: {
          nextEl: '.slide-swiper .swiper-button-next',
          prevEl: '.slide-swiper .swiper-button-prev',
        },
      });
    </script>

    @yield('js_before')

  </body>
</html>