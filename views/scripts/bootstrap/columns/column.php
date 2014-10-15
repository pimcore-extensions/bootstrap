<?
    $columns = $this->getParam("columns", array(12));
    $i = 0;
?>

<? foreach($this->columns as $column) {?>
    <?
        $name = "cs" . $column . "_" . $i;
        $type = $this->select("container-type-".$name)->getData();
        $containerStore = array(

        );
        
        $fillHeight = $this->checkbox("fill-height-".$name)->isChecked();
        
    ?>
    <div class="col-md-<?=$column?> col-sm-<?=$column?> col-xs-12 <?=$type?> <?=$fillHeight ? "to-fill-height" : "" ?>" <?= $fillHeight ? 'data-container=".container"' : ""?>>
    <?
        if($this->editmode) {
            if($this->select("container-type-".$name)->isEmpty()){
                $this->select("container-type-".$name)->setDataFromResource("container-default");
            }
        
            echo $this->select("container-type-".$name, array("reload" => true, "store" => $containerStore));
            
            echo $this->checkbox("fill-height-".$name, array("reload" => true, "boxLabel" => "Fill Height", "width" => 100));
        }
    ?>
    
        <?=$this->template("helper/area.php", array("name" => $name))?>
    </div>
    
    <? $i++; ?>
<? } ?>