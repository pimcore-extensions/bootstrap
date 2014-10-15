<?
    $defaultBricks = array("content", "accordion", "columns", "alert", "image", "panel", "carousel", "image-caption");
    $excludeBricks = $this->excludeBricks;
    $extraBricks = $this->extraBricks;
    $name = $this->name; if(!$this->name) $this->name = "default";

    $bricks = $defaultBricks;

    foreach($excludeBricks as $brick)
    {
        if(in_array($brick, $bricks))
        {
            $bricks = array_diff($bricks, array($brick));
        }
    }
    
    foreach($extraBricks as $brick)
    {
        if(!in_array($brick, $bricks))
        {
            $bricks[] = $brick;
        }
    }

?>

<?php echo $this->areablock("c" . $name, array(
        "allowed" => $bricks,
        "forceEditInView" => true
    ));
?>