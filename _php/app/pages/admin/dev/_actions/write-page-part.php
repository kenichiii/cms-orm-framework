<?php



$grid = new Page_Grid();
$page = $grid->getByPk($_POST['id']);

$uri = str_replace(Project::$WEB_URL, '', App::getIns()->setLink($page->getPointer()->getValue()));

$app = new App($uri);
$path = $app->getCurrentPath();

$expl = explode('/',$_POST['file']); 

$file_content = str_replace('[[/textarea]]', '</textarea>', $_POST['content']);

switch($expl[0])
{
    case "css":
    case "js":    
     $dir = $path.'/'.$_POST['file'].'/'; $file = 'page.'.$_POST['file'];   
        break;
    
    case "pcss":
    case "pjs":
     $dir = $path.'/'.$_POST['file'].'/'; $file = 'page.php';      
        break;
    
    case "action":
     $dir = $path.'/_actions/'; 
     $file = isset($expl[1]) ? $expl[1].'.php' : 'form.php';              
        break;
           
    case "ajax":
     $dir =  $path.'/_ajax/'; 
     $file = isset($expl[1]) ? $expl[1].'.php' : 'form.php';         
        break;    
    
    case "template":
    case "controller":
     $dir = $path.'/'; $file = $_POST['file'].'.php';         
        break;
    
}

if(isset($file))
{

$dexpl = explode('/', $dir);
$ddir  = $expl[0]=='js'||$expl[0]=='css'?PUBLIC_PATH . '/assets/pages/':APPLICATION_PATH . '/pages/';
foreach($dexpl as $sdir)
{
    $ddir .= '/'. $sdir;
    
    if(!is_dir($ddir)) 
        mkdir ($ddir, 0777);
    
    
}
if($expl[0]=='js'||$expl[0]=='css')
{
    $ddir .= '/'. $expl[0];
    
    if(!is_dir($ddir)) 
        mkdir ($ddir, 0777);
}

file_put_contents($ddir.$file, $file_content);

echo "{$file} was written to {$path}";
__c()->clean();
}
else echo "{$_POST['file']} is not supported for templating";
