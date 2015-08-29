<?php
if ($this->editmode) {
    ?><br/><br/><br/><?php
}

$class = $this->input("extraClass")->text;
?>
<div class="row">
    <div class="col-xs-12">
        <?= $this->image("ci", array("thumbnail" => "contentImage", "class" => "img-responsive " . $class, "height" => 200)); ?>
    </div>
</div>
