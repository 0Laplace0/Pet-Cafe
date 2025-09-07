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
        <div class="col-sm-12">

            <h3> :: form Update Customer :: </h3>


            <form action="/customer/{{ $id }}" method="post">
                @csrf
                @method('put')

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> First Name </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="customer_fname" required placeholder="Input First name"
                            minlength="4" value="{{ old('customer_fname') }}">
                        @if(isset($errors))
                        @if($errors->has('customer_fname'))
                        <div class="text-danger"> {{ $errors->first('customer_fname') }}</div>
                        @endif
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> Last Name </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="customer_lname" required placeholder="Input Last name"
                            minlength="4" value="{{ old('customer_lname') }}">
                        @if(isset($errors))
                        @if($errors->has('customer_lname'))
                        <div class="text-danger"> {{ $errors->first('customer_lname') }}</div>
                        @endif
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> Phone </label>
                    <div class="col-sm-6">
                        <input type="tel" class="form-control" name="customer_tel" required placeholder="Input Phone 10 digit"
                            minlength="10" maxlength="10" value="{{ old('customer_tel') }}">
                        @if(isset($errors))
                        @if($errors->has('customer_tel'))
                        <div class="text-danger"> {{ $errors->first('customer_tel') }}</div>
                        @endif
                        @endif
                    </div>
                </div>
                
                <div class="form-group row mb-2">
                    <label class="col-sm-2"> Email </label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control" name="customer_email" required placeholder="Input Email"
                            minlength="4"  value="{{ old('customer_email') }}">
                        @if(isset($errors))
                        @if($errors->has('customer_email'))
                        <div class="text-danger"> {{ $errors->first('customer_email') }}</div>
                        @endif
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> Status </label>
                    <div class="col-sm-6">
                        <select name="customer_status" class="form-control" required>
                            <option value="">-- Select Status --</option>
                            <option value="member" {{ old('customer_status') == 'member' ? 'selected' : '' }}>Member</option>
                            <option value="vip" {{ old('customer_status') == 'vip' ? 'selected' : '' }}>VIP</option>
                        </select>
                        @if(isset($errors))
                        @if($errors->has('customer_status'))
                        <div class="text-danger"> {{ $errors->first('customer_status') }}</div>
                        @endif
                        @endif
                    </div>
                </div>


                <div class="form-group row mb-2">
                    <label class="col-sm-2"> </label>
                    <div class="col-sm-5">
                        <button type="submit" class="btn btn-primary"> Update </button>
                        <a href="/customer" class="btn btn-danger">cancel</a>
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