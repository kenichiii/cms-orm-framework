<?php

    access();

$model = $_POST['model'];
$content = $_POST['content'];

$expl = explode('_',$model);
$filename = end($expl);

$dir = APPLICATION_PATH.'/models';
for($i=0;$i<count($expl)-1;$i++)
{
    $dir = $dir.'/'.strtolower($expl[$i]);
    
    if(! is_dir($dir) )
        mkdir ($dir, 0777);
}

file_put_contents($dir.'/'.$filename.'.php', $content);
__c()->clean();
echo "{$model} has been written to ".$dir.'/'.$filename.'.php';        