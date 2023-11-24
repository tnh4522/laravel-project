<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckOutRequest;
use App\Mail\MailCheckOutNotify;
use App\Models\Country;
use App\Models\History;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
//        $request->session()->forget('cart');
        if( $request->session()->has('cart')) {
            $value = $request->session()->get('cart');
            $data = [];
            foreach($value as $key => $item) {
                $data[] = $key;
            }
            $products = Product::whereIn('id', $data)->get()->toArray();
            foreach ($products as $key => $product) {
                $products[$key]['quantity'] = $value[$product['id']];
            }
            return view('frontend.pages.cart', compact('products'));
        }
        return view('frontend.pages.cart');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function checkOut(CheckOutRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::check() ? Auth::id() : null;
        $data['subject'] = 'Confirm order - '.date('Y-m-d H:i:s');
        try {
            Mail::to('frank.moore4522@gmail.com')->send(new MailCheckOutNotify($data));
            if($request->session()->has('cart')) {
                $request->session()->forget('cart');
            }
            if(count($data) > 0) {
                $history = new History();
                $history->fill($data);
                $history->save();
            }
            return view('frontend.pages.checkout-success', compact('data'));
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Mail sent failed',
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function add(Request $request)
    {
        if($request->ajax()) {
            $product_id = $request->id;
            $quantity = $request->quantity;
            $incrementBy = $request->incrementBy;
            $decrementBy = $request->decrementBy;
            $action = $request->action;
            if(!session()->has('cart.'.$product_id)) {
                session()->put('cart.'.$product_id, $quantity);
            }
            else {
                session()->increment('cart.'.$product_id, $incrementBy ?? $quantity);
            }
            if(!empty($decrementBy)) {
                session()->decrement('cart.'.$product_id, $decrementBy);
            }
            if($action === 'delete') {
                session()->forget('cart.'.$product_id);
            }
        }
        $count = 0;
        $total = 0;
        if($request->session()->has('cart')) {
            $value = $request->session()->get('cart');
            foreach($value as $key => $item) {
                $count += $item;
                $product = Product::find($key);
                $total += $product->price * $item;
            }
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Add to cart successfully',
            'count' => $count,
            'total' => $total,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        if($request->session()->has('cart')) {
            $value = $request->session()->get('cart');
            $countries = Country::all();
            $data = [];
            foreach($value as $key => $item) {
                $data[] = $key;
            }
            $products = Product::whereIn('id', $data)->get()->toArray();
            foreach ($products as $key => $product) {
                $products[$key]['quantity'] = $value[$product['id']];
            }
            return view('frontend.pages.checkout', compact('products', 'countries'));
        }
        return view('frontend.pages.checkout');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
