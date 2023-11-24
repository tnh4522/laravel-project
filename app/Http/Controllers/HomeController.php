<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $products = Product::orderBy('updated_at', 'desc')->take(6)->get();
        return view('frontend.layouts.app', compact('products'));
    }

}
