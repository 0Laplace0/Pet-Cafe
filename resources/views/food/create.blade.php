@extends('home')
@section('css_before')
@endsection
@section('header')
@endsection
@section('sidebarMenu')   
@endsection
@section('content')
 


    <h3> :: Form Add Food :: </h3>

    <form action="/food/" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Food Name </label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="food_name" required placeholder="Food Name "
                    minlength="3" value="{{ old('food_name') }}">
                @if(isset($errors))
                @if($errors->has('food_name'))
                <div class="text-danger"> {{ $errors->first('food_name') }}</div>
                @endif
                @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Food detail </label>
            <div class="col-sm-7">
                <textarea name="food_detail" class="form-control" rows="4" required
                    placeholder="Food detail ">{{ old('food_detail') }}</textarea>
                @if(isset($errors))
                @if($errors->has('food_detail'))
                <div class="text-danger"> {{ $errors->first('food_detail') }}</div>
                @endif
                @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Food Type </label>
                <div class="col-sm-6">
                    <select name="food_type" class="form-control" required>
                        <option value="">-- Select Status --</option>
                        <option value="savorydishes" {{ old('food_type') == 'savorydishes' ? 'selected' : '' }}>Savory dishes</option>
                        <option value="desserts" {{ old('food_type') == 'desserts' ? 'selected' : '' }}>Desserts</option>
                        <option value="appetizers" {{ old('food_type') == 'appetizers' ? 'selected' : '' }}>Appetizers</option>
                        <option value="beverages" {{ old('food_type') == 'beverages' ? 'selected' : '' }}>Beverages</option>
                    </select>
                    @if(isset($errors))
                    @if($errors->has('food_type'))        
                <div class="text-danger"> {{ $errors->first('food_type') }}</div>
                @endif
                @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Food Price </label>
            <div class="col-sm-6">
                <input type="number" class="form-control" name="food_price" required placeholder="food_price"
                    min="0" value="{{ old('food_price') }}">
                @if(isset($errors))
                @if($errors->has('food_price'))
                <div class="text-danger"> {{ $errors->first('food_price') }}</div>
                @endif
                @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Pic </label>
            <div class="col-sm-6">
                <input type="file" name="food_img" required placeholder="food_img" accept="image/*">
                @if(isset($errors))
                @if($errors->has('food_img'))
                <div class="text-danger"> {{ $errors->first('food_img') }}</div>
                @endif
                @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> </label>
            <div class="col-sm-5">

                <button type="submit" class="btn btn-primary"> Insert Food </button>
                <a href="/food" class="btn btn-danger">cancel</a>
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