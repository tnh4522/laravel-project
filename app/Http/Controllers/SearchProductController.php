<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        return view('frontend.product.search', compact('products', 'categories', 'brands'));
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $products = Product::where('name', 'like', '%' . $search . '%')->paginate(10);
        return view('frontend.product.search', compact('products'));
    }

    public function searchAdvanced(Request $request)
    {
        $search = $request->all();
        if($search['price'] > 0) {
            $search['price_from'] = explode('-', $search['price'])[0];
            $search['price_to'] = explode('-', $search['price'])[1];
        } else {
            $search['price_from'] = 0;
            $search['price_to'] = 100000000;
        }
        $products = Product::where('name', 'like', '%' . $search['name'] . '%')
            ->where('category_id',$search['category'])
            ->where('brand_id', $search['brand'])
            ->where('price', '>=', $search['price_from'])
            ->where('price', '<=', $search['price_to'])
            ->paginate(10);
        return view('frontend.product.search', compact('products'));
    }
    public function searchPrice(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            $products = Product::select('*')->whereBetween('price', [$data['price_min'], $data['price_max']])->get();
            return response()->json([
                'data' => $data,
                'products' => $products,
            ]);
        }
    }
}
