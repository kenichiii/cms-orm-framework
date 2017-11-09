
                    <?php 
                    
                    //get admin page id
                    $adminpageid = AppSettings::getBySection("const")->ADMIN_PAGE_ID;
                    //display children          
                    $mainmenu = AppMenu::get($adminpageid);
                    
                    ?>



<div id='cssmenu'>
<ul>
  <?php 
    function printMenu($mainmenu)
    {
?>
      <ul class="submenu-list">  
<?php          
     foreach( $mainmenu as $key => $mitem)
     {
      
        $submenu = AppMenu::get($mitem['page']->getId()->getValue());
            
            //lze zanorit jeste min jednou
            ?>                            
  <li class='<?php if(count($mainmenu)==($key+1)) echo "last" ?> <?php echo $mitem['active'] ?  'active' : ''; ?> <?php echo count($submenu) ? 'has-sub' : ''; ?>'>
      <a href='<?php echo App::getIns()->setLink($mitem['page']->getPointer()->getValue()); ?>'><span><?php echo $mitem['page']->getMenuName()->getValue() ?></span></a>      
<?php 
        if(count($submenu)) {
            //melo 
            printMenu($submenu);          
        }    
  ?>                    
  </li>
<?php } //endforeach submenu ?>                                            
      </ul>   
<?php    
    } //end function printMenu
  
    //print main menu
     foreach( $mainmenu as $key => $mitem)
     {
      
        $submenu = AppMenu::get($mitem['page']->getId()->getValue());
        
      ?> 
  <li class='<?php if(count($mainmenu)==($key+1)) echo "last" ?> <?php echo $mitem['active'] ?  'active' : ''; ?> <?php echo count($submenu) ? 'has-sub' : ''; ?>'>
      <a href='<?php echo App::getIns()->setLink($mitem['page']->getPointer()->getValue()); ?>'><span><?php echo $mitem['page']->getMenuName()->getValue() ?></span></a>      
<?php 
        if(count($submenu)) {
            //melo 
            printMenu($submenu);          
        }    
  ?>                                      
    
<?php } //end foreach mainmenu ?>
    
</ul>
</div>

    
