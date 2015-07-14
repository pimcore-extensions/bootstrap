<?php
    $columns = $this->getParam("columns", array(12));
    $i = 0;
?>

<?php foreach($this->columns as $column) {?>
    <?php
        $name = "cs" . $column . "_" . $i;
    ?>
    <div class="col-md-<?=$column?> col-sm-<?=$column?> col-xs-12">
        <?=$this->template("helper/area.php", array("name" => $name))?>
    </div>
    
    <?php $i++; ?>
<?php } ?>
