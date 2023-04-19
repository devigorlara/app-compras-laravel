<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //get all products
    public function index()
    {
        $products = Product::with('productModels')->get();

        return response()->json([
            'products' => $products,
        ], 200);
    }

    //get single product
    public function show($id)
    {
        $product = Product::where('id',$id)::with('productModels')->get();
        return response([
            'products' => $product,
        ], 200);
    }

    //create a Product
    public function store(Request $request)
    {
        //validate fields
        $attrs = $request->validate([
            'total_size' => 'required|integer',
            'type_id' => 'required|integer',
            'offset' => 'required|integer'
        ]);


        $product = Product::create([
            'total_size' => $attrs['total_size'],
            'type_id' => $attrs['type_id'],
            'offset' => $attrs['offset'],
            'user_id' => auth()->user()->id,
        ]);

        return response([
            'message' => 'Product created.',
            'product' => $product
        ], 200);
    }

    //update a post
    public function update(Request $request, $id)
    {

        $product = Product::find($id);

        if(!$product)
        {
            return response([
                'message' => 'Product not found.'
            ], 403);
        }

        if($product->user_id != auth()->user()->id)
        {
            return response([
                'message' => 'Permission denied.'
            ], 403);
        }

        //validate fields
        $attrs = $request->validate([
            'total_size' => 'required|integer',
            'type_id' => 'required|integer',
            'offset' => 'required|integer'
        ]);

        $post->update([
            'total_size' => $attrs['total_size'],
            'type_id' => $attrs['type_id'],
            'offset' => $attrs['offset'],
        ]);

        return response([
            'message' => 'Product updated.',
            'product' => $product
        ], 200);
    }
    public function destroy($id)
    {
        $product = Product::find($id);

        if(!$product)
        {
            return response([
                'message' => 'Post not found.'
            ], 403);
        }

        if($product->user_id != auth()->user()->id)
        {
            return response([
                'message' => 'Permission denied.'
            ], 403);
        }

        $product->productModels()->delete();
        $product->delete();

        return response([
            'message' => 'Post updated.'
        ], 200);
    }
}
