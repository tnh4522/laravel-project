$(document).ready(function(){
    const rating_user = $('.vote').find('.rate-user').html();
    let hasRated = false;

    if(parseInt(rating_user) > 0) {
        hasRated = true;
        $('.ratings_stars').each(function () {
            if ($(this).find("input").val() <= parseInt(rating_user )) {
                $(this).prevAll().andSelf().addClass('ratings_over');
            }
        });
    } else {

        $('.ratings_stars')
            .hover(
                function() {
                    if(!hasRated) {
                        $(this).prevAll().andSelf().addClass('ratings_hover');
                    }
                },
                function() {
                    if(!hasRated) {
                        $(this).prevAll().andSelf().removeClass('ratings_hover');
                    }
                }
            )
            .click(function(){
                if(!hasRated) {
                    const value = $(this).find("input").val();
                    $('.rate-np').html(parseInt(value).toFixed(1));

                    if ($(this).hasClass('ratings_over')) {
                        $('.ratings_stars').removeClass('ratings_over');
                        $(this).prevAll().andSelf().addClass('ratings_over');
                    } else {
                        $(this).prevAll().andSelf().addClass('ratings_over');
                    }
                }
            });


        $('.confirm-rate').click(function () {
            if(!hasRated) {
                const id_blog = $('.vote').find('.blog-id').val();
                const rating = $(this).closest('.rating-area').find('.rate-np').html();

                $.ajax({
                    method: "POST",
                    url: "/blog/rating",
                    data: {
                        id_blog: id_blog,
                        rating: rating
                    },
                    success: function (res) {
                        if(res['status'] === 200) {
                            hasRated = true; // Đặt hasRated thành true để không cho phép đánh giá nữa
                            const rating = res['data']['rating'];
                            if(parseInt(rating) > 0) {
                                $('.ratings_stars').each(function () {
                                    if ($(this).find("input").val() <= parseInt(rating)) {
                                        $(this).prevAll().andSelf().addClass('ratings_over');
                                    }
                                });
                                alert(res['message']);
                            }
                        }
                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            }
        });
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
