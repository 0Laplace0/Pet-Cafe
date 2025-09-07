@extends('home')

@section('css_before')
@endsection

@section('header')
@endsection

@section('sidebarMenu')
@endsection

@section('content')


<div class="container mt-4">
    <div class="row">
        <div class="col-sm-9">

            <h3> :: form Add Staff :: </h3>


            <form action="/staff/" method="post">
                @csrf

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> First Name </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="staff_fname" required placeholder="Input First name"
                            minlength="4" value="{{ old('staff_fname') }}">
                        @if(isset($errors))
                        @if($errors->has('staff_fname'))
                        <div class="text-danger"> {{ $errors->first('staff_fname') }}</div>
                        @endif
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> Last Name </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="staff_lname" required placeholder="Input Last name"
                            minlength="4" value="{{ old('staff_lname') }}">
                        @if(isset($errors))
                        @if($errors->has('staff_lname'))
                        <div class="text-danger"> {{ $errors->first('staff_lname') }}</div>
                        @endif
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> Phone </label>
                    <div class="col-sm-6">
                        <input type="tel" class="form-control" name="staff_tel" required placeholder="Input Phone 10 digit"
                            minlength="10" maxlength="10" value="{{ old('staff_tel') }}">
                        @if(isset($errors))
                        @if($errors->has('staff_tel'))
                        <div class="text-danger"> {{ $errors->first('staff_tel') }}</div>
                        @endif
                        @endif
                    </div>
                </div>
                
                <div class="form-group row mb-2">
                    <label class="col-sm-2"> Email </label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control" name="staff_email" required placeholder="Input Email"
                            minlength="4"  value="{{ old('staff_email') }}">
                        @if(isset($errors))
                        @if($errors->has('staff_email'))
                        <div class="text-danger"> {{ $errors->first('staff_email') }}</div>
                        @endif
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> Password </label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" name="staff_password" required placeholder="Input Password"
                            minlength="4">
                        @if(isset($errors))
                        @if($errors->has('staff_password'))
                        <div class="text-danger"> {{ $errors->first('staff_password') }}</div>
                        @endif
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> Gender </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="staff_gender" required placeholder="Input Gender"
                            minlength="4" value="{{ old('staff_gender') }}">
                        @if(isset($errors))
                        @if($errors->has('staff_gender'))
                        <div class="text-danger"> {{ $errors->first('staff_gender') }}</div>
                        @endif
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> Address </label>
                    <div class="col-sm-7">
                        <textarea name="staff_address" class="form-control" rows="4" required
                            placeholder="Input Address">{{ old('staff_address') }}</textarea>
                        @if(isset($errors))
                        @if($errors->has('staff_address'))
                        <div class="text-danger"> {{ $errors->first('staff_address') }}</div>
                        @endif
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> Position </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="staff_position" required placeholder="Input Position"
                            minlength="4" value="{{ old('staff_position') }}">
                        @if(isset($errors))
                        @if($errors->has('staff_position'))
                        <div class="text-danger"> {{ $errors->first('staff_position') }}</div>
                        @endif
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> </label>
                    <div class="col-sm-5">

                        <button type="submit" class="btn btn-primary"> Confirm </button>
                        <a href="/staff" class="btn btn-danger">cancel</a>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection

@section('footer')
@endsection

@section('js_before')
@endsection

@section('js_before')
@endsection