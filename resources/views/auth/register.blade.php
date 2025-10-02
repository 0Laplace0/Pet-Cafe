@extends('frontendAuth')
@section('content')

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
                    style="width:36px;height:36px; top:-70px; right:30px;"
                    onclick="location.href='/login'">
            <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="text-center mb-4">
            <i class="fa-solid fa-user-plus fa-5x text-brown"></i>
            </div>

            <form method="POST" action="/register" class="px-4 pb-4">
                @csrf

                <div class="form-group row mb-2">
                    <div class="input-group mb-3">
                    <input type="text"
                            name="user_name"
                            class="form-control form-control-lg rounded-pill @error('user_name') is-invalid @enderror"
                            placeholder="Username" required minlength="4"
                            autocomplete="name"
                            value="{{ old('user_name') }}">
                    <span class="input-group-text rounded-pill end-icon">
                        <i class="fa-regular fa-user icon-right text-brown"></i>
                    </span>
                    </div>
                    @error('user_name') <div class="text-danger px-2">{{ $message }}</div> @enderror
                </div>

                <div class="form-group row mb-2">
                    <div class="input-group mb-3">
                    <input type="email"
                            name="user_email"
                            class="form-control form-control-lg rounded-pill @error('user_email') is-invalid @enderror"
                            placeholder="Email" required
                            autocomplete="email"
                            value="{{ old('user_email') }}">
                    <span class="input-group-text rounded-pill end-icon">
                        <i class="fa-solid fa-at icon-right text-brown"></i>
                    </span>
                    </div>
                    @error('user_email') <div class="text-danger px-2">{{ $message }}</div> @enderror
                </div>

                <div class="form-group row mb-2">
                    <div class="input-group mb-3">
                    <input type="password"
                            name="user_password"
                            class="form-control form-control-lg rounded-pill @error('user_password') is-invalid @enderror"
                            placeholder="Password" required minlength="4"
                            autocomplete="new-password">
                    <span class="input-group-text rounded-pill end-icon">
                        <i class="fa-solid fa-lock icon-right text-brown"></i>
                    </span>
                    </div>
                    @error('user_password') <div class="text-danger px-2">{{ $message }}</div> @enderror
                </div>

                <div class="form-group row mb-2">
                    <div class="input-group mb-3">
                    <input type="password"
                            name="user_password_confirmation"
                            class="form-control form-control-lg rounded-pill"
                            placeholder="Confirm Password" required minlength="4"
                            autocomplete="new-password">
                    <span class="input-group-text rounded-pill end-icon">
                        <i class="fa-solid fa-lock icon-right text-brown"></i>
                    </span>
                    </div>
                    @error('user_password_confirmation') <div class="text-danger px-2">{{ $message }}</div> @enderror
                </div>

                <div class="form-group row mb-2">
                    <div class="input-group mb-4">
                    <input type="tel"
                            name="user_tel"
                            class="form-control form-control-lg rounded-pill @error('user_tel') is-invalid @enderror"
                            placeholder="Phone (10 digits)" required
                            inputmode="numeric" minlength="10" maxlength="10"
                            value="{{ old('user_tel') }}">
                    <span class="input-group-text rounded-pill end-icon">
                        <i class="fa-solid fa-phone icon-right text-brown"></i>
                    </span>
                    </div>
                    @error('user_tel') <div class="text-danger px-2">{{ $message }}</div> @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-brown btn-lg rounded-pill py-3 fw-bold">
                    Create account
                    </button>
                </div>
            </form>
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