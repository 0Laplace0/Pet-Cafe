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

    @php
      $u = Auth::guard('admin')->user();
      $displayName = $u
          ? ($u->user_name ?: strstr($u->user_email, '@', true))
          : '';
    @endphp

  <div class="container-fluid mt-2">
    <div class="row g-0 align-items-stretch"><!-- เพิ่ม align-items-stretch -->

      <aside class="col-12 col-md-3 col-lg-2 bg-light border-end min-vh-100 d-flex flex-column">
        <div class="sticky-top" style="top:0;">
          <div class="px-3 py-3" style="background:#8D6E63;color:#fff;">
            <div class="fw-bold">ยินดีต้อนรับ, {{ $displayName }}</div>
            <small class="opacity-75">{{ ucfirst((string)($u->user_role ?? '')) }}</small>
          </div>
        </div>

        <div class="list-group list-group-flush mt-3">
          <a href="/"          class="list-group-item list-group-item-action active">Home</a>
          <a href="/dashboard" class="list-group-item list-group-item-action">- Dashboard -</a>
          <a href="/user"      class="list-group-item list-group-item-action">- UserCRUD -</a>
          <a href="/pet"       class="list-group-item list-group-item-action">- PetCRUD -</a>
          <a href="/food"      class="list-group-item list-group-item-action">- FoodCRUD -</a>

          <a href="#"
            class="list-group-item list-group-item-action text-danger bg-danger-subtle"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            - Logout -
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </div>

        @yield('sidebarMenu')

        <div class="flex-grow-1"></div> <!-- เติมตัวนี้ให้ยืดเต็มสูงสุด -->
      </aside>

      <main class="col-12 col-md-9 col-lg-10 p-3 d-flex flex-column"><!-- d-flex flex-column -->
        @yield('header')
        @yield('content')
      </main>

    </div>
  </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

    @yield('js_before')

    {{-- >>>>>>> ตรงนี้สำคัญ <<<<<<< --}}
    @include('sweetalert::alert')

  </body>
</html>
