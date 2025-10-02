@extends('home')

@section('css_before')
@endsection

@section('header')
@endsection

@section('sidebarMenu')
@endsection

@section('content')

<div class="card shadow-lg border-0 rounded-4 form-card">
  <div class="card-header rounded-top-4 py-3 px-4" style="background:#8D6E63;color:#fff;">
    <h3 class="mb-0">Update User</h3>
    <small class="opacity-75">แก้ไขข้อมูลผู้ใช้</small>
  </div>

  <div class="card-body p-4">
    <form action="/user/{{ $id }}" method="post">
      @csrf
      @method('put')

      <div class="row g-4">
        <div class="col-12 col-md-6">
          <label class="form-label fw-semibold">Username <span class="text-danger">*</span></label>
          <input type="text"
                 name="user_name"
                 class="form-control @error('user_name') is-invalid @enderror"
                 placeholder="Input Username"
                 minlength="4" required
                 value="{{ old('user_name', $user_name ?? '') }}">
          @error('user_name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <div class="col-12 col-md-6">
          <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
          <input type="email"
                 name="user_email"
                 class="form-control @error('user_email') is-invalid @enderror"
                 placeholder="Input Email"
                 required
                 value="{{ old('user_email', $user_email ?? '') }}">
          @error('user_email') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>
      </div>

      <div class="row g-4 mt-1">
        <div class="col-12 col-md-6">
          <label class="form-label fw-semibold">Phone <span class="text-danger">*</span></label>
          <input type="tel"
                 name="user_tel"
                 class="form-control @error('user_tel') is-invalid @enderror"
                 placeholder="Input Phone 10 digit"
                 minlength="10" maxlength="10" required
                 value="{{ old('user_tel', $user_tel ?? '') }}">
          @error('user_tel') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <div class="col-12 col-md-6">
          <label class="form-label fw-semibold">Role <span class="text-danger">*</span></label>
          <select name="user_role" class="form-select @error('user_role') is-invalid @enderror" required>
            <option value="">-- Select Role --</option>
            <option value="member" {{ old('user_role', $user_role ?? '')=='member' ? 'selected' : '' }}>Member</option>
            <option value="vip"    {{ old('user_role', $user_role ?? '')=='vip'    ? 'selected' : '' }}>Vip</option>
            <option value="staff"  {{ old('user_role', $user_role ?? '')=='staff'  ? 'selected' : '' }}>Staff</option>
          </select>
          @error('user_role') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>
      </div>

      <div class="d-grid d-md-flex gap-2 mt-4">
        <button type="submit" class="btn btn-brand btn-lg rounded-pill px-4">Update</button>
        <a href="/user" class="btn btn-ghost btn-lg rounded-pill px-4">Cancel</a>
      </div>
    </form>
  </div>
</div>

@endsection

@section('footer')
@endsection

@section('js_before')
@endsection

@section('js_before')
@endsection