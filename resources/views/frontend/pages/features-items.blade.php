<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Features Items</h2>
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
                            <a href="/product/detail/{{ $product->id }}"><p>{{ $product->name }}</p></a>
                            <a class="btn btn-default add-to-cart" id="{{ $product->id }}"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                        <div class="product-overlay">
                            <div class="overlay-content">
                                <h2>${{ $product->price }}</h2>
                                <a href="/product/detail/{{ $product->id }}"><p>{{ $product->name }}</p></a>
                                <a class="btn btn-default add-to-cart" id="{{ $product->id }}"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                        </div>
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div><!--features_items-->
