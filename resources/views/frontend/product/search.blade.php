@extends('frontend.layouts.app')
@section('title', 'Search')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Features Items</h2>
                        <div class="col-sm-12">
                            <form method="post" class="row">
                                @csrf
                                <input class="col-sm-2" type="text" name="name" placeholder="Search">
                                <select class="col-sm-2" name="price">
                                    <option value="0">-- Select Price --</option>
                                    <option value="1">500 - 1000</option>
                                    <option value="2">1000 - 2000</option>
                                    <option value="3">2000 - 3000</option>
                                    <option value="4">3000 - 4000</option>
                                </select>
                                <select class="col-sm-2" name="category">
                                    <option value="1">-- Select Category --</option>
                                    @if(isset($categories))
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <select class="col-sm-2" name="brand">
                                    <option value="1">-- Select Brand --</option>
                                    @if(isset($brands))
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->brand }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <select class="col-sm-2 mr-2" name="status">
                                    <option value="0">-- Select Status --</option>
                                    <option value="1">New</option>
                                    <option value="0">Sale</option>
                                </select>
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-primary" style="margin: 0;">Search</button>
                                </div>
                            </form>
                        </div>
                        @if(isset($products))
                            @foreach($products as $product)
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                @php $images = json_decode($product->image, true); @endphp
                                                @if(is_array($images) && count($images) > 0)
                                                    <img src="{{ asset('upload/product/329x380/'.$images[0]) }}" alt="" />
                                                @endif
                                                <h2>${{ $product->price }}</h2>
                                                <p>{{ $product->name }}</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                            <div class="product-overlay">
                                                <div class="overlay-content">
                                                    <h2>${{ $product->price }}</h2>
                                                    <p>{{ $product->name }}</p>
                                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="choose">
                                            <ul class="nav nav-pills nav-justified">
                                                <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                                <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div><!--features_items-->
                    <div class="text-center">
                        <ul class="pagination">
                            <li class="active"><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                            <li><a href="">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
