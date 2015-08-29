<?php if ($this->editmode) : ?>
    <?= $this->template("bootstrap/content.php") ?>
    <?= $this->template("bootstrap/image.php") ?>
<?php else: ?>
    <div class="row">
        <div class="caption">
            <?= $this->template("bootstrap/content.php") ?>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        </div>

        <?= $this->image("contentImage", array("thumbnail" => "contentImage", "class" => "img-responsive pull-right")) ?>
    </div>
<?php endif; ?>
