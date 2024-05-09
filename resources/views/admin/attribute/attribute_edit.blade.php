@extends('main_master')
@section('content')


<div class="content">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h2>Edit Attribute</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('attribute.update',$edit_data->id) }}" method="POST">
                        @csrf
                        <div class="my-3">
                            <label for="">SKU</label>
                            <input name="sku" value="{{ $edit_data->sku }}" class="form-control" type="text">
                        </div>
                        <div class="my-3">
                            <label for="">Stock</label>
                            <input name="stock" value="{{ $edit_data->stock }}" class="form-control" type="text">
                        </div>
                        <div class="my-3">
                            <label for="">Product Color</label>
                            <select class="form-control" name="product_color" id="">
                                @foreach($attributes as $data)
                                <option {{ $data->id == $edit_data->id ? 'selected' : '' }} value="{{ $data->product_color }}">{{ $data->product_color }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="my-3">
                            <label for="">Product Size</label>
                            <select class="form-control" name="product_size" id="">
                                @foreach($attributes as $data)
                                    <option {{ $data->id == $edit_data->id ? 'selected' : '' }} value="{{ $data->product_size }}">{{ $data->product_size }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="my-3">
                            <label for="">Product Selling Price</label>
                            <input name="selling_price" value="{{ $edit_data->selling_price }}" class="form-control" type="text">
                        </div>
                        <div class="my-3">
                            <label for="">Product Purchase Price</label>
                            <input name="purchase_price" value="{{ $edit_data->purchase_price }}" class="form-control" type="text">
                        </div>
                        <div class="my-3">
                            <input class="btn btn-primary" type="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>







@endsection
