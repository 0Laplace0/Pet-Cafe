@extends('home')
@section('js_before')
@include('sweetalert::alert')
@section('header')
@section('sidebarMenu')   
@section('content')

    <h3> :: form Update Pet :: </h3>

    <form action="/pet/{{ $id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Pet Name </label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="pet_name" required placeholder="Pet Name "
                    minlength="3" value="{{ old('pet_name') }}">
                @if(isset($errors))
                @if($errors->has('pet_name'))
                <div class="text-danger"> {{ $errors->first('pet_name') }}</div>
                @endif
                @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Pet detail </label>
            <div class="col-sm-7">
                <textarea name="pet_detail" class="form-control" rows="4" required
                    placeholder="Pet detail ">{{ old('pet_detail') }}</textarea>
                @if(isset($errors))
                @if($errors->has('pet_detail'))
                <div class="text-danger"> {{ $errors->first('pet_detail') }}</div>
                @endif
                @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Pet Type </label>
                <div class="col-sm-6">
                    <select name="pet_type" class="form-control" required>
                        <option value="">-- Select Status --</option>
                        <option value="dog" {{ old('pet_type') == 'dog' ? 'selected' : '' }}>Dog</option>
                        <option value="cat" {{ old('pet_type') == 'cat' ? 'selected' : '' }}>Cat</option>
                        <option value="raccoon" {{ old('pet_type') == 'raccoon' ? 'selected' : '' }}>Raccoon</option>
                    </select>
                    @if(isset($errors))
                    @if($errors->has('pet_type'))        
                <div class="text-danger"> {{ $errors->first('pet_type') }}</div>
                @endif
                @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Pic </label>
            <div class="col-sm-6">
                <input type="file" name="pet_img" required placeholder="pet_img" accept="image/*">
                @if(isset($errors))
                @if($errors->has('pet_img'))
                <div class="text-danger"> {{ $errors->first('pet_img') }}</div>
                @endif
                @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> </label>
            <div class="col-sm-5">
                <input type="hidden" name="oldImg" value="{{ $pet_img }}">
                <button type="submit" class="btn btn-primary"> Update </button>
                <a href="/pet" class="btn btn-danger">cancel</a>
            </div>
        </div>

    </form>
</div>


@endsection


@section('footer')
@endsection

@section('js_before')
@endsection

{{-- devbanban.com --}}