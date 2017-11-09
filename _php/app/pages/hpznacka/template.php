

    <?php if(isset($notfound)&&$notfound) { ?>    

    Vámi požadovaná stránka neexistuje nebo byla stažena.

    <?php } else { ?>    
      
                    <div class="hpznacky-collum-content coll-content">
                        <?php echo $bean->get('content')->getViewValue(); ?>
                    </div> <!-- end model content content -->     

     <input type="hidden" id="napistenamurl" value="<?php echo App::getIns()->setLink('napiste') ?>?zajem=">                    
                    
                    
      <?php foreach($galleries as $galpage) { 
          
                $parent = $galpage->getParent();
          
          ?>
      <div id="<?php echo $galpage->get('pointer')->getValue() ?>">
      <?php if(count($galleries)>1) { ?><h2><?php echo $parent->get('h1')->getValue() ?></h2><?php } ?>
      
      <div class="autofillscreen-gallery-info"><?php echo $galpage->get('content')->getValue() ?></div>
      
      <div class="autofillscreen-gallery-nav-holder">
          <a href="#" class="goleft snav"><img src='/assets/layouts/default/images/lightgallery/gallery_left.png'></a>  
           <a href="#" class="goright snav"><img src='/assets/layouts/default/images/lightgallery/gallery_right.png'></a>
      </div>
      
      <div class="autofillscreen-gallery-holder">
      
    <div class="img-zero">
        <div class='img-holder'></div><div class='img-title'></div><div class='img-footer'></div>
    </div>    
    
    <div class="img-first">
        <div class='img-holder'></div><div class='img-title'></div><div class='img-footer'></div>
    </div>

    <div class="img-sec">
        <div class='img-holder'></div><div class='img-title'></div><div class='img-footer'></div>
    </div>

    <div class="img-third">
        <div class='img-holder'></div><div class='img-title'></div><div class='img-footer'></div>
    </div>

    <div class="img-four">
        <div class='img-holder'></div><div class='img-title'></div><div class='img-footer'></div>
    </div>

    <div class="img-fifth">
        <div class='img-holder'></div><div class='img-title'></div><div class='img-footer'></div>
    </div>
    
    <div class="img-six">
        <div class='img-holder'></div><div class='img-title'></div><div class='img-footer'></div>
    </div>
        
          
      </div>    
      
      </div>
      <?php } //end foreach ?>
      
      <?php } //end else notfound ?>

 
                    
            