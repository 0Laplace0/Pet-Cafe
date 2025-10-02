@extends('layouts.cat')

@section('showPet')

<!-- Start Cats -->
<div class="container mt-4" data-aos="fade-up">
  <div class="row">
    <div class="col">
      <div class="alert alert-dismissible fade show text-white" role="alert" style="background-color: #8D6E63; font-size: x-large;" data-aos="fade-up">
        <b>Cats</b>
      </div>
    </div>
  </div>
  <div class="row">
    @foreach($cats as $data)
      <div class="col-12 col-sm-4 col-md-4 col-lg-3 mb-3">
        <div class="card h-100">
          <a href="{{ url('/detail/' . $data->id) }}">
            <img src="{{ asset('storage/' . $data->pet_img) }}" class="card-img-top">
          </a>
          <div class="card-body">
            <h5 class="card-title">{{ $data->pet_name }}</h5>
            <p class="card-text">
              <img src="{{ asset('asset/icon/detail.png') }}" alt="detail" width="20" height="20">
              {{ $data->pet_detail }}
            </p>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  <div class="mt-2 d-flex justify-content-center">
    {{ $cats->links() }}
  </div>
</div>

<!-- End Cats -->

@endsection