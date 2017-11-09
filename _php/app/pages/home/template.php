

    <div id="slideshow">
         <div class="preload"></div>  
         <div class="sliderInfoBox">
          <a href="#next" class="sliderNext"></a>   
          <a href="#prev" class="sliderPrev"></a>   
          <div class="slidesHolder">
              <div class="slidesHolderInner">
                
              </div>
          </div> 
          <div class="sliderTitle"></div> 
          <div class="slidesHolderMore">
              <a href="#">Více</a>              
          </div> 
        </div>          
       <div class="slideLeftPanel"></div>
       <div class="sliderPanel">
       </div>    
       <div class="slideRightPanel"></div>
     </div> 
     
     <div class="hpznacky-holder">
         <span class="hpznacky-title">Nejvyhledávanejší značky</span>
         <div class="hpznacky-container">
             <?php foreach( $grid_hpznacky_data as $key => $hpznacky ) { ?>
                <div class="hpznacka-box">
                  <a title="<?php echo $hpznacky->get('h1')->getViewValue(); ?>" href="<?php echo App::getIns()->setLink('hpznacka') . $hpznacky->get('uri')->getValue().'/'; ?>">
                      <img src="<?php echo Project::$WEB_URL . '/'. $hpznacky->get('photo')->getFullPath(); ?>" alt="<?php echo strip_tags($hpznacky->get('h1')->getViewValue()); ?>"> 
                  </a>  
                </div>    
             <?php } ?>
         </div>    
     </div>    