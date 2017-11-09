<?php

$path = $_GET['path'];
$dir = APPLICATION_PATH . '/' . App::getIns()->getPagesFolder() .'/' . $path;

if(!is_dir($dir))
{
    mkdir($dir, 0777,true);
    
    
    $template = '
        
                    <article>
                                    <header> 
                                        <h1 class="current-page-title"><?php echo App::getIns()->currentPage()->getH1()->getValue(); ?></h1>
                                    </header>    
                                    <div class="current-page-text-content">
                                        <?php echo App::getIns()->currentPage()->getContent()->getValue(); ?>
                                    </div>
                                                
                    </article>  
                    
            ';
    
    file_put_contents($dir.'template.php', $template);
    
    
}

echo "done";