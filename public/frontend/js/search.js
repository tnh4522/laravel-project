$(document).ready(function () {
    $(".slider-horizontal").on('click', function (slideEvt) {
        const value = $(this).find(".tooltip-inner").text();
        const price = value.split(" : ");
        $.ajax({
            url: "/product/search/price",
            type: "POST",
            data: {
                price_min: parseInt(price[0]),
                price_max: parseInt(price[1])
            },
            success: function (data) {
                const products = data.products;
                let html = '';
                products.map((product) => {
                    const src = `http://127.0.0.1:8000/upload/product/329x380/${JSON.parse(product.image)[0]}`;
                    html += `
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="${src}" alt="" />
                                                <h2>${product.price}</h2>
                                                <p>${product.name}</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                            <div class="product-overlay">
                                                <div class="overlay-content">
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
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
                    `;
                });
                $(".features_items").html(html);
            }
        });
    });
});
