


                    <ul class="footer-menu-list">
                        <?php foreach( AppMenu::getfooter() as $key => $mitem): ?>                            
                                <li class="<?php echo $mitem['active'] ?  'fmenu-li-active' : ''; ?>">
                                    <a class="<?php echo $mitem['active'] ? 'fmenu-a-active' : ''; ?>"
                                       href="<?php echo App::getIns()->setLink($mitem['page']->getPointer()->getValue()); ?>">
                                      <?php echo $mitem['page']->getMenuName()->getValue() ?>  
                                    </a>                          
                                </li>
                        <?php endforeach; ?>
                    </ul> 
