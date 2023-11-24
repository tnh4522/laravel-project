$(document).ready(function(){
    $('.post-comment').click(function () {
        const id_blog = $('.vote').find('.blog-id').val();
        const comment = $('.replay-box textarea').val();
        const id_comment = $('.replay-box input.hidden-comment-id').val();
        $.ajax({
            method: "POST",
            url: "/blog/comment",
            data: {
                id_blog: id_blog,
                comment: comment,
                id_parent: id_comment ? id_comment : 0
            },
            success: function (res) {
                console.log(res);
                if (res['status'] === 200) {
                    const src = `http://127.0.0.1:8000/upload/user/avatar/${res['data']['image_user']}`;
                    const html =
                        '<li class="media" id="' + res['id_comment'] + '">' +
                        '<a class="pull-left">' +
                        `<img class="media-object" src="${src}" alt="">` +
                        '</a>' +
                        '<div class="media-body">' +
                        '<ul class="sinlge-post-meta">' +
                        `<li><i class="fa fa-user"></i> ${res['data']['name_user']}</li>` +
                        `<li><i class="fa fa-clock-o"></i> ${res['created_at']}</li>` +
                        `<li><i class="fa fa-calendar"></i> ${res['updated_at']}</li>` +
                        '</ul>' +
                        `<p>${res['data']['comment']}</p>` +
                        '<a class="btn btn-primary reply-comment"><i class="fa fa-reply"></i>Reply</a>' +
                        '</div>' +
                        '</li>';

                    $('.replay-box textarea').val('');
                    $('.replay-box input.hidden-comment-id').remove();
                    $('.media-list').append(html);
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    });

    $('.reply-comment').click(function(e){
        e.preventDefault();

        const commentId = $(this).closest('.media').attr('id');

        $('.replay-box textarea').focus();

        if ($('.replay-box input.hidden-comment-id').length === 0) {

            $('<input>').attr({
                type: 'hidden',
                class: 'hidden-comment-id',
                value: commentId
            }).appendTo('.replay-box .text-area');
        } else {

            $('.replay-box input.hidden-comment-id').val(commentId);
        }
    });
});
