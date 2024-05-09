<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Order;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(Request $request)
    {

        $products = Product::latest()->paginate(12);
        $cart_products = Cart::content();
        return view('frontend.index', compact('products','cart_products'));
    }

    public function modalDataShow($id)
    {
        $product = Product::with('attributes')->find($id);
        return response()->json($product);
    }

    public function changeColor($id)
    {
        $attribute = Attribute::with('product')->find($id);
        return response()->json($attribute);
    }

    public function modalDataGet(Request $request)
    {
        $id = $request->id;
        $product = Product::find($id);
        if ($request->purchase_price == null){
            Cart::add([
                'id' => $request->attribute_id,
                'name' => $request->product_name,
                'qty' => $request->qty,
                'price' => $request->selling_price,
                'options' =>
                    [
                    'product_color' => $request->product_color,
                    'product_size' => $request->product_size,
                    'image' => $product->image
                    ]

                ]);


            return response()->json(['success'=>'Product added successfully on your cart']);
        }else{
            Cart::add([
                'id' =>$request->attribute_id,
                'name' => $request->product_name,
                'qty' => $request->qty,
                'price' => $request->purchase_price,
                'options' =>
                    [
                        'product_color' => $request->product_color,
                        'product_size' => $request->product_size,
                        'image' => $product->image
                    ]
            ]);


            return response()->json(['success'=>'Product added successfully on your cart']);
        }

    }


    public function orderStore(Request $request)
    {
        $cart_products = Cart::content();

        for ($i=0; $i < count($cart_products); $i++){
            $order = new Order();
            $order->image = $request->image[$i];
            $order->qty = $request->qty[$i];
            $order->name = $request->name[$i];
            $order->price = $request->price[$i];
            $order->save();
        }

        foreach($cart_products as $data){
            $id = $data->id;
            $attribute = Attribute::find($id);
            $attribute->stock = $attribute->stock - $data->qty;
            $attribute->update();
        }

        $notification = array(
            'message' => 'Order Placed Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }


    public function cartDelete($rowId)
    {
        Cart::remove($rowId);

        $notification = array(
            'message' => 'Cart Item Deleted Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);
    }


    public function searchProduct(Request $request)
    {
        $search_text = $request->search_text;
        $search = Product::where('name','LIKE',"%".$search_text."%")->orWhere('sku','LIKE',"%$search_text%")->get();

        return response()->json($search);
    }




}
