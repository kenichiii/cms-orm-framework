<?php
  
    App::getIns()->addFileJs(Project::$WEB_URL.'/assets/libs/tinymce/jquery.tinymce.min.js');

    if( isset($_GET['zajem']) )
    {
        $zprava = '<p>Dobrý den,</p>';
        $zprava.= '<p>mám bližší zájem o:<br><b>'.$_GET['zajem'].'</b></p>';
        $zprava.= '<p>Prosím kontaktujte mě v době OD-DO</p>';
    } else $zprava = '';
        

           

