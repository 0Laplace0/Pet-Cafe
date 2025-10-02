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
    <h3 class="form-title mb-0">Add Food</h3>
    <small class="opacity-75">เพิ่มเมนูอาหารใหม่และอัปโหลดรูปภาพ</small>
  </div>

  <div class="card-body p-4">
    <form action="/food" method="post" enctype="multipart/form-data">
      @csrf

      <div class="row g-4">
        <div class="col-12 col-md-4">
          <div class="d-flex flex-column gap-2 align-items-center">
            <img id="preview" class="img-preview"
                 src="https://placehold.co/520x520?text=Preview" alt="Food photo">
            <small class="help-text text-center">
              แนะนำรูปสี่เหลี่ยมจัตุรัสอย่างน้อย 600×600px (JPG/PNG)
            </small>
          </div>
        </div>

        <div class="col-12 col-md-8">
          <div class="mb-3">
            <label class="form-label fw-semibold">Food Name <span class="text-danger">*</span></label>
            <input type="text"
                   class="form-control @error('food_name') is-invalid @enderror"
                   name="food_name" placeholder="เช่น Croissant, Latte"
                   value="{{ old('food_name') }}" minlength="3" required>
            @error('food_name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Food detail <span class="text-danger">*</span></label>
            <textarea name="food_detail" rows="4"
                      class="form-control @error('food_detail') is-invalid @enderror"
                      placeholder="รายละเอียดเมนู รสชาติ วัตถุดิบ ฯลฯ" required>{{ old('food_detail') }}</textarea>
            @error('food_detail')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
          </div>

          <div class="row g-3">
            <div class="col-12 col-lg-6">
              <label class="form-label fw-semibold">Food Type <span class="text-danger">*</span></label>
              <select name="food_type" class="form-select @error('food_type') is-invalid @enderror" required>
                <option value="">-- Select Type --</option>
                <option value="savorydishes" {{ old('food_type')=='savorydishes' ? 'selected' : '' }}>Savory dishes</option>
                <option value="desserts"     {{ old('food_type')=='desserts'     ? 'selected' : '' }}>Desserts</option>
                <option value="appetizers"   {{ old('food_type')=='appetizers'   ? 'selected' : '' }}>Appetizers</option>
                <option value="beverages"    {{ old('food_type')=='beverages'    ? 'selected' : '' }}>Beverages</option>
              </select>
              @error('food_type')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-lg-6">
              <label class="form-label fw-semibold">Food Price <span class="text-danger">*</span></label>
              <div class="input-group">
                <span class="input-group-text rounded-pill rounded-end-0">THB</span>
                <input type="number" step="0.01" min="0" inputmode="decimal"
                       class="form-control rounded-pill rounded-start-0 @error('food_price') is-invalid @enderror"
                       name="food_price" placeholder="0.00"
                       value="{{ old('food_price') }}" required>
              </div>
              @error('food_price')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
              <label class="form-label fw-semibold">Picture <span class="text-danger">*</span></label>
              <input type="file" name="food_img" accept="image/*"
                     class="form-control @error('food_img') is-invalid @enderror"
                     onchange="previewImg(event)" required>
              @error('food_img')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>
          </div>

          <div class="d-grid d-md-flex gap-2 mt-4">
            <button type="submit" class="btn btn-brand btn-lg rounded-pill px-4">Insert Food</button>
            <a href="/food" class="btn btn-ghost btn-lg rounded-pill px-4">Cancel</a>
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