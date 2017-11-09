<?php
    ob_start();
    $uri = $_GET['znacka'];

        $bean  = HPZnacky_Model::loadByUri($uri);

            $pagetree = App::getIns()->getPageTree();
            $lastindex = count($pagetree)-1;

        if($bean instanceof HPZnacky_Model && $bean->getDeleted()->getValue()==0  && $bean->getActive()->getValue() ) 
        {
            //change title of page
            App::getIns()->setPageTreePage($lastindex,'h1',$bean->getH1()->getValue()); 
            //change breadcumb
            App::getIns()->setPageTreePage($lastindex,'menuname',$bean->getH1()->getValue());                
            
            
            //find galleries
            $pagesGrid = new Page_Grid();
            $galleries = $pagesGrid->setActiveCond()->setDeletedCond()
                    ->andWhere( $pagesGrid->getAlias('pointer')." like %s", $bean->get('uri')->getValue().'%' )
                    ->setRankOrderByCond()
                ->getData();    
            
        }
        else {        
         exit;
        }
?>

$(function(){
      <?php foreach($galleries as $galpage) { 
          
                $gallery = $galpage->getGallery()->orderby('rank DESC')->getData();
          
          ?>



    $('#<?php echo $galpage->get('pointer')->getValue(); ?>').autofillscreengallery({
        paths: [            
            <?php foreach($gallery as $key=> $image): ?>
              {
                small: "<?php echo Magick_Factory::thumb( '/'.App::getIns()->currentPage()->getGallery()->getDir().'/'.$image->getSrc()->getValue(), 460, 400,1,'f5f5f7' ); ?>",
                big: "<?php echo Magick_Factory::thumb( '/'.App::getIns()->currentPage()->getGallery()->getDir().'/'.$image->getSrc()->getValue(), 800, 600); ?>",
                title: "<?php echo str_replace('.jpg','',addslashes($image->getH1()->getValue())); ?>",
                link:  "<?php echo $image->getLink()->getValue() ? $image->getLink()->getValue() : str_replace('.jpg','',addslashes($image->getH1()->getValue())); ?>"
              }      
              <?php if( count($gallery)-1!=$key ) echo "," ?>
            <?php endforeach; ?>                
        ]
    });

                        
      <?php } //end foreach ?>

})



    
<?php

    $jscode = ob_get_clean();
    
    __c()->set(App::getCurrentSuperCacheKey(),$jscode,60*60*24*21);
    
    echo $jscode;

?>    