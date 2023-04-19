<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductModelController extends Controller
{
    //get all productmodels of a product
    public function index($id)
    {
        $product = Product::find($id);

        if(!$product)
        {
            return response([
                'message' => 'Product not found.'
            ], 403);
        }

        return response([
            'ProductModel' => $product->productModels()->get()
        ], 200);
    }

    //create a comment
    public function store(Request $request, $id)
    {
        $product = Product::find($id);

        if(!$product)
        {
            return response([
                'message' => 'Product not found.'
            ], 403);
        }

        //validate fields
        $attrs = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer',
            'stars' => 'required|integer',
            'location' => 'required|string',
        ]);

        Comment::create([
            'name' => $attrs['name'],
            'description' => $attrs['description'],
            'price' => $attrs['price'],
            'stars' => $attrs['stars'],
            'location' => $attrs['location'],
            'type_id' => $id
        ]);

        return response([
            'message' => 'ProductModel created.'
        ], 200);
    }

    //update a comment
    public function update(Request $request, $id)
    {
        $productModel = ProductModel::find($id);

        if(!$productModel)
        {
            return response([
                'message' => 'ProductModel not found.'
            ], 403);
        }

        //validate fields
        $attrs = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer',
            'stars' => 'required|integer',
            'location' => 'required|string',
            'type_id' => 'required|integer'
        ]);
        $comment->update([
            'name' => $attrs['name'],
            'description' => $attrs['description'],
            'price' => $attrs['price'],
            'stars' => $attrs['stars'],
            'location' => $attrs['location'],
        ]);

        return response([
            'message' => 'ProductModel updated'
        ], 200);
    }

    //delete a comment
    public function destroy($id)
    {
        $productModel = productModel::find($id);

        if(!$productModel)
        {
            return response([
                'message' => 'ProductModel not found.'
            ], 403);
        }

        $productModel->delete();

        return response([
            'message' => 'ProductModel deleted.'
        ], 200);
    }
}
