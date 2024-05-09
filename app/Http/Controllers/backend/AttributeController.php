<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function attributeView($id)
    {
        $attribute = Attribute::find($id);
        $product = Product::find($id);
        $attributes = Attribute::where('product_id',$id)->get();
        return view('admin.attribute.product_attribute', compact('attribute', 'product', 'attributes'));
    }

    public function attributeStore(Request $request)
    {

        $count = count($request->sku);

        for ($i=0; $i < $count; $i++){

            $attribute = new Attribute();
            $attribute->product_id = $request->product_id;
            $attribute->sku = $request->sku[$i];
            $attribute->stock = $request->stock[$i];
            $attribute->product_color = $request->product_color[$i];
            $attribute->product_size = $request->product_size[$i];
            $attribute->selling_price = $request->selling_price[$i];
            $attribute->purchase_price = $request->purchase_price[$i];
            $attribute->save();

        }
        $notification = array(
            'message' => 'Data inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function attributeEdit($id, $product_id)
    {
        $edit_data = Attribute::find($id);
        $attributes = Attribute::where('product_id',$product_id)->get();
        return view('admin.attribute.attribute_edit', compact('edit_data','attributes'));
    }

    public function attributeUpdate(Request $request,$id)
    {
        $update_data = Attribute::find($id);
        $update_data->sku = $request->sku;
        $update_data->stock = $request->stock;
        $update_data->product_color = $request->product_color;
        $update_data->product_size = $request->product_size;
        $update_data->selling_price = $request->selling_price;
        $update_data->purchase_price = $request->purchase_price;
        $update_data->updated_at = Carbon::now();
        $update_data->update();

        $notification = array(
            'message' => 'Attribute updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function attributeDelete($id)
    {
        $delete_data = Attribute::find($id);
        $delete_data->delete();

        $notification = array(
            'message' => 'Attribute delete successfully',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);
    }


}
