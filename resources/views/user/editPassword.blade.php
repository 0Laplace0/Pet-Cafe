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
    <h3 class="mb-0">Update Password</h3>
    <small class="opacity-75">เปลี่ยนรหัสผ่านของผู้ใช้</small>
  </div>

  <div class="card-body p-4">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $e)
            <li>{{ $e }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="/user/reset/{{ $id }}" method="post" autocomplete="off">
      @csrf
      @method('put')

      <div class="row g-4">
        <div class="col-12 col-md-6">
          <label class="form-label fw-semibold">Username</label>
          <input type="text" class="form-control" value="{{ $user_name }}" disabled readonly>
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label fw-semibold">Email</label>
          <input type="email" class="form-control" value="{{ $user_email }}" disabled readonly>
        </div>
      </div>

      <div class="row g-4 mt-1">
        <div class="col-12 col-md-6">
          <label class="form-label fw-semibold">New Password <span class="text-danger">*</span></label>
          <div class="input-group">
            <input type="password"
                   name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="Input New Password"
                   minlength="4" required
                   autocomplete="new-password" id="pwd">
            <button type="button" class="btn btn-outline-secondary" onclick="togglePwd('pwd', this)">
              <i class="fa-solid fa-eye"></i>
            </button>
          </div>
          @error('password')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
          <small class="text-muted">อย่างน้อย 4 ตัวอักษร</small>
        </div>

        <div class="col-12 col-md-6">
          <label class="form-label fw-semibold">Confirm Password <span class="text-danger">*</span></label>
          <div class="input-group">
            <input type="password"
                   name="password_confirmation"
                   class="form-control @error('password_confirmation') is-invalid @enderror"
                   placeholder="Input Confirm Password"
                   minlength="4" required
                   autocomplete="new-password" id="pwd2">
            <button type="button" class="btn btn-outline-secondary" onclick="togglePwd('pwd2', this)">
              <i class="fa-solid fa-eye"></i>
            </button>
          </div>
          @error('password_confirmation')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
          <small id="matchHelp" class="text-muted">พิมพ์ให้ตรงกับช่องด้านซ้าย</small>
        </div>
      </div>

      <div class="d-grid d-md-flex gap-2 mt-4">
        <button type="submit" class="btn btn-brand btn-lg rounded-pill px-4">Update</button>
        <a href="/user" class="btn btn-ghost btn-lg rounded-pill px-4">Cancel</a>
      </div>
    </form>
  </div>
</div>

<script>
  function togglePwd(id, btn){
    const inp = document.getElementById(id);
    const icon = btn.querySelector('i');
    if(inp.type === 'password'){ inp.type = 'text'; icon.classList.replace('fa-eye','fa-eye-slash'); }
    else{ inp.type = 'password'; icon.classList.replace('fa-eye-slash','fa-eye'); }
  }

  (function(){
    const p1 = document.getElementById('pwd');
    const p2 = document.getElementById('pwd2');
    const help = document.getElementById('matchHelp');
    function checkMatch(){
      if(!p2.value){ help.classList.remove('text-danger'); help.classList.add('text-muted'); return; }
      if(p1.value && p1.value === p2.value){
        help.textContent = 'รหัสผ่านตรงกัน'; help.classList.remove('text-danger'); help.classList.add('text-success');
      }else{
        help.textContent = 'รหัสผ่านยืนยันไม่ตรงกัน'; help.classList.remove('text-muted','text-success'); help.classList.add('text-danger');
      }
    }
    p1.addEventListener('input', checkMatch);
    p2.addEventListener('input', checkMatch);
  })();
</script>


@endsection

@section('footer')
@endsection

@section('js_before')
@endsection

@section('js_before')
@endsection