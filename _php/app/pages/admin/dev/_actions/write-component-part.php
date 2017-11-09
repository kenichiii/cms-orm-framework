<?php


$grid = new Page_Grid();
$page = $grid->getByPk($_POST['id']);

$app = new App("/");
$uri = str_replace(Project::$WEB_URL, '', $app->setLink($page->getPointer()->getValue()));

$app = new App($uri);
$path = $app->getCurrentPath();

$name = $_POST['name'];
$expl = explode('/',$_POST['file']); 

$file_content = str_replace('[[/textarea]]', '</textarea>', $_POST['content']);

//if($expl[0]=='admin')
switch($expl[1])
{
    case "css":
    case "js":    
     $dir = $path.$expl[1].'/'; $file = (isset($expl[2])?$expl[2]:$name).'.'.$expl[1];   
        break;
    
    case "pcss":
    case "pjs":
     $dir = $path.'_'.$expl[1].'/'; $file = (isset($expl[2])?$expl[2]:$name).'.php';      
        break;
    
    case "action":
     $dir = $path.'_actions/'; 
     $file = preg_replace('/(\.php)$/', '', $expl[2]).'.php';              
        break;
           
    case "ajax":
     $dir =  $path.'_ajax/'; 
     $file = preg_replace('/(\.php)$/', '', $expl[2]).'.php';
        break;    
    
    case "template":
    case "controller":
     $dir = $path.''; $file = $expl[1].'.'.(isset($expl[2])?$expl[2]:$name).'.php';         
        break;

    case "templates":
     $dir = $path.'_templates/'; $file = $expl[2].'.php';    
        break;
}

if(isset($file))
{

$dexpl = explode('/', $dir);
$ddir  = $expl[1]=='js'||$expl[1]=='css'?PUBLIC_PATH . '/assets/pages':APPLICATION_PATH . '/pages';
foreach($dexpl as $sdir)
{
    
    $ddir .= '/'. $sdir;
    
    if(!is_dir($ddir)) 
        mkdir ($ddir, 0777);
        
}

file_put_contents($ddir.$file, $file_content);

echo "{$file} was written to {$dir}";
__c()->clean();

}
else echo "{$_POST['file']} is not supported for templating";

