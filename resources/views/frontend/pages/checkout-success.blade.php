@extends('frontend.layouts.app')
@section('title', 'Success')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Your order has been placed successfully.</h3>
                <p>Your order number is {{ $data['id_country'] }} and total payable about is ${{ $data['total'] }}</p>
                <p>Thanks for shopping with us. We will ship your product very soon.</p>
            </div>
        </div>
    </div>
@endsection
