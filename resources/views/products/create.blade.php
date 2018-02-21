@extends('layouts.app')

@section('content')
    
<form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">

    {{ csrf_field() }}

    {{--  Product name  --}}
    <div class="form-group">
        <label for="product_name">Product name</label>
        <input type="text" name="product_name" class="form-control {{ $errors->has('product_name') ? 'is-invalid' : '' }}" placeholder="product name..." required value="{{ old('product_name') }}">
        @if ($errors->has('product_name'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('product_name') }}</strong>
            </span>
        @endif
    </div>

    {{--  Product price  --}}
    <div class="form-group">
        <lable for="product_price">Product price</lable>
        <input type="number" name="product_price" class="form-control {{ $errors->has('product_price') ? 'is-invalid' : '' }}" placeholder="product price..." required value="{{ old('product_price') }}">
        @if ($errors->has('product_price'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('product_price') }}</strong>
            </span>
        @endif
    </div>

    {{--  Product description  --}}
    <div class="form-group">
        <label for="product_description">Product description</label>
        <textarea name="product_description" class="form-control {{ $errors->has('product_description') ? 'is-invalid' : '' }}" id="" cols="30" rows="5" required>{{ old('product_description') }}</textarea>
        @if ($errors->has('product_description'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('product_description') }}</strong>
            </span>
        @endif    
    </div>

    {{--  Product image  --}}
    <div class="form-group">
        <input type="file" name="product_image" class="form-control-file  {{ $errors->has('product_image') ? 'is-invalid' : '' }}" required>
        @if ($errors->has('product_image'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('product_image') }}</strong>
            </span>
        @endif
    </div>

    {{--  Submit button  --}}
    <div class="form-group">
        <button class="btn btn-info" type="submit">Add Product</button>
    </div>

</form>

@endsection