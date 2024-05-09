<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class IndexController extends Controller
{
    public function dashboard()
    {
        return view('index');
    }

    public function userLogout()
    {
        Auth::guard('web')->logout();

        return redirect()->route('login');
    }

    public function productStore(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'unit' => 'required',
            'selling_price' => 'required',
            'tax' => 'required',
            'image' => 'required',
        ]);

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $unique_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $image = $manager->read($image);
            $image->resize(200, 350);
            $image->toPng()->save('uploads/products/'.$unique_name);
        }

        Product::insert([
            'name' => $request->name,
            'unit' => $request->unit,
            'sku' => $request->sku,
            'selling_price' => $request->selling_price,
            'purchase_price' => $request->purchase_price,
            'discount' => $request->discount,
            'tax' => $request->tax,
            'image' => $unique_name,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Product Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    }

    public function allProduct()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.all_product', compact('products'));
    }

    public function editProduct($id)
    {
        $edit_data = Product::find($id);
        return view('admin.edit_product', compact('edit_data'));
    }

    public function updateProduct(Request $request, $id)
    {
        $update_product = Product::find($id);

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $unique_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $image = $manager->read($image);
            $image->resize(200, 350);
            $image->toPng()->save('uploads/products/'.$unique_name);
            if ($update_product->image){
                unlink('uploads/products/'.$request->old_image);
            }
        }else{
            $unique_name = $request->old_image;
        }

        $update_product->name = $request->name;
        $update_product->unit = $request->unit;
        $update_product->sku = $request->sku;
        $update_product->selling_price = $request->selling_price;
        $update_product->purchase_price = $request->purchase_price;
        $update_product->discount = $request->discount;
        $update_product->tax = $request->tax;
        $update_product->image = $unique_name;
        $update_product->updated_at = Carbon::now();
        $update_product->update();


        $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    }



    public function deleteProduct($id)
    {
        $delete_product = Product::find($id);
        $delete_product->delete();
        if ($delete_product->image){
            unlink('uploads/products/'.$delete_product->image);
        }
        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'warning'
        );
        return redirect()->back()->with($notification);
    }












}
