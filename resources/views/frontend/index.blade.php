@extends('frontend.main_master')
@section('frontend')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="wrap" style="margin: 10px;">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header front-header">
                    <h6>Product Section</h6>
                </div>
                <div class="card-body">
                    <div class="heading">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input name="search_text" class="form-control search" placeholder="Search by code or name" type="text">
                    </div>
                    <div class="row my-3 searchBody" id="searchBody">

                        @foreach($products as $product)
                        <div class="col-lg-3 col-md-3 col-sm-4">
                            <div class="card shadow-sm my-3">
                                <div class="card-body product-cart">
                                    <img id="img" style="width: 150px; height: 200px;" src="{{ URL::to('') }}/uploads/products/{{ $product->image }}" alt="">
                                    <p id="name">{{ $product->name }}</p>
                                    <div class="price">
                                        <strong>@if($product->purchase_price) <del id="del_selling">{{ $product->selling_price }}$ </del>@else <span id="selling">{{ $product->selling_price }}</span>$ @endif </strong>@if($product->purchase_price) <span id="purchase">{{ $product->purchase_price }}</span>   $@endif
                                    </div>
                                    <p id="sku"><strong>SKU:</strong>{{ $product->sku }}</p>
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" id="addToCart" product_id="{{ $product->id }}" class="btn btn-info add-cart" href="#">Add to Cart</a>
                                </div>
                            </div>
                        </div>

                        @endforeach
                            <div class="paginate">
                                {{ $products->links('frontend.pagination') }}
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card">
                <div class="card-header cart-header">
                    <h6>Billing Section</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('order.store') }}" method="POST">
                        @csrf
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ITEM</th>
                            <th>Name</th>
                            <th>QTY</th>
                            <th>PRICE</th>
                            <th>DELETE</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($cart_products)
                            @foreach($cart_products as $data)
                                <tr>
                                    <td><img style="width: 30px; height: 30px;" src="{{ URL::to('') }}/uploads/products/{{ $data->options->image }}" alt=""></td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->qty }}</td>
                                    <td>{{ $data->price * $data->qty }}$</td>
                                    <td><a href="{{ route('cart.delete',$data->rowId) }}" class="btn btn-sm btn-danger"><i class="fa-regular fa-trash-can"></i></a></td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>

                        @if($cart_products)
                            @foreach($cart_products as $data)
                                <input name="image[]" value="{{ $data->options->image }}" type="hidden">
                                <input name="qty[]" value="{{ $data->qty }}" type="hidden">
                                <input name="name[]" value="{{ $data->name }}" type="hidden">
                                <input name="price[]" value="{{ $data->qty * $data->price }}" type="hidden">
                            @endforeach
                        @endif

                        <div class="summary">
                            <div class="item">
                                <h4>Subtotal:</h4>
                                <p>{{ \Gloudemans\Shoppingcart\Facades\Cart::subtotal() }}$</p>
                            </div>

                        </div>




                        <button id="order" type="submit" class="btn btn-primary">Place Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="card body-holder">
                            <img id="image" style="width: 300px; height: 250px;" src="" alt="">
                            <input id="product_id" type="hidden">
                            <input id="attribute_id" type="hidden">
                            <input id="tax" type="hidden">
                            <div class="card-body">
                                <p><strong>Product Name:</strong> <span id="product_name"></span></p>
                                <p><strong>Product selling Price:</strong><del> <span id="selling_price"></span> $</del></p>
                                <p><strong>Product purchase Price:</strong> <span id="purchase_price"></span> $</p>
                                <label for=""><strong>Product Color:</strong></label>
                                <select class="form-control" name="product_color" id="">

                                </select><br>
                                <label for=""><strong>Product Size:</strong> <span id="product_size"></span> </label><br><br>
                                <label for=""><strong>Product Stock:</strong> <span id="product_stock"></span> </label><br><br>
                                <label for=""><strong>Product SKU:</strong> <span id="product_sku"></span> </label><br><br>
                                <label for=""><strong>Product Quantity:</strong></label>
                                <input id="qty" name="qty" class="form-control" type="number">
                            </div>
                        </div>
                        <div class="buttons">
                            <button type="button" id="close" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>&nbsp;
                            <button id="add" type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

<script>
    $(document).ready(function (){
        $(document).on('click','#addToCart', function (){
            let id = $(this).attr('product_id');

            const main_url = 'http://localhost:8000'

            $.ajax({
                url: main_url + "/modal/data/show/"+id,
                method : "GET",
                type : 'json',
                success : function (data){
                    $('#product_size').html('');
                    $('#product_stock').text('');
                    $('#attribute_id').val('')
                    $('#product_sku').html(data.sku);
                    if(data.attributes.length===0){
                        $('#add').addClass('hide')
                    }else{
                        $('#add').removeClass('hide')
                    }
                    $('#product_name').text(data.name)
                    $('#selling_price').text(data.selling_price)
                    $('#product_id').val(data.id)
                    $('#tax').val(data.tax);
                    $('#purchase_price').text('')
                    if(data.purchase_price){
                        $('#purchase_price').text(data.purchase_price)
                    }
                    $('#image').attr('src',`${main_url}/uploads/products/${data.image}`).height('80%')

                    var d = $('select[name="product_color"]').empty();
                    $('select[name="product_color"]').append('<option value="">-Select-</option>');
                    $.each(data.attributes,function (key,value){
                        $('select[name="product_color"]').append('<option value="'+value.id+'">'+value.product_color+'</option>');
                    });
                }
            });
        });

        $(document).on('change','select[name="product_color"]', function (){
            let id = $(this).val();

            const main_url = 'http://localhost:8000/';
            $.ajax({
                url: main_url + "change/color/"+id,
                method: "GET",
                type: 'json',
                success: function (data){
                $('#selling_price').html(data.selling_price);
                $('#purchase_price').html(data.purchase_price);
                $('#product_size').html(data.product_size)
                   $('#attribute_id').val(data.id)
                    $('#product_stock').text(data.stock);
                    $('#product_sku').html(data.sku);

                }
            })
        })



        $(document).on('click','#add',function (){
            let product_name = $('#product_name').text();
            let selling_price = $('#selling_price').text();
            let purchase_price = $('#purchase_price').text();
            let discount_price = selling_price - purchase_price;
            let tax = $('#tax').val();
            let id = $('#product_id').val();
            let product_color = $('select[name="product_color"]').find('option:selected').text();
            let product_size = $('#product_size').text();
            let qty = $('#qty').val();
            let attribute_id = $('#attribute_id').val();
            const main_url = 'http://localhost:8000';

            $.ajax({
                url: main_url + "/modal/data/get",
                method : "POST",
                type: 'json',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {product_name:product_name,tax:tax,discount_price:discount_price,attribute_id:attribute_id,selling_price:selling_price,purchase_price:purchase_price,id:id,product_color:product_color,product_size:product_size,qty:qty},
                success: function (data){
                    $('#close').click();
                    window.location.reload();
                    const Toast = Swal.mixin({
                        toast:true,
                        position: 'top-end',

                        showConfirmButton: false,
                        timer: 1500,
                    });
                    if( $.isEmptyObject(data.error) ){
                        Toast.fire({
                            type : 'success',
                            icon: 'success',
                            title : data.success,
                        });
                    }else{
                        Toast.fire({
                            type : 'error',
                            icon: 'error',
                            title : data.error,
                        });
                    }
                }
            })
        });

            $(document).on('keyup','input.search', function (){

                let search_text = $(this).val();
                const main_url = 'http://localhost:8000';

                $.ajax({
                    url: main_url + "/search/product",
                    method: "POST",
                    type: "json",
                    data: {search_text:search_text},
                    success: function (data){
                        console.log(data)
                                var bodyName = '';
                                $.each(data,function (key,value){
                                    bodyName += `

                                <div class="col-lg-3 col-md-3 col-sm-4">
                                    <div class="card shadow-sm my-3">
                                        <div class="card-body product-cart">
                                            <img id="img" style="width: 150px; height: 200px;" src="${main_url}/uploads/products/${value.image}" alt="">
                                            <p id="name">${value.name}</p>
                                            <div class="price">
                                            <p><strong>Selling Price:</strong><del>${value.selling_price}</del></p>
                                            <p><strong>Purchase Price:</strong>${value.purchase_price}</p>
                                </div>
                                <p id="sku"><strong>SKU:</strong>${value.sku}</p>
                                            <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" id="addToCart" product_id="${value.id}" class="btn btn-info add-cart" href="#">Add to Cart</a>
                                        </div>
                                    </div>
                                </div>


                                `
                                });
                        $('.searchBody').html(bodyName)
                        }
                })
            });

        // $(document).on('keyup','input.search', function (){
        //     let search_text = $(this).val();
        //     const main_url = 'http://localhost:8000';
        //
        //     $.ajax({
        //         url: main_url + "/search/product/code",
        //         method: "POST",
        //         type: "json",
        //         data: {search_text:search_text},
        //         success: function (data){
        //             var bodyCode = '';
        //             $.each(data,function (key,value){
        //                 bodyCode += `
        //
        //                         <div class="col-lg-3 col-md-3 col-sm-4">
        //                             <div class="card shadow-sm my-3">
        //                                 <div class="card-body product-cart">
        //                                     <img id="img" style="width: 150px; height: 200px;" src="${main_url}/uploads/products/${value.image}" alt="">
        //                                     <p id="name">${value.name}</p>
        //                                     <div class="price">
        //                                     <p><strong>Selling Price:</strong><del>${value.selling_price}</del></p>
        //                                     <p><strong>Purchase Price:</strong>${value.purchase_price}</p>
        //                         </div>
        //                         <p id="sku"><strong>SKU:</strong>${value.sku}</p>
        //                                     <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" id="addToCart" product_id="${value.id}" class="btn btn-info add-cart" href="#">Add to Cart</a>
        //                                 </div>
        //                             </div>
        //                         </div>
        //
        //
        //                         `
        //
        //             });
        //             $('.searchBody').html(bodyCode)
        //         }
        //     });
        // });
    });
</script>

@endsection
