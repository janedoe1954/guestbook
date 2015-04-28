<div id="post-detail">

    <h2>
        <a href="mailto:<?php echo $post['mail']; ?>">
            <?php echo $post['name']; ?>
            <span class="glyphicon glyphicon-envelope"></span>
        </a>
    </h2>

    <p><?php echo $post['message']; ?></p>

    <p class="text-muted">
        <small>Created at <?php echo date('d.m.Y H:i', strtotime($post['created_at'])); ?></small>
    </p>

    <?php foreach ($this->comments as $comment) : ?>
    <div class="well">
        <span>
            <?php echo $comment['comment']; ?>
            <small class="text-muted"><?php echo $comment['name']; ?></small>
        </span>
    </div>
    <?php endforeach; ?>

    <a href="#" onclick="history.back();">
        <span class="glyphicon glyphicon-backward"></span> Back
    </a>

</div>