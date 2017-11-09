




           <ul class="menuList" id="nav">
		<?php 

                    foreach( AppMenu::get() as $i => $mitem ):
                        if( $mitem['active'] ):
                   ?>
                      <li class="activeMenuItem">
                          <a id="<?php echo $mitem['page']->getPointer()->getValue(); ?>" class="menuItemActive" href="<?php echo App::getIns()->setLink($mitem['page']->getPointer()->getValue()); ?>">
                              <span><?php echo $mitem['page']->getMenuName()->getValue(); ?></span>
                          </a>
                          <?php
                             $sub = AppMenu::get($mitem['page']->getId()->getValue());   
                             if( count($sub) )
                             {
                                 ?>
                                   <div class="subs">     
                                     
                                        <?php foreach( $sub as $j => $sitem ): ?>
                                           <a id="<?php echo $sitem['page']->getPointer()->getValue(); ?>"  href="<?php echo App::getIns()->setLink($sitem['page']->getPointer()->getValue()); ?>">
                                               <span><?php echo $sitem['page']->getMenuName()->getValue(); ?></span>
                                           </a> 
                                        <?php endforeach; ?>
                                   </div>    
                                 <?php
                             }   
                          ?>    
                              
                      
                      </li>
                      <?php else: ?>
                      <li <?php if( $i == 0 ) echo 'class="firstMenuItem"'; ?>>
                          <a id="<?php echo $mitem['page']->getPointer()->getValue(); ?>" href="<?php echo App::getIns()->setLink($mitem['page']->getPointer()->getValue()); ?>">
                              <span><?php echo $mitem['page']->getMenuName()->getValue(); ?></span>
                          </a>
                          <?php
                             $sub = AppMenu::get($mitem['page']->getId()->getValue()); 
                             if( count($sub) )
                             {
                                 ?>
                                    <div class="subs"> 
                                     
                                         <?php foreach( $sub as $j => $sitem ): ?>
                                           <a id="<?php echo $sitem['page']->getPointer()->getValue(); ?>"  href="<?php echo App::getIns()->setLink($sitem['page']->getPointer()->getValue()); ?>">
                                               <span><?php echo $sitem['page']->getMenuName()->getValue(); ?></span>
                                           </a> 
                                         <?php endforeach; ?>
                                     
                                    </div>    
                                 <?php
                             }   
                          ?>    
                      
                      </li> 
                      <?php endif ?>
                <?php endforeach; ?>
                    </ul>          