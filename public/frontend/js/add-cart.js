$(document).ready(function () {
    $('.add-to-cart').click(function () {
        const id_product = $(this).attr('id');
        const incrementBy = $(this).parent().find('input[name="quantity"]').val();
        $.ajax({
            method: 'POST',
            url: '/cart/add',
            data: {id: id_product, quantity: 1, incrementBy: incrementBy},
            success: function (response) {
                console.log(response);
                $('.cart-total-items').html(response.count);
            },
            error: function (error) {
                console.log(error);
            }
        });
        $(this).parent().find('input[name="quantity"]').val(1);
    });
    $('.cart_quantity_up').click(function () {
        $(this).parent().find('input[name="quantity"]').val(parseInt($(this).parent().find('input[name="quantity"]').val()) + 1);
        const id_product = $(this).parent().find('input[name="quantity"]').attr('id');
        $.ajax({
            method: 'POST',
            url: '/cart/add',
            data: {id: id_product, quantity: 1},
            success: function (response) {
                console.log(response);
                $('.cart-total-items').html(response.count);
                $('.total-price').html("$" + response.total);
                $('input[type="hidden"][name="total"]').val(response.total);
            },
            error: function (error) {
                console.log(error);
            }
        });
        const price = parseDollarToInt($(this).parent().parent().parent().find('.cart_price p').html());
        const quantity = $(this).parent().find('input[name="quantity"]').val();
        $(this).parent().parent().parent().find('.cart_total_price').html("$" + (price * parseInt(quantity)));
    });
    $('.cart_quantity_down').click(function () {
        $(this).parent().find('input[name="quantity"]').val(parseInt($(this).parent().find('input[name="quantity"]').val()) - 1);
        const id_product = $(this).parent().find('input[name="quantity"]').attr('id');
        const checkQuantity = $(this).parent().find('input[name="quantity"]').val() < 1;
        if (checkQuantity) {
            $(this).parent().parent().parent().remove();
        }
        $.ajax({
            method: 'POST',
            url: '/cart/add',
            data: {id: id_product, decrementBy: 1, action: checkQuantity ? 'delete' : ''},
            success: function (response) {
                console.log(response);
                $('.cart-total-items').html(response.count);
                $('.total-price').html("$" + response.total);
                $('input[type="hidden"][name="total"]').val(response.total);
            },
            error: function (error) {
                console.log(error);
            }
        });
        const price = parseDollarToInt($(this).parent().parent().parent().find('.cart_price p').html());
        const quantity = $(this).parent().find('input[name="quantity"]').val();
        $(this).parent().parent().parent().find('.cart_total_price').html("$" + (price * parseInt(quantity)));
    });
    $('.cart_quantity_delete').click(function () {
        const id_product = $(this).closest('td').find('input[name="product_id"]').val();
        console.log(id_product);
        $(this).parent().parent().remove();
        $.ajax({
            method: 'POST',
            url: '/cart/add',
            data: {id: id_product, action: 'delete'},
            success: function (response) {
                console.log(response);
                $('.cart-total-items').html(response.count);
                $('.total-price').html("$" + response.total);
                $('input[type="hidden"][name="total"]').val(response.total);
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
    function parseDollarToInt(dollarString) {
        const numberString = dollarString.replace(/[$,]/g, '');
        return parseInt(numberString, 10);
    }
});
