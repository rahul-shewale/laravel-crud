<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    //
    public function index() {
        return view('products.index', [
            'products' => Product::latest()->paginate(2)
        ]); 
    }

    public function create() {
        return view('products.create');
    }

    public function store(Request $request) {

        $request->validate([
            'name'  => 'string|required',
            'description'  => 'string|required',
            'image'  => 'required|mimes:jpeg,jpg,png,gif|max:10000',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('products'), $imageName);
    
        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->image = $imageName;

        $product->save();

        return back()->withSuccess('Product Created successfully!!');

    }

    public function edit($id) {
        $product = Product::where('id', $id)->first();
        return view('products.edit', ['product' => $product]);
    }

    public function update( Request $request,$id) {
        $request->validate([
            'name' => 'string|required',
            'description' => 'string|required',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000'
        ]);

        $product = Product::where('id', $id)->first();

        if( isset( $request->image ) ) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('products'), $imageName);
            $product->image = $imageName;
        }

        $product->name = $request->name;
        $product->description = $request->description;

        $product->save();

        return back()->withSuccess('Product updated successfully!!');

    }

    public function destroy($id) {
        $product = Product::where('id', $id)->first();
        $product->delete();

        return back();
    }

    public function show($id) {
        $product = Product::where('id', $id)->first();

        return view('products/show', compact('product'));
    }

    // public function harddelete() {

        
    //     $products = Product::all();
    //     $imageNames = [];

        
    //     $publicPath = public_path('products');
    //     $directoryImages = array_diff(scandir($publicPath), ['.', '..']);


    //     foreach ($products as $product) {
    //         if ($product->image) {
    //             $imageNames[] = $product->image;
    //         }
    //     }

    //     foreach ($directoryImages as $image) {
    //         if (!in_array($image, $imageNames)) {
    //             // Delete the image from the directory
    //             Log::info("Deleting: $image");
    //             Storage::delete("/products/$image");
    //             echo "Deleted: $image <br>";
    //         }
    //     }
        
    //     echo "Deletion complete!";

    // }

}
