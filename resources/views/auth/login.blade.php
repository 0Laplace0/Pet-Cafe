@extends('frontendAuth')
@section('css_before')
@section('navbar')
@endsection

<!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif -->

<div class="container-fluid px-0 bg-cream">
  <div class="row g-0 vh-100 align-items-center">

    <div class="col-md-3 d-none d-md-block h-100 p-0">
      <img src="{{ asset('asset/banner/left.png') }}" 
            class="d-block w-100 h-100"
            style="object-fit: cover; object-position: left center;"
            alt="left">
    </div>

    <div class="col-12 col-md-6 py-5">
      <div class="login-card mx-auto position-relative">

        <button type="button"
            class="btn btn-sm btn-danger rounded-circle position-absolute"
            style="width:36px;height:36px; top:-40px; right:30px;"
            onclick="location.href='/'">
          <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="text-center mb-4">
            <i class="fa-solid fa-circle-user fa-10x text-brown"></i>
        </div>

        <form method="post" action="/login" class="px-4 pb-4">
          @csrf

            <div class="form-group row mb-2">
                <div class="input-group mb-3">
                    <input type="email" class="form-control form-control-lg rounded-pill is-invalid" 
                            name="user_email" placeholder="Input your Email" required autocomplete="email" autofocus
                            minlength="3" value="{{ old('user_email') }}">
                    @if(isset($errors))
                    @if($errors->has('user_email'))
                    <div class="text-danger"> {{ $errors->first('user_email') }}</div>
                    @endif
                    @endif
                    <span class="input-group-text rounded-pill end-icon"><i class="fa-regular fa-user icon-right text-brown"></i></span>
                </div>
            </div>

            <div class="form-group row mb-2">
                <div class="input-group mb-4">
                    <input type="password" class="form-control form-control-lg rounded-pill is-invalid" 
                            name="user_password" placeholder="Input your Password" required autocomplete="current-password"
                            minlength="3">
                    @if(isset($errors))
                    @if($errors->has('user_password'))
                    <div class="text-danger"> {{ $errors->first('user_password') }}</div>
                    @endif
                    @endif
                    <span class="input-group-text rounded-pill end-icon"><i class="fa-solid fa-lock icon-right text-brown"></i></span>
                </div>
            </div>

          <div class="d-grid">
            <button type="submit" class="btn btn-brown btn-lg rounded-pill py-3 fw-bold">Login</button>
          </div>
        </form>

        <hr class="login-divider">

        <div class="rounded-4 p-4 mt-4 text-center">
          <p class="mb-3">ยังไม่มีบัญชี? สมัครสมาชิกเพื่อจองคาเฟ่และรับสิทธิพิเศษ</p>
          <a href="/register" class="btn btn-brown btn-register">Register</a>
        </div>
      </div>
    </div>

    <div class="col-md-3 d-none d-md-block h-100 p-0">
        <img src="{{ asset('asset/banner/right.png') }}"
            class="d-block w-100 h-100"
            style="object-fit: cover; object-position: left center;"
            alt="right">
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@include('sweetalert::alert')

@endsection

@section('footer')
@endsection

@section('js_before')
@endsection