@extends('layouts.dog')
@extends('layouts.cat')
@extends('layouts.raccoon')

@section('showPet')

<!-- Start Dogs -->
<div class="swiper slide-swiper my-5">
  <div class="swiper-wrapper">
    @foreach($dogs as $data)
      <div class="swiper-slide">
        <div class="slide-card">
          <img class="slide-photo" src="{{ asset('storage/' . $data->food_img) }}" width="100" height="100">
          <div class="slide-name h4 text-center">{{ $data->pet_name }}</div>
        </div>
      </div>
    @endforeach
  </div>

  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
</div>
<!-- End Dogs -->

<!-- Start Cats -->
<div class="swiper slide-swiper my-5">
  <div class="swiper-wrapper">
    @foreach($cats as $data)
      <div class="swiper-slide">
        <div class="slide-card">
          <img class="slide-photo" src="{{ asset('storage/' . $data->food_img) }}" width="100" height="100">
          <div class="slide-name h4 text-center">{{ $data->pet_name }}</div>
        </div>
      </div>
    @endforeach
  </div>

  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
</div>
<!-- End Cats -->

<!-- Start Raccoons -->
<div class="swiper slide-swiper my-5">
  <div class="swiper-wrapper">
    @foreach($raccoons as $data)
      <div class="swiper-slide">
        <div class="slide-card">
          <img class="slide-photo" src="{{ asset('storage/' . $data->food_img) }}" width="100" height="100">
          <div class="slide-name h4 text-center">{{ $data->pet_name }}</div>
        </div>
      </div>
    @endforeach
  </div>

  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
</div>
<!-- End Raccoons -->

@endsection