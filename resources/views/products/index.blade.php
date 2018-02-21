@extends('layouts.app')

@section('content')
    
<div class="card">
    <div class="card-header bg-info text-white">
        <div class="row">
            <div class="col-md-6">
                <h2>Products</h2>
            </div>
            <div class="col-md-6">
                <a href="{{ route('products.create') }}" class="btn btn-light float-right">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="card-block">

        {{--  Product Table  --}}
        <table class="table table-hover">
            <thead>
                <th class="col-md-1">Product name</th>
                <th>Price</th>
                <th>Edit</th>
                <th>Delete</th>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>
                            {{ $product->name }}
                        </td>
                        <td>
                            {{ $product->price }}
                        </td>
                        <td>
                            <a href="{{ route('products.edit', ['id' => $product->slug]) }}" class="btn btn-info">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('products.destroy', ['id' => $product->slug]) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-danger" type="submit">
                                    <i class="fa fa-remove"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="text-center">
    <br>
    {{ $products->links() }}
</div>

@endsection