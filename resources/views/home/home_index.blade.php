@extends('frontend')
@section('css_before')
@section('navbar')
@endsection

@section('showPet')

<div class="container mt-5" data-aos="fade-up">
  <div class="row">
    <div class="col">
      <div class="alert alert-dismissible fade show text-white" role="alert" style="background-color: #8D6E63; font-size: x-large;" data-aos="fade-up">
        <b>Ours Pets</b>
      </div>
    </div>
  </div>
</div>

<div class="swiper slide-swiper my-5">
  <div class="swiper-wrapper">
    @foreach($pet as $data)
      <div class="swiper-slide">
        <div class="slide-card">
          <img class="slide-photo" src="{{ asset('storage/' . $data->pet_img) }}" width="100" height="100">
          <div class="slide-name h4 text-center">{{ $data->pet_name }}</div>
        </div>
      </div>
    @endforeach
  </div>

  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
</div>
<!-- End Savory Dishes -->

@endsection

@section('footer')
@endsection

@section('js_before')
@endsection