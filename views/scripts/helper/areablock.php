<?php

$excludeBricks = is_array($this->excludeBricks) ? $this->excludeBricks : [];
$extraBricks = is_array($this->extraBricks) ? $this->extraBricks : [];

$bricks = []; //Projects AreaBricks

$extraBricks = array_merge($extraBricks, $bricks);

echo $this->template('bootstrap/areablock.php', [
    'name' => $this->name,
    'excludeBricks' => $excludeBricks,
    'extraBricks' => $extraBricks
]);
