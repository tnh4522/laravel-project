<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public $successStatus = 200;
    public function productHome()
    {
        $products = Product::orderBy('updated_at', 'desc')->paginate(2);
        $products->load('category');
        $products->load('brand');
        $products->load('rating');
        return response()->json([
            'status' => 200,
            'data' => $products,
        ], $this->successStatus);
    }
    public function productList()
    {
        $products = Product::paginate(6);
        $products->load('category');
        $products->load('brand');
        $products->load('rating');
        return response()->json([
            'status' => 200,
            'data' => $products,
        ], $this->successStatus);
    }
    public function productWishList()
    {
        $products = Product::all();
        $products->load('category');
        $products->load('brand');
        $products->load('rating');
        return response()->json([
            'status' => 200,
            'data' => $products,
        ], $this->successStatus);
    }
    public function detail($id)
    {
        $data = Product::findOrFail($id);
        $data->load('category');
        $data->load('brand');
        $data->load('rating');
        $data['image'] = json_decode($data['image'], true);
        return response()->json([
            'status' => 200,
            'data' => $data,
        ], $this->successStatus);
    }
    public function productCart(Request $request)
    {
        $data = $request->json()->all();
        $getProduct = [];
        foreach ($data as $key => $value) {
            $get = Product::findOrFail($key)->toArray();
            $get['qty'] = $value;
            $getProduct[] = $get;
        }
        return response()->json([
            'response' => 'success',
            'data' => $getProduct
        ], $this->successStatus);
    }
    public function myProduct()
    {
        $getAllProductUser = Product::all()->where('id_user', Auth::user()->id)->toArray();
        return response()->json([
            'response' => 'success',
            'data' => $getAllProductUser
        ], $this->successStatus);
    }
    public function store(ProductRequest $request) {
        $data = $request->all();
        $file = $request->file('image');
        if($file) {
            $image = $file;
            $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            $data['image'] = $name;
        }
        $data['id_user'] = Auth::user()->id;
        if($getProduct = Product::create($data)) {
            if($file) {
                Image::make($file)->save(public_path('upload/product/').$data['image']);
            }
            return response()->json([
                'status' => 200,
                'data' => $getProduct,
            ], $this->successStatus);
        }
        return response()->json([
            'status' => 404,
            'error' => 'register failed'
        ], $this->successStatus);
    }
    public function show($id)
    {
        $data = Product::findOrFail($id);
        $data['image'] = json_decode($data['image'], true);
        return response()->json([
            'status' => 200,
            'data' => $data,
        ], $this->successStatus);
    }
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        $file = $request->file('image');
        if($file) {
            $image = $file;
            $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            $data['image'] = $name;
        }
        $data['id_user'] = Auth::user()->id;
        $product = Product::findOrFail($id);
        if($product->update($data)) {
            if($file) {
                Image::make($file)->save(public_path('upload/product/').$data['image']);
            }
            return response()->json([
                'status' => 200,
                'data' => $product,
            ], $this->successStatus);
        }
        return response()->json([
            'status' => 404,
            'error' => 'update failed'
        ], $this->successStatus);
    }
    public function delete($id)
    {
        $product = Product::findOrFail($id);
        if($product->delete()) {
            return response()->json([
                'status' => 200,
                'data' => $product,
            ], $this->successStatus);
        }
        return response()->json([
            'status' => 404,
            'error' => 'delete failed'
        ], $this->successStatus);
    }
}
