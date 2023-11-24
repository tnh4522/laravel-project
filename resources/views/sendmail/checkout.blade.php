@extends('frontend.layouts.app')
@section('title', 'Checkout')
@section('content')
    <div>
        @if(isset($data))
            <p>Dear {{ $data['name'] }},</p>
            <p>Thank you for your order. Your order has been received and is now being processed. Your order details are shown below for your reference:</p>
{{--            <p>Order ID: {{ $data['order_id'] }}</p>--}}
{{--            <p>Order Total: {{ $data['order_total'] }}</p>--}}
{{--            <p>Order Date: {{ $data['order_date'] }}</p>--}}
{{--            <p>Order Status: {{ $data['order_status'] }}</p>--}}
{{--            <p>Order Details</p>--}}
{{--            <table>--}}
{{--                <thead>--}}
{{--                    <tr>--}}
{{--                        <th>Product Name</th>--}}
{{--                        <th>Product Price</th>--}}
{{--                        <th>Product Quantity</th>--}}
{{--                        <th>Product Subtotal</th>--}}
{{--                    </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                    @foreach($data['order_details'] as $order)--}}
{{--                        <tr>--}}
{{--                            <td>{{ $order['product_name'] }}</td>--}}
{{--                            <td>{{ $order['product_price'] }}</td>--}}
{{--                            <td>{{ $order['product_quantity'] }}</td>--}}
{{--                            <td>{{ $order['product_subtotal'] }}</td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--            <p>Thank you for shopping with us.</p>--}}
{{--            <p>Regards,</p>--}}
{{--            <p>{{ $data['name'] }}</p>--}}
        @endif
    </div>
@endsection
