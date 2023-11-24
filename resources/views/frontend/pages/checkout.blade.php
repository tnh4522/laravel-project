@extends('frontend.layouts.app')
@section('title', 'Checkout')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li class="active">Check out</li>
                </ol>
            </div><!--/breadcrums-->
            @if(!Auth::check())
                <div class="register-req">
                    <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
                </div><!--/register-req-->
            @endif
            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="shopper-info">
                            <p>Customer Information*</p>
                            <form method="post">
                                @csrf
                                <input type="text" name="name" value="{{ Auth::check() ? Auth::user()->name : '' }}" placeholder="Full Name">
                                @if(isset($errors->messages()['name']))
                                    @foreach($errors->messages()['name'] as $error)
                                        <p style="color:red; font-size: 13px">{{$error}}</p>
                                    @endforeach
                                @endif
                                <input type="text" name="email" value="{{ Auth::check() ? Auth::user()->email : '' }}" placeholder="Email Address">
                                @if(isset($errors->messages()['email']))
                                    @foreach($errors->messages()['email'] as $error)
                                        <p style="color:red; font-size: 13px">{{$error}}</p>
                                    @endforeach
                                @endif
                                <input type="text" name="phone" value="{{ Auth::check() ? Auth::user()->phone : '' }}" placeholder="Phone Number">
                                @if(isset($errors->messages()['phone']))
                                    @foreach($errors->messages()['phone'] as $error)
                                        <p style="color:red; font-size: 13px">{{$error}}</p>
                                    @endforeach
                                @endif
                                <input type="text" name="address" value="{{ Auth::check() ? Auth::user()->address : '' }}" placeholder="Address">
                                @if(isset($errors->messages()['address']))
                                    @foreach($errors->messages()['address'] as $error)
                                        <p style="color:red; font-size: 13px">{{$error}}</p>
                                    @endforeach
                                @endif
                                <select name="id_country" style="margin-bottom: 10px; padding: 10px 5px">
                                    @if(isset($countries))
                                        <option value="">-- Country --</option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}"
                                                    @if(Auth::check() && Auth::user()->id_country == $country->id)
                                                        selected
                                                @endif>{{$country->country_name}}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @if(isset($errors->messages()['id_country']))
                                    @foreach($errors->messages()['id_country'] as $error)
                                        <p style="color:red; font-size: 13px">{{$error}}</p>
                                    @endforeach
                                @endif
                                <select name="payment_method" style="padding: 10px 5px">
                                    <option value="">-- Select Payment Method --</option>
                                    <option value="1">Cash On Delivery</option>
                                    <option value="2">QR Code</option>
                                    <option value="3">Credit Card</option>
                                    <option value="4">Direct Bank Transfer</option>
                                </select>
                                @if(isset($errors->messages()['payment_method']))
                                    @foreach($errors->messages()['payment_method'] as $error)
                                        <p style="color:red; font-size: 13px">{{$error}}</p>
                                    @endforeach
                                @endif
                                @if(isset($products))
                                    @php $total = 0; @endphp
                                    @foreach($products as $product)
                                        @php $total += $product['price'] * $product['quantity']; @endphp
                                    @endforeach
                                    <input id="total-price" type="hidden" name="total" value="{{$total}}">
                                @endif
                                <button type="button" class="btn btn-primary" onclick="window.location.href='/cart'">Back</button>
                                <button type="submit"  class="btn btn-primary">Continue</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-5 clearfix">
                        <div class="bill-to">
                            <p>Bill Information</p>
                            <div class="form-one">
                                <form>
                                    <input type="text" placeholder="Company Name">
                                    <input type="text" placeholder="Email*">
                                    <input type="text" placeholder="Title">
                                    <input type="text" placeholder="First Name *">
                                    <input type="text" placeholder="Middle Name">
                                    <input type="text" placeholder="Last Name *">
                                    <input type="text" placeholder="Address 1 *">
                                    <input type="text" placeholder="Address 2">
                                </form>
                            </div>
                            <div class="form-two">
                                <form>
                                    <input type="text" placeholder="Zip / Postal Code *">
                                    <select>
                                        <option>-- Country --</option>
                                        <option>United States</option>
                                        <option>Bangladesh</option>
                                        <option>UK</option>
                                        <option>India</option>
                                        <option>Pakistan</option>
                                        <option>Ucrane</option>
                                        <option>Canada</option>
                                        <option>Dubai</option>
                                    </select>
                                    <select>
                                        <option>-- State / Province / Region --</option>
                                        <option>United States</option>
                                        <option>Bangladesh</option>
                                        <option>UK</option>
                                        <option>India</option>
                                        <option>Pakistan</option>
                                        <option>Ucrane</option>
                                        <option>Canada</option>
                                        <option>Dubai</option>
                                    </select>
                                    <input type="password" placeholder="Confirm password">
                                    <input type="text" placeholder="Phone *">
                                    <input type="text" placeholder="Mobile Phone">
                                    <input type="text" placeholder="Fax">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="order-message">
                            <p>Shipping Order</p>
                            <textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
                            <label><input type="checkbox"> Shipping to bill address</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="review-payment">
                <h2>Review & Payment</h2>
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
                                <td class="cart_delete" id="{{$product['id']}}">
                                    <input type="hidden" name="product_id" value="{{$product['id']}}">
                                    <a class="cart_quantity_delete"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4">&nbsp;</td>
                            <td colspan="2">
                                <table class="table table-condensed total-result">
                                    <tr>
                                        <td>Cart Sub Total</td>
                                        <td>$59</td>
                                    </tr>
                                    <tr>
                                        <td>Exo Tax</td>
                                        <td>$2</td>
                                    </tr>
                                    <tr class="shipping-cost">
                                        <td>Shipping Cost</td>
                                        <td>Free</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        @if(isset($products))
                                            @php $total = 0; @endphp
                                            @foreach($products as $product)
                                                @php $total += $product['price'] * $product['quantity']; @endphp
                                            @endforeach
                                            <td><span class="total-price">${{$total}}</span></td>
                                        @endif
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->
@endsection
