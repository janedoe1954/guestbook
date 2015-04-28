<?php if ($this->success) : ?>
<div class="alert alert-success">
    <span class="glyphicon glyphicon-check"></span>
    <?php echo $this->success; ?>
</div>
<?php endif; ?>

<div id="pagination">

    <?php if ($this->page > 1) : ?>
        <a id="page-back" href="?controller=Book&method=overview&page=<?php echo $page - 1; ?>">
            <span class="glyphicon glyphicon-chevron-left"></span> Back
        </a>
    <?php endif; ?>

    <span>Page <strong><?php echo $page; ?></strong> of <strong><?php echo $this->maxPage; ?></strong></span>

    <?php if ($this->page < $this->maxPage) : ?>
        <a id="page-next" href="?controller=Book&method=overview&page=<?php echo $page + 1; ?>">
            Next <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    <?php endif; ?>

</div>

<?php foreach ($this->posts as $post) : ?>
<section class="post post-<?php echo $post['post_id']; ?>">

    <h2><?php echo $post['name']; ?></h2>
    <p>
        <?php
            if (strlen($post['message']) > 200) :
                $pos = strpos($post['message'], ' ', 200);
                echo substr($post['message'], 0, $pos ) . '...';
            else :
                echo $post['message'];
            endif;
        ?>
    </p>

    <div class="post-comments"></div>

    <a href="?controller=Book&method=detail&id=<?php echo $post['post_id']; ?>">
        <span class="glyphicon glyphicon-align-justify"></span> Continue reading
    </a><br />

    <a href="#" class="add-comment" data-post-id="<?php echo $post['post_id']; ?>">
        <span class="glyphicon glyphicon-plus"></span> Add comment
    </a><br />

    <a href="#" class="delete-post" data-post-id="<?php echo $post['post_id']; ?>">
        <span class="glyphicon glyphicon-trash"></span> Delete post
    </a>

</section>
<?php endforeach; ?>

<div id="pagination">

    <?php if ($this->page > 1) : ?>
    <a href="?controller=Book&method=overview&page=<?php echo $page - 1; ?>">
        <span class="glyphicon glyphicon-chevron-left"></span> Back
    </a>
    <?php endif; ?>

    <span>Page <strong><?php echo $page; ?></strong> of <strong><?php echo $this->maxPage; ?></strong></span>

    <?php if ($this->page < $this->maxPage) : ?>
    <a href="?controller=Book&method=overview&page=<?php echo $page + 1; ?>">
        Next <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
    <?php endif; ?>

</div>

<div class="modal fade" id="add-comment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add comment</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="form-horizontal">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" class="form-control" id="comment-name" type="text" />
                    </div>

                    <div class="form-group">
                        <label for="message">Comment</label>
                        <textarea name="message" class="form-control" id="comment-comment" rows="5"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save-comment">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
       loadComments();
    });
</script>