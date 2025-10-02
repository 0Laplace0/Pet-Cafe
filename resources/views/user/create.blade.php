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
    <h3 class="form-title mb-0">Add User</h3>
    <small class="opacity-75">เพิ่มผู้ใช้ใหม่และกำหนดสิทธิ์</small>
  </div>

  <div class="card-body p-4">
    <form action="/user" method="post">
      @csrf

      <div class="row g-4">
        <div class="col-12 col-md-6">
          <label class="form-label fw-semibold">Username <span class="text-danger">*</span></label>
          <input type="text"
                 class="form-control @error('user_name') is-invalid @enderror"
                 name="user_name"
                 placeholder="Input Username"
                 value="{{ old('user_name') }}"
                 minlength="4" required autocomplete="username">
          @error('user_name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>

        <div class="col-12 col-md-6">
          <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
          <div class="input-group">
            <input type="email"
                   class="form-control @error('user_email') is-invalid @enderror"
                   name="user_email"
                   placeholder="Input Email"
                   value="{{ old('user_email') }}"
                   required autocomplete="email">
            <span class="input-group-text"><i class="fa-regular fa-envelope"></i></span>
          </div>
          @error('user_email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>
      </div>

      <div class="row g-4 mt-1">
        <div class="col-12 col-md-6">
          <label class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
          <div class="input-group">
            <input type="password"
                   class="form-control @error('user_password') is-invalid @enderror"
                   name="user_password"
                   id="user_password"
                   placeholder="Input Password"
                   minlength="4" required autocomplete="new-password">
            <button class="btn btn-outline-secondary" type="button" onclick="togglePw()">
              <i class="fa-solid fa-eye"></i>
            </button>
          </div>
          @error('user_password')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
          <small class="text-muted">อย่างน้อย 4 ตัวอักษร</small>
        </div>

        <div class="col-12 col-md-6">
          <label class="form-label fw-semibold">Phone <span class="text-danger">*</span></label>
          <input type="tel"
                 class="form-control @error('user_tel') is-invalid @enderror"
                 name="user_tel"
                 placeholder="Input Phone 10 digit"
                 minlength="10" maxlength="10"
                 value="{{ old('user_tel') }}"
                 required autocomplete="tel">
          @error('user_tel')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>
      </div>

      <div class="mt-4">
        <label class="form-label fw-semibold">Role <span class="text-danger">*</span></label>
        <select name="user_role" class="form-select @error('user_role') is-invalid @enderror" required>
          <option value="">-- Select Role --</option>
          <option value="member" {{ old('user_role')=='member' ? 'selected':'' }}>Member</option>
          <option value="vip"    {{ old('user_role')=='vip'    ? 'selected':'' }}>Vip</option>
          <option value="staff"  {{ old('user_role')=='staff'  ? 'selected':'' }}>Staff</option>
        </select>
        @error('user_role')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
      </div>

      <div class="d-grid d-md-flex gap-2 mt-4">
        <button type="submit" class="btn btn-brand btn-lg rounded-pill px-4">Confirm</button>
        <a href="/user" class="btn btn-ghost btn-lg rounded-pill px-4">Cancel</a>
      </div>
    </form>
  </div>
</div>

<script>
  function togglePw(){
    const el = document.getElementById('user_password');
    el.type = el.type === 'password' ? 'text' : 'password';
  }
</script>

@endsection

@section('footer')
@endsection

@section('js_before')
@endsection

@section('js_before')
@endsection