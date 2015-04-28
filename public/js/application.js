$(document).ready(function() {
    $('body').fadeIn('slow');

    $('.add-comment').click(function() {
        var postId = $(this).attr('data-post-id');
        $('#save-comment').attr('data-post-id', postId);

        $('#save-comment').unbind();
        $('#add-comment').modal();

        $('#save-comment').click(function() {
            var name = $('#comment-name').val();
            var comment = $('#comment-comment').val();

            if (name.length == 0) {
                alert('Please enter your name!');
                return false;
            }

            if (comment.length < 10) {
                alert('Your comment should have at least 10 characters...');
                return false;
            }

            $.post('index.php', {
                ajax: true,
                controller: 'Book',
                method: 'addComment',
                name: name,
                comment: comment,
                postId: $('#save-comment').attr('data-post-id')

            }, function() {
                $('#add-comment').modal('hide');

                $('#comment-name').val('');
                $('#comment-comment').val('');

                $('.jumbotron').prepend($('<div/>', {
                    class: 'alert alert-success alert-comment-added'
                }).html('Comment added!'));

                setTimeout(function() {
                   $('.alert-comment-added').fadeOut('slow');
                }, 3000);

                loadComments();
            });
        });
    });

    $('.delete-post').click(function() {
        var postId = $(this).attr('data-post-id');

        $.post('index.php', {
            ajax: true,
            controller: 'Book',
            method: 'deletePost',
            postId: postId

        }, function() {
            $('.post-' + postId).remove();

            $('.jumbotron').prepend($('<div/>', {
                class: 'alert alert-success alert-post-deleted'
            }).html('Post deleted!'));

            setTimeout(function() {
                $('.alert-post-deleted').fadeOut('slow');
            }, 3000);
        });
    });

    $(document).keydown(function(e){
        if (e.keyCode == 37) {
            var url = $('#page-back').attr('href');
        }

        if (e.keyCode == 39) {
            var url = $('#page-next').attr('href');
        }

        if (url.length > 0) {
            window.location = url;
        }
    });
});

function loadComments()
{
    $('.post-comments').html('');

    $.getJSON('index.php', {
        ajax: true,
        controller: 'Book',
        method: 'getComments'

    }, function(data) {
        $.each(data, function(key, value) {

            var commentHtml = '<span>'
                                + value.comment + ' '
                                + '<small class="text-muted">'
                                    + '<em>' + value.name + '</em>'
                               + '</small>'
                            + '</span>';

            var comment = $('<div/>', {
                class: 'well'
            }).html(commentHtml);

            $('.post-' + value.post_id).children('.post-comments')
                .append(comment);
        });
    });
}