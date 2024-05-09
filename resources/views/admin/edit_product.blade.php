@extends('main_master')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="content" style="margin: 10px;">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card shadow-sm">
                    <div class="card-header header-color">
                        <h4 class="Add-product-heading">Edit Product</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update.product', $edit_data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="my-3">
                                        <label for="">Product Name</label>
                                        <input name="name" value="{{ $edit_data->name }}" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="my-3">
                                        <label for="">Product Unit</label>
                                        <input name="unit" value="{{ $edit_data->unit }}" class="form-control" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="my-3">
                                        <label for="">Product Selling Price</label>
                                        <input name="selling_price" value="{{ $edit_data->selling_price }}" class="form-control" type="number">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="my-3">
                                        <label for="">Product Purchase Price</label>
                                        <input name="purchase_price" value="{{ $edit_data->purchase_price }}" class="form-control" type="number">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="my-3">
                                        <label for="">Product Discount</label>
                                        <input name="discount" value="{{ $edit_data->discount }}" class="form-control" type="number">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="my-3">
                                        <label for="">Product Tax</label>
                                        <input name="tax" value="{{ $edit_data->tax }}" class="form-control" type="number">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="my-3">
                                        <label for="">Product SKU</label>
                                        <input name="sku" class="form-control" value="{{ $edit_data->sku }}" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="my-3">
                                        <label for="">Product Image</label>
                                        <input name="old_image" value="{{ $edit_data->image }}" type="hidden">
                                        <input name="image" class="form-control" type="file">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="my-3">
                                        <img style="width: 150px; height: 150px;" id="img" src="{{ URL::to('') }}/uploads/products/{{ $edit_data->image }}" alt="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-6">
                                        <div class="my-3">
                                            <button class="btn btn-primary" type="submit">Update Product</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function(){
            $(document).on('change','input[name="image"]',function (e){
                e.preventDefault();

                let url = URL.createObjectURL(e.target.files[0]);

                $('img#img').attr('src',url).width('150px').height('150px');
            })
        })
    </script>








@endsection
