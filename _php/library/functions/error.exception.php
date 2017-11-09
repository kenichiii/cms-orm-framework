<?php

function errorException($e)
{
        //reporting
    $html  = Project::$WEB_URL.'<br>';
    $html .= $_SERVER['REQUEST_URI'].'<br>';
    $html .= 'Message: '.$e->getMessage()
            .'<br> SQL: '.dibi::$sql
            .'<br> POST: '.  serialize($_POST) 
            .'<br> SESSION: '.  serialize($_SESSION)
            .'<br> GET: '.  serialize($_GET);
    
    //send report
    if( Project::$image == IMAGE_PROD ) mail(Project::$crashmail, 'Crash '.Project::$WEB_URL, $html, Project::$infomail);    
    
    return $html;
}
