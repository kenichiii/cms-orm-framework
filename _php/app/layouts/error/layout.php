<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Error</title>
  </head>
        <body>
        <h1><?php echo Project::$title ?></h1>
        
        <h2>Error</h2>
        <p>Došlo k nečekané události v běhu webových stránek, Vaše data mohla být ztracena.</p>
        <p>Webmaster byl informován.</p>
        <p><a href="<?php echo Project::$WEB_URL ?>">homepage</a></p>
        
        <?php 
        
        if( Project::$image != IMAGE_PROD )
        
        echo $html; 
        
        
        ?>
        
        </body>
 </html>       