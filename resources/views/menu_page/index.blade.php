@extends('layouts.menu')

@section('showMenu')

<!-- Start Product Title -->
    <div class="container mt-4" data-aos="fade-up">
      <div class="row">
        <div class="col">
          <div class="alert alert-dismissible fade show text-white" role="alert" style="background-color: #8D6E63; font-size: x-large;" data-aos="fade-up">
            <b>Recommend Menu</b>
          </div>
        </div>
      </div>
    </div>
    <!-- End Product Title -->

  <div class="container mt-2">
      <div class="row">
        <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3" data-aos="fade-up">
          <div id="card" class="card border-custom h-100" style="width: 100%;">
            <img src="{{ asset('storage\uploads\food\kjTG9fGKQyJf0v0OUJ9hczoyV7lwmHW7TXElWm89.png') }}" class="card-img-top">
            <div class="card-body">
              <h4 class="card-title">Spaghetti</h4>
              <h5 class="card-title">Price : 149 THB.</h5>
            </div>
          </div>
        </div>

        <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3" data-aos="fade-up">
          <div id="card" class="card border-custom h-100" style="width: 100%;">
            <img src="{{ asset('storage\uploads\food\NVNyy7PpRULcWEWLKG3aPTkkYGJTTetT5VlncwAO.png') }}" class="card-img-top">
            <div class="card-body">
              <h4 class="card-title">Matcha Latte</h4>
              <h5 class="card-title">Price : 115 THB.</h5>
            </div>
          </div>
        </div>

        <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3" data-aos="fade-up">
          <div id="card" class="card border-custom h-100" style="width: 100%;">
            <img src="{{ asset('storage\uploads\food\VTYKq9CB5a9I1lDza0KA3KbRiYwmLy06K540bCJ8.png') }}" class="card-img-top">
            <div class="card-body">
              <h4 class="card-title">New York Cheesecake</h4>
              <h5 class="card-title">Price : 135 THB.</h5>
            </div>
          </div>
        </div>

        <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3" data-aos="fade-up">
          <div id="card" class="card border-custom h-100" style="width: 100%;">
            <img src="{{ asset('storage\uploads\food\NugHZgwIvSdoPNQGae2khuSmK6oYnvM4PW7dHD5r.png') }}" class="card-img-top">
            <div class="card-body">
              <h4 class="card-title">French Fries</h4>
              <h5 class="card-title">Price : 99 THB.</h5>
            </div>
          </div>
        </div>
      </div>
  </div>

  <!-- end Recommend Menu  -->

<!-- Start Savory Dishes -->
<div class="container mt-4" data-aos="fade-up">
  <div class="row">
    <div class="col">
      <div class="alert alert-dismissible fade show text-white" role="alert" style="background-color: #8D6E63; font-size: x-large;" data-aos="fade-up">
        <b>Savory Dishes Menu</b>
      </div>
    </div>
  </div>
  <!-- <div class="row">
    @foreach($savorydishes as $data)
      <div class="col-12 col-sm-4 col-md-4 col-lg-3 mb-3">
        <div class="card h-100">
          <a href="{{ url('/detail/' . $data->id) }}">
            <img src="{{ asset('storage/' . $data->food_img) }}" class="card-img-top">
          </a>
          <div class="card-body">
            <h5 class="card-title">{{ $data->food_name }}</h5>
            <p class="card-text text-end">Price : {{ $data->food_price }} THB.</p>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  <div class="mt-2 d-flex justify-content-center">
    {{ $savorydishes->links() }}
  </div> -->
</div>

<div class="swiper slide-swiper my-5">
  <div class="swiper-wrapper">
    @foreach($savorydishes as $data)
      <div class="swiper-slide">
        <div class="slide-card">
          <img class="slide-photo" src="{{ asset('storage/' . $data->food_img) }}" width="100" height="100">
          <div class="slide-name h4 text-center">{{ $data->food_name }}</div>
          <h4 class="card-text text-end">Price : {{ $data->food_price }} THB.</h4>
        </div>
      </div>
    @endforeach
  </div>

  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
</div>
<!-- End Savory Dishes -->

<!-- Start Appetizers -->
<div class="container mt-4" data-aos="fade-up">
  <div class="row">
    <div class="col">
      <div class="alert alert-dismissible fade show text-white" role="alert" style="background-color: #8D6E63; font-size: x-large;" data-aos="fade-up">
        <b>Appetizers Menu</b>
      </div>
    </div>
  </div>
  <!-- <div class="row">
    @foreach($appetizers as $data)
      <div class="col-12 col-sm-4 col-md-4 col-lg-3 mb-3">
        <div class="card h-100">
          <a href="{{ url('/detail/' . $data->id) }}">
            <img src="{{ asset('storage/' . $data->food_img) }}" class="card-img-top">
          </a>
          <div class="card-body">
            <h5 class="card-title">{{ $data->food_name }}</h5>
            <p class="card-text text-end">Price : {{ $data->food_price }} THB.</p>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  <div class="mt-2 d-flex justify-content-center">
    {{ $appetizers->links() }}
  </div> -->
</div>

<div class="swiper slide-swiper my-5">
  <div class="swiper-wrapper">
    @foreach($appetizers as $data)
      <div class="swiper-slide">
        <div class="slide-card">
          <img class="slide-photo" src="{{ asset('storage/' . $data->food_img) }}" width="100" height="100">
          <div class="slide-name h4 text-center">{{ $data->food_name }}</div>
          <h4 class="card-text text-end">Price : {{ $data->food_price }} THB.</h4>
        </div>
      </div>
    @endforeach
  </div>

  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
</div>
<!-- End Appetizers -->

<!-- Start Desserts -->
<div class="container mt-4" data-aos="fade-up">
  <div class="row">
    <div class="col">
      <div class="alert alert-dismissible fade show text-white" role="alert" style="background-color: #8D6E63; font-size: x-large;" data-aos="fade-up">
        <b>Desserts Menu</b>
      </div>
    </div>
  </div>
  <!-- <div class="row">
    @foreach($desserts as $data)
      <div class="col-12 col-sm-4 col-md-4 col-lg-3 mb-3">
        <div class="card h-100">
          <a href="{{ url('/detail/' . $data->id) }}">
            <img src="{{ asset('storage/' . $data->food_img) }}" class="card-img-top">
          </a>
          <div class="card-body">
            <h5 class="card-title">{{ $data->food_name }}</h5>
            <p class="card-text text-end">Price : {{ $data->food_price }} THB.</p>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  <div class="mt-2 d-flex justify-content-center">
    {{ $desserts->links() }}
  </div> -->
</div>

<div class="swiper slide-swiper my-5">
  <div class="swiper-wrapper">
    @foreach($desserts as $data)
      <div class="swiper-slide">
        <div class="slide-card">
          <img class="slide-photo" src="{{ asset('storage/' . $data->food_img) }}" width="100" height="100">
          <div class="slide-name h4 text-center">{{ $data->food_name }}</div>
          <h4 class="card-text text-end">Price : {{ $data->food_price }} THB.</h4>
        </div>
      </div>
    @endforeach
  </div>

  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
</div>
<!-- End Desserts -->

<!-- Start Beverages -->
<div class="container mt-4" data-aos="fade-up">
  <div class="row">
    <div class="col">
      <div class="alert alert-dismissible fade show text-white" role="alert" style="background-color: #8D6E63; font-size: x-large;" data-aos="fade-up">
        <b>Beverages Menu</b>
      </div>
    </div>
  </div>
  <!-- <div class="row">
    @foreach($beverages as $data)
      <div class="col-12 col-sm-4 col-md-4 col-lg-3 mb-3">
        <div class="card h-100">
          <a href="{{ url('/detail/' . $data->id) }}">
            <img src="{{ asset('storage/' . $data->food_img) }}" class="card-img-top">
          </a>
          <div class="card-body">
            <h5 class="card-title">{{ $data->food_name }}</h5>
            <p class="card-text text-end">Price : {{ $data->food_price }} THB.</p>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  <div class="mt-2 d-flex justify-content-center">
    {{ $beverages->links() }}
  </div> -->
</div>

<div class="swiper slide-swiper my-5">
  <div class="swiper-wrapper">
    @foreach($beverages as $data)
      <div class="swiper-slide">
        <div class="slide-card">
          <img class="slide-photo" src="{{ asset('storage/' . $data->food_img) }}" width="100" height="100">
          <div class="slide-name h4 text-center">{{ $data->food_name }}</div>
          <h4 class="card-text text-end">Price : {{ $data->food_price }} THB.</h4>
        </div>
      </div>
    @endforeach
  </div>

  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
</div>
<!-- End Beverages -->

@endsection