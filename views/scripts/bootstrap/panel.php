<?php
$store = array(
    array("panel-orange", "LeitnerLeitner Orange"),
    array("panel-default", "Default"),
    array("panel-primary", "Primary"),
    array("panel-success", "Success"),
    array("panel-info", "Info"),
    array("panel-warning", "Warning"),
    array("panel-danger", "Danger")
);

if ($this->editmode) {
    if ($this->select("type")->isEmpty()) {
        $this->select("type")->setDataFromResource("panel-default");
    }

    echo $this->select("type", array("reload" => true, "store" => $store));
}

$type = $this->select("type")->getData();
?>

<div class="panel <?= $type ?>">
    <?php if ($type !== "panel-orange") { ?>
        <div class="panel-heading">
            <h3 class="panel-title"><?= $this->input("panelHeading") ?></h3>
        </div>
    <?php } ?>
    <div class="panel-body">
        <?=$this->template("helper/areablock.php", array("name" => "panel-" . $this->brick->getIndex(), "params" => array(), "excludeBricks" => array()))?>
    </div>
</div>
