<!-- Start Navbar -->
    <nav id="nav" class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand logo" href="/"><img src="{{ asset('asset/icon/icon.png') }}" alt="Icon" height="80"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="/">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Pets
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/dog">Dog</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="/cat">Cat</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="/raccoon">Raccoon</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/menu">Foods</a>
            </li>

          </ul>
          <ul class="navbar-nav ms-auto">
            @guest('admin')
              <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
              </li>
            @endguest

            @auth('admin')
              @php
                $u = Auth::guard('admin')->user();
                $displayName = $u->user_name ?: strtok($u->user_email, '@');
              @endphp

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                  {{ $displayName }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  @if (strtolower((string)$u->user_role) === 'staff')
                    <li><a class="dropdown-item" href="/dashboard">BackOffice</a></li>
                    <li><hr class="dropdown-divider"></li>
                  @endif
                  <li class="nav-item">
                    <a id="logoutBtn" href="/" class="dropdown-item"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout 
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                      @csrf
                    </form>
                  </li>
                </ul>
              </li>
              <form id="logout-admin" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            @endauth
          </ul>
          <!-- <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form> -->
        </div>
      </div>
    </nav>
<!-- End Navbar -->