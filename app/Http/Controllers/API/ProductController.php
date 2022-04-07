<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // all products
    public function index()
    {
        $products = Product::all()->toArray();
        return array_reverse($products);
    }

    // add Product
    public function add(Request $request)
    {
        dd($request);
        $product = new Product([
            'name' => $request->name,
            'price' => $request->price,
            'status' => $request->status,
        ]);
        $product->save();

        return response()->json('The Product successfully added');
    }

    // edit Product
    public function edit($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    // update Product
    public function update($id, Request $request)
    {
        $product = Product::find($id);
        $product->update($request->all());

        return response()->json('The Product successfully updated');
    }

    // delete Product
    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();

        return response()->json('The Product successfully deleted');
    }

    // change status of product
    public function changeStatus($id)
    {
        $product = Product::find($id);
        if($product->status == 'Active'){
            $status['status'] = 'Inactive';
        }else{
            $status['status'] = 'Active';
        }
        $product->update($status);

        if ($product) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}
