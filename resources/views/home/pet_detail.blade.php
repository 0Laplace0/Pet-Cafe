@extends('frontend')
@section('css_before')
@section('navbar')
@endsection
@section('showPet')

<div class="container mb-5">
  <div id="Info" class="row rounded-5 mt-5 col-12 col-sm-12 col-md-12 col-lg-12" data-aos="fade-up">
    <div class="col-lg-6 p-4">
          <img src="{{ asset('storage/' . $pet_img) }}" class="img-fluid rounded-5 d-block mx-auto" width="450">
    </div>
    <div class="col-lg-5 p-3">
      <div class="row">
        <div class="col">
          <div class="alert alert-dismissible fade show text-white" role="alert" style="background-color: #8D6E63; font-size: x-large;" data-aos="fade-up">
            <b>Name : {{ $pet_name }}</b>
          </div>
        </div>
      </div>
        <h3 class="card-title">Pet detail : </h3>
        <h5>
            {{ $pet_detail }}<br><br>
            วันที่รับเลี้ยง : {{ date('d/m/Y', strtotime($dateCreate)) }}
        </h5>
    </div>
  </div>
</div>

@endsection

@section('footer')
@endsection

@section('js_before')
@endsection