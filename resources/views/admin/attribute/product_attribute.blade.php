@extends('main_master')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="content" style="margin: 10px;">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header attribute-header">
                    <h4>{{ $product->name }}</h4>
                    <img style="height: 150px; width: 150px;" src="{{ URL::to('') }}/uploads/products/{{ $product->image }}" alt="">
                </div>
                <div class="card-body">
                    <form action="{{ route('attribute.store') }}" method="POST">
                        @csrf
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>SKU</th>
                                <th>Stock</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Selling Price</th>
                                <th>Purchase Price</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>


                        <tbody class="repeatItem">
                            <tr class="trClass">
                                <input name="product_id" value="{{ $product->id }}" type="hidden">
                                <td><input name="sku[]" type="text" required></td>

                                <td><input name="stock[]" type="number" required></td>

                                <td><input name="product_color[]" type="text" required></td>

                                <td><input name="product_size[]" type="text" required></td>

                                <td><input name="selling_price[]" type="number" required></td>

                                <td><input name="purchase_price[]" type="number" required></td>

                                <td>
                                    <a type="button" id="increment" class="btn btn-primary" href="#">++</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                        <button type="submit" class="btn btn-primary">Add Attribute</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 100px;">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>All Attributes</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Stock</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Selling Price</th>
                            <th>Purchase Price</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($attributes as $data)
                            <tr>
                                <td>{{ $data->sku }}</td>
                                <td>{{ $data->stock }}</td>
                                <td>{{ $data->product_color }}</td>
                                <td>{{ $data->product_size }}</td>
                                <td>{{ $data->selling_price }} $</td>
                                <td>{{ $data->purchase_price }} $</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('attribute.edit', [$data->id, $data->product_id]) }}">Edit</a>
                                    <a class="btn btn-danger" href="{{ route('attribute.delete',$data->id) }}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




<script>
    $(document).ready(function (){
        $(document).on('click','a#increment', function (e){
            e.preventDefault();

            let htmlBody = `<tr class="trClass">

                                    <td><input name="sku[]" type="text" required></td>

                                    <td><input name="stock[]" type="number" required></td>

                                    <td><input name="product_color[]" type="text" required></td>

                                    <td><input name="product_size[]" type="text" required></td>

                                    <td><input name="selling_price[]" type="number" required></td>

                                    <td><input name="purchase_price[]" type="number" required></td>

                                    <td>
                                        <a id="increment" class="btn btn-primary" href="#">++</a>
                                        <a id="decrement" class="btn btn-danger" href="#">--</a>
                                    </td>
                                </tr>`

            $('.repeatItem').append(htmlBody)
        })


        $(document).on('click','a#decrement', function (e){
            e.preventDefault();

            $(this).closest('.trClass').remove();
        })
    })
</script>




@endsection
