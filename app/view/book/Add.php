<div id="add-post">

    <h2 class="well">
        <span class="glyphicon glyphicon-plus-sign"></span> Add entry
    </h2>

    <?php if ($this->error) : ?>
    <div class="alert alert-warning">
        <span class="glyphicon glyphicon-warning-sign"></span>
        <?php echo $this->error; ?>
    </div>
    <?php endif; ?>

    <form action="" method="post" role="form" class="form-horizontal">
        <div class="form-group">
            <label for="name" class="col-lg-2 control-label">Name</label>
            <div class="col-lg-10">
                <input name="name" class="form-control" type="text" value="<?php echo $this->data['name']; ?>" />
            </div>
        </div>

        <div class="form-group">
            <label for="mail" class="col-lg-2 control-label">E-Mail</label>
            <div class="col-lg-10">
                <input name="mail" class="form-control" type="email" value="<?php echo $this->data['mail']; ?>" />
            </div>
        </div>

        <div class="form-group">
            <label for="message" class="col-lg-2 control-label">Message</label>
            <div class="col-lg-10">
                <textarea name="message" class="form-control" rows="10"><?php echo $this->data['message']; ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <button type="submit" name="add" class="btn btn-primary btn-lg">
                    <span class="glyphicon glyphicon-floppy-disk"></span> Save
                </button>
            </div>
        </div>
    </form>

</div>