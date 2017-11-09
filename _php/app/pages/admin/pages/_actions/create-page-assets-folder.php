<?php

$path = $_GET['path'];
$dir = PUBLIC_PATH . '/assets/' . App::getIns()->getPagesFolder() .'/' . $path;

if(!is_dir($dir.'js'))
{
    mkdir($dir.'js', 0777,true);        
}

if(!is_dir($dir.'css'))
{
    mkdir($dir.'css', 0777,true);        
}

echo "done";