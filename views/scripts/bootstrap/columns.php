<div class="row">
    <?php

    $values = \Bootstrap\Config::getConfig();
    $valueArray = $values->toArray();

    $store = array();

    if( isset( $valueArray['columnElements'] ) ) {

        foreach( $valueArray['columnElements'] as $key => $value) {
            $store[] = array($key, $value);
        }

    }

    if ($this->editmode) {
        if ($this->select("type")->isEmpty()) {
            $this->select("type")->setDataFromResource("column_12");
        } ?>

        <div class="col-xs-12">
            <?= $this->select("type", array("reload" => true, "store" => $store)); ?>
        </div>
    <?php
    }

    $type = $this->select("type")->getData();

    if ($type) {
        $type = explode("_", $type);

        $type_partial = $type[0];
        $columns = array_splice($type, 1);

        $params = array(
            "columns" => $columns
        );

        $this->template("bootstrap/columns/" . $type_partial . ".php", $params);
    } ?>
</div>
