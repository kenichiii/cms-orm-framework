<?php

    ob_start();
    
    $bannersGrid = new HPBanner_Grid();
    
    $banners = $bannersGrid
            ->setDeletedCond()
            ->where('and '.$bannersGrid->getAlias('active').'=%i',1)
            ->orderBy($bannersGrid->getAlias('rank').' DESC')
            ->getData();
    
?>

var slider = {
                slides : [
                
                <?php foreach ($banners as $key=>$b) { ?>
                {
                    title: "<?php echo addslashes($b->getH1()->getValue())?>",
                    path: "/<?php echo $b->getPhoto()->getDir().'/'.$b->getPhoto()->getValue(); ?>",
                    href: "<?php echo $b->getLink()->getValue(); ?>"
                }<?php echo count($banners)!=($key+1) ? ',' : '' ?>
                
                <?php } ?>                                                
                ],  
            
                //html ID
                id: "#slideshow",
                
                //active components
                leftPanel: null,
                middlePanel: null,
                rightPanel: null,
                title: null,
                infoBox: null,
                prev: null,
                next: null,
            
                int: null,
                activeIndex: 0,
                play: function(interval) {
                    
                    //set slider to start                    
                
                        slider.holder = $(slider.id);
                        slider.leftPanel = $(slider.id + " .slideLeftPanel").first();
                        slider.middlePanel = $(slider.id + " .sliderPanel").first();
                        slider.rightPanel = $(slider.id + " .slideRightPanel").first();
                        slider.title = $(slider.id + " .sliderTitle").first();
                        slider.infoBox = $(slider.id + " .sliderInfoBox").first();
                        slider.prev = $(slider.id + " .sliderPrev").first();
                        slider.next = $(slider.id + " .sliderNext").first();    
                            
        
                        //set initial bc img
                          slider.setSlide();
                         
                        //set initial height  
                          slider.setHeight();
        
                          $(window).resize(function() {
                              slider.setHeight();
                            });
        
                    //play
                    slider.int = setInterval(function(){
                        slider.activeIndex++;
                        if( slider.activeIndex == slider.slides.length )
                            slider.activeIndex = 0;
                            
                        slider.setSlide();    
                    },interval);                     
                          
                     $('.sliderPrev').click(function(e){
                             e.preventDefault();
                             clearInterval(slider.int);
                             
                          var ai = slider.activeIndex;                                                               
                         //help index
                          var li = ai - 1;
                          if( li == -1 )
                              li = slider.slides.length - 1;            
                          
                              slider.activeIndex = li;
                              
                              slider.setSlide();
                              
                                slider.int = setInterval(function(){
                                    slider.activeIndex++;
                                    if( slider.activeIndex == slider.slides.length )
                                        slider.activeIndex = 0;

                                    slider.setSlide();    
                                },interval);                     
                          });
                          
                       $('.sliderNext').click(function(e){
                             e.preventDefault();
                             clearInterval(slider.int);
                             
                          var ai = slider.activeIndex;                                                               
                         //help index
                          var ri = ai + 1;
                          if( ri == slider.slides.length )
                              ri = 0;
                          
                              slider.activeIndex = ri;
                              
                              slider.setSlide();
                              
                                slider.int = setInterval(function(){
                                    slider.activeIndex++;
                                    if( slider.activeIndex == slider.slides.length )
                                        slider.activeIndex = 0;

                                    slider.setSlide();    
                                },interval);                     
                          });
                          
                            for(var i = 0; i < slider.slides.length; i++)
                            {
                                if( i == 0 )
                                $('.slidesHolderInner').append('&nbsp;<a href="#" class="sactive"><span>a</span></a>&nbsp;')
                                else
                                $('.slidesHolderInner').append('<a href="#" class="spassive"><span>a</span></a>&nbsp;')
                            } 
                  
                  
                  //load slides
                  /*
                    for( i = 1; i < slider.slides.length; i++)
                      {

                         $('.preload').append($('<div />').css('background-image','url('+ slider.slides[i].path + ')'));
                      }
                      */
                },
                
                setSlide: function() {
                    
                          var ai = slider.activeIndex;  
                          
                          //console.log(this.activeIndex)  
        
                         //help index
                          var li = ai - 1;
                          if( li == -1 )
                              li = slider.slides.length - 1;
        
                          var ri = ai + 1;
                          if( ri == slider.slides.length )
                              ri = 0;
                                  
                          slider.middlePanel.css('background-image','url('+slider.slides[ai].path+')').css('opacity',0)
                                            .css('display','block')                    
                                            .animate({'opacity':1},275,function(){}); 
                                    ;
                          //slider.leftPanel.css('background-image','url('+slider.slides[li].path+')');
                          //slider.rightPanel.css('background-image','url('+slider.slides[ri].path+')');

                          //load initial title
                          slider.title.html(slider.slides[ai].title);
                          
                          $('.slidesHolder a').removeClass('sactive').addClass('spassive').each(function(i){
                              if( i == slider.activeIndex ) {
                                  $(this).removeClass('spassive').addClass('sactive');
                              }
                          });
                         
                         $('.slidesHolderMore a').first().attr('href',slider.slides[ai].href); 
                },
                        
               setHeight: function() {
                        
                        var wh = $(window).height();  
                        /*    
                        var sh = Math.round(wh/2.5);
                        var ih = Math.round(sh/4);
                        var im = sh - ih;
        
                        slider.holder.css('height',sh+"px");
                        slider.leftPanel.css('height',sh+"px");
                        slider.middlePanel.css('height',sh+"px");
                        slider.rightPanel.css('height',sh+"px");
        
                        slider.prev.css('height',sh+"px");
                        slider.next.css('height',sh+"px");
                        
                        slider.infoBox.css('height',ih+"px");
                        slider.infoBox.css('margin-top',im+"px");
                        */
                        var sh = wh - 190;
                        if( sh < 200 ) sh = 200;
                        slider.middlePanel.css('height',sh+"px");    
               }
            
           };     
    
        $(function(){
           /*
        heavyImage = new Image();
        
        for(var i = 0; i < slider.slides.length; i++)
          {
                
             heavyImage.src = slider.slides[i].path;
          } 
          */
            
           $('#slideshow .sliderInfoBox').css("left", Math.max(0, (($(window).width() - $('#slideshow .sliderInfoBox').outerWidth()) / 2) + 
                                               $(window).scrollLeft()) + "px"); 
           
           $(window).resize(function(){
                $('#slideshow .sliderInfoBox').css("left", Math.max(0, (($(window).width() - $('#slideshow .sliderInfoBox').outerWidth()) / 2) + 
                                                $(window).scrollLeft()) + "px");            
           })
                                                
                                                
           slider.play(9000); 
            
        });
        
<?php

    $jscode = ob_get_clean();
    
    __c()->set(App::getCurrentSuperCacheKey(),$jscode,60*60*24*21);
    
    echo $jscode;

?>        