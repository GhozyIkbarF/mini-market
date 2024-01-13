<?php

namespace App\Http\Controllers;
// require 'vendor/autoload.php';
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('pages.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.product.create', compact('categories'));
    }

    public function store(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required',
            'description' => 'required',
            'image' => 'required',
            'discount' => 'nullable|numeric|max:100',
            'category' => 'array|required'
        ]);
        // dd($request->all());
      
        $imageName = '';
        $manager = new ImageManager(new Driver());
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME). time() . '.' . 'webp';
            $path = public_path('img/product/');
            // Storage::putFileAs('public/img/product', $image, $imageName);
            $img = $manager->read($image);
            $img->toWebp()->save($path . $imageName, 60);

        }

        // dd($request->all());
        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->image = $imageName;
        $product->discount = $request->discount;
        $product->save();
        $product->category()->attach($request->category);
        if($product){
            return redirect('/product')->with('success', 'product added successfully.');
        }
        return back()->with('error', 'Failed to add product.');


    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('product.edit', compact('product')); 
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'description' => 'required',
            'image' => 'required',
            'discount' => 'required',
        ]);
      
            $product = Product::find($id);
            $product->name = $request->name;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->description = $request->description;
            $product->image = $request->image;
            $product->discount = $request->discount;
            $product->save();
            if($product){
                return redirect('/product')->with('success', 'product updated successfully.');
            }
            return back()->with('error', 'Failed to update product.');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        if($product){
            return redirect('/product')->with('success', 'product deleted successfully.');
        }
        return back()->with('error', 'Failed to delete product.');
    }
}
