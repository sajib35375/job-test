@extends('main_master')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="content" style="margin: 10px;">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card shadow-sm">
                <div class="card-header header-color">
                    <h4 class="Add-product-heading">Add new Product</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="my-3">
                                    <label for="">Product Name</label>
                                    <input name="name" class="form-control" type="text">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="my-3">
                                        <label for="">Product Unit</label>
                                        <input name="unit" class="form-control" type="text">
                                        @error('unit')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="my-3">
                                        <label for="">Product Selling Price</label>
                                        <input id="selling" name="selling_price" class="form-control" type="number">
                                        @error('selling_price')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="my-3">
                                        <label for="">Product Purchase Price</label>
                                        <input id="purchase" name="purchase_price" class="form-control" type="number">
                                        @error('purchase_price')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="my-3">
                                        <label for="">Product Discount</label>
                                        <input id="discount" name="discount" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="my-3">
                                        <label for="">Product Tax</label>
                                        <input name="tax" class="form-control" type="number">
                                        @error('tax')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="my-3">
                                        <label for="">Product SKU</label>
                                        <input name="sku" class="form-control" type="text">
                                        @error('sku')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="my-3">
                                        <label for="">Product Image</label>
                                        <input name="image" class="form-control" type="file">
                                        @error('image')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="my-3">
                                        <img id="img" src="" alt="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-6">
                                        <div class="my-3">
                                            <button class="btn btn-primary" type="submit">Add Product</button>
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
        });


        $(document).on('keyup','#purchase', function (e){

            let selling_price = $('#selling').val();
            let purchase_price = $('#purchase').val();

            let discount_amount = selling_price - purchase_price;

            let percentage = (discount_amount/selling_price)*100;

            let original_value = parseFloat(percentage).toFixed(2)


            $('#discount').val(original_value)

        })




    })
</script>






@endsection
