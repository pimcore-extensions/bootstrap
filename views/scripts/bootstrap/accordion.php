<?
    
    $store = array(
        array("panel-default", "Default"),
        array("panel-primary", "Primary"),
        array("panel-success", "Success"),
        array("panel-info", "Info"),
        array("panel-warning", "Warning"),
        array("panel-danger", "Danger")
    );
    
    if($this->editmode)
    {
        if($this->select("type")->isEmpty()){
             $this->select("type")->setDataFromResource("panel-default");
        }
    
        echo $this->select("type", array("reload" => true, "store" => $store));
    }
    
    $type = $this->select("type")->getData();
?>

<div class="panel-group">
    <div class="panel <?=$type?>">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="<?=$this->editmode ? "" : "collapse"?>" data-parent="#accordion" href="#collapse<?=$this->brick->getId().$this->brick->getIndex()?>">
                    <i class="fa fa-caret-down"></i> <?=$this->input("name")?>
                </a>
            </h4>
        </div>
        <div id="collapse<?=$this->brick->getId().$this->brick->getIndex()?>" class="panel-collapse collapse <?=$this->editmode ? "in" : ""?>">
            <div class="panel-body">
                <?=$this->template("helper/area.php", array("name" => "a", "excludeBricks" => array("accordion")))?>
            </div>
        </div>
    </div>
</div>