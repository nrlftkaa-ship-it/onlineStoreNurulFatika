<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Admin Page - Products - Online Store";
        $viewData["subtitle"] = "List of products";
        $viewData["products"] = Product::all();
        return view('admin.product.index')->with("viewData", $viewData);
    }

    public function create()
    {
        $viewData = [];
        $viewData["title"] = "Admin Page - Create Product - Online Store";
        return view('admin.product.create')->with("viewData", $viewData);
    }

    public function store(ProductRequest $request)
    {
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('img'), $imageName);
        $productData = $request->all();
        $productData['image'] = $imageName;
        Product::create($productData);
        return redirect()->route('admin.product.index');
    }

    public function show($id)
    {
        $viewData = [];
        $product = Product::findOrFail($id);
        $viewData["title"] = $product->getName()." - Online Store";
        $viewData["subtitle"] = $product->getName()." - Product information";
        $viewData["product"] = $product;
        return view('admin.product.show')->with("viewData", $viewData);
    }

    public function edit($id)
    {
        $viewData = [];
        $product = Product::findOrFail($id);
        $viewData["title"] = "Admin Page - Edit Product - Online Store";
        $viewData["product"] = $product;
        return view('admin.product.edit')->with("viewData", $viewData);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|gt:0',
        ]);

        $product = Product::findOrFail($id);
        $productData = $request->all();
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('img'), $imageName);
            $productData['image'] = $imageName;
        }
        $product->fill($productData);
        $product->save();
        return redirect()->route('admin.product.index');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.product.index');
    }
}