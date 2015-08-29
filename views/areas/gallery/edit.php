<div>
    <label><?= $this->translate("Spalte") ?></label>
    <?php
    $store = array(
        array("12", "1 Spalte"),
        array("6", "2 Spalten (50%)"),
        array("4", "3 Spalten (33 %)"),
        array("3", "4 Spalten (25%)"),
        array("2", "6 Spalten (16%)"),
        array("1", "12 Spalten (8,3%)")
    );

    if ($this->select("type")->isEmpty()) {
        $this->select("type")->setDataFromResource("4");
    }

    echo $this->select("type", array("store" => $store, "width" => 200));

    ?>
    <br/>
    <label><?= $this->translate("Bilder oder Ordner") ?></label> <?= $this->multihref("images") ?>
</div>
<?php

?>
