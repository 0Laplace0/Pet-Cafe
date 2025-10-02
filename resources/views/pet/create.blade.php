@extends('home')
@section('css_before')
@endsection
@section('header')
@endsection
@section('sidebarMenu')   
@endsection
@section('content')

<div class="card shadow-lg border-0 rounded-4 form-card">
  <div class="card-header rounded-top-4 py-3 px-4">
    <h3 class="form-title mb-0">Add Pet</h3>
    <small class="opacity-75">เพิ่มสัตว์เลี้ยงใหม่และอัปโหลดรูปภาพ</small>
  </div>

  <div class="card-body p-4">
    <form action="/pet" method="post" enctype="multipart/form-data">
      @csrf

      <div class="row g-4">
        <div class="col-12 col-md-4">
          <div class="d-flex flex-column gap-2 align-items-center">
            <img id="preview" class="img-preview"
                 src="https://placehold.co/520x520?text=Preview" alt="Pet photo">
            <small class="help-text text-center">
              แนะนำขนาดสี่เหลี่ยมจัตุรัสอย่างน้อย 600×600px (JPG/PNG)
            </small>
          </div>
        </div>

        <div class="col-12 col-md-8">
          <div class="mb-3">
            <label class="form-label fw-semibold">Pet Name <span class="text-danger">*</span></label>
            <input type="text"
                   class="form-control @error('pet_name') is-invalid @enderror"
                   name="pet_name" placeholder="เช่น Macaron"
                   value="{{ old('pet_name') }}" minlength="3" required>
            @error('pet_name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Pet detail <span class="text-danger">*</span></label>
            <textarea name="pet_detail" rows="4"
                      class="form-control @error('pet_detail') is-invalid @enderror"
                      placeholder="นิสัย อาหารที่ชอบ ฯลฯ" required>{{ old('pet_detail') }}</textarea>
            @error('pet_detail')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
          </div>

          <div class="row g-3">
            <div class="col-12 col-lg-6">
              <label class="form-label fw-semibold">Pet Type <span class="text-danger">*</span></label>
              <select name="pet_type" class="form-select @error('pet_type') is-invalid @enderror" required>
                <option value="">-- Select Type --</option>
                <option value="dog"     {{ old('pet_type')=='dog' ? 'selected' : '' }}>Dog</option>
                <option value="cat"     {{ old('pet_type')=='cat' ? 'selected' : '' }}>Cat</option>
                <option value="raccoon" {{ old('pet_type')=='raccoon' ? 'selected' : '' }}>Raccoon</option>
              </select>
              @error('pet_type')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-lg-6">
              <label class="form-label fw-semibold">Picture <span class="text-danger">*</span></label>
              <input type="file" name="pet_img" accept="image/*"
                     class="form-control @error('pet_img') is-invalid @enderror"
                     onchange="previewImg(event)" required>
              @error('pet_img')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>
          </div>

          <div class="d-grid d-md-flex gap-2 mt-4">
            <button type="submit" class="btn btn-brand btn-lg rounded-pill px-4">Insert Pet</button>
            <a href="/pet" class="btn btn-ghost btn-lg rounded-pill px-4">Cancel</a>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  function previewImg(e){
    const file = e.target.files && e.target.files[0];
    if(!file) return;
    document.getElementById('preview').src = URL.createObjectURL(file);
  }
</script>

@endsection

@section('footer')
@endsection

@section('js_before')
@endsection

{{-- devbanban.com --}}