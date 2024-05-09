@extends('main_master')
@section('content')



<div class="content" style="margin: 10px;">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header all-product-heading">
                    <h4>All Product</h4>
                    <a class="btn btn-primary" href="{{ route('dashboard') }}">Add new product</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Product Name</th>
                                <th>Product Unit</th>
                                <th>Product Selling Price</th>
                                <th>Product Purchase Price</th>
                                <th>Product Discount</th>
                                <th>Product Tax</th>
                                <th>Product Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->unit }}</td>
                                <td>{{ $product->selling_price }} $</td>
                                <td>{{ $product->purchase_price ?? 0 }} $</td>
                                <td>{{ $product->discount ?? 0 }} %</td>
                                <td>{{ $product->tax }} %</td>
                                <td><img style="width: 60px; height: 60px;" src="{{ URL::to('') }}/uploads/products/{{ $product->image }}" alt=""></td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('edit.product',$product->id) }}">Edit</a>
                                    <a class="btn btn-danger" href="{{ route('delete.product', $product->id) }}">Delete</a>
                                    <a class="btn btn-warning" href="{{ route('attribute.view', $product->id) }}">Add Attribute</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $products->links('admin.pagination') }}


                </div>
            </div>
        </div>
    </div>
</div>










@endsection
