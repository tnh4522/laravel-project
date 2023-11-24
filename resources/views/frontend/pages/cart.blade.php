@extends('frontend.layouts.app')
@section('title', 'Cart')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($products))
                        @foreach($products as $product)
                            <tr>
                                <td class="cart_product">
                                    @php $images = json_decode($product['image'], true); @endphp
                                    @if(is_array($images) && count($images) > 0)
                                        <a href=""><img src="{{ asset('upload/product/85x84/'.$images[0]) }}" alt=""></a>
                                    @else
                                        <span>No Image</span>
                                    @endif
                                </td>
                                <td class="cart_description">
                                    <h4><a href="">{{$product['name']}}</a></h4>

                                    <p>Web ID: {{$product['web_id']}}</p>
                                </td>
                                <td class="cart_price">
                                    <p>${{$product['price']}}</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <a class="cart_quantity_down"> - </a>
                                        <input class="cart_quantity_input" id="{{$product['id']}}" type="text" name="quantity" autocomplete="off" size="2" value="{{$product['quantity']}}" readonly>
                                        <a class="cart_quantity_up"> + </a>
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">${{$product['price'] * $product['quantity']}}</p>
                                </td>
                                <td class="cart_delete">
                                    <input type="hidden" name="product_id" value="{{$product['id']}}">
                                    <a class="cart_quantity_delete"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->

    <section id="do_action">
        <div class="container">
            <div class="heading">
                <h3>What would you like to do next?</h3>
                <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="chose_area">
                        <ul class="user_option">
                            <li>
                                <input type="checkbox">
                                <label>Use Coupon Code</label>
                            </li>
                            <li>
                                <input type="checkbox">
                                <label>Use Gift Voucher</label>
                            </li>
                            <li>
                                <input type="checkbox">
                                <label>Estimate Shipping & Taxes</label>
                            </li>
                        </ul>
                        <ul class="user_info">
                            <li class="single_field">
                                <label>Country:</label>
                                <select>
                                    <option>United States</option>
                                    <option>Bangladesh</option>
                                    <option>UK</option>
                                    <option>India</option>
                                    <option>Pakistan</option>
                                    <option>Ucrane</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>

                            </li>
                            <li class="single_field">
                                <label>Region / State:</label>
                                <select>
                                    <option>Select</option>
                                    <option>Dhaka</option>
                                    <option>London</option>
                                    <option>Dillih</option>
                                    <option>Lahore</option>
                                    <option>Alaska</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>

                            </li>
                            <li class="single_field zip-field">
                                <label>Zip Code:</label>
                                <input type="text">
                            </li>
                        </ul>
                        <a class="btn btn-default update" href="">Get Quotes</a>
                        <a class="btn btn-default check_out" href="">Continue</a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li>Cart Sub Total <span>$59</span></li>
                            <li>Eco Tax <span>$2</span></li>
                            <li>Shipping Cost <span>Free</span></li>
                            @if(isset($products))
                                @php $total = 0; @endphp
                                @foreach($products as $product)
                                    @php $total += $product['price'] * $product['quantity']; @endphp
                                @endforeach
                                <li>Total <span class="total-price">${{$total}}</span></li>
                            @endif
                        </ul>
                        <a class="btn btn-default update" href="">Update</a>
                        <a class="btn btn-default check_out" href="cart/check-out">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#do_action-->
@endsection
