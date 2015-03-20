<?php

$excludeBricks = $this->param('excludeBricks', []);
$extraBricks = is_array($this->extraBricks) ? $this->extraBricks : [];

$bricks = []; //Projects AreaBricks

$extraBricks = array_merge($extraBricks, $bricks);

echo $this->template('bootstrap/area.php', [
    'name' => $this->name,
    'excludeBricks' => $excludeBricks,
    'extraBricks' => $extraBricks
]);
