<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $Product = new Product([
            'name' => $request->name,
            'price' => $request->price
        ]);
        $Product->save();

        return response()->json('The Product successfully added');
    }

    // edit Product
    public function edit($id)
    {
        $Product = Product::find($id);
        return response()->json($Product);
    }

    // update Product
    public function update($id, Request $request)
    {
        $Product = Product::find($id);
        $Product->update($request->all());

        return response()->json('The Product successfully updated');
    }

    // delete Product
    public function delete($id)
    {
        $Product = Product::find($id);
        $Product->delete();

        return response()->json('The Product successfully deleted');
    }
}
