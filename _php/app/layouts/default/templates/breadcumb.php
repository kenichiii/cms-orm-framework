

<a title="<?php echo Project::$title; ?>" href="<?php echo App::getIns()->setLink('home')?>"> Úvod </a>
 &bull; 
<?php foreach (App::getIns()->getPageTree()as$key=>$page){ 
        if(count(App::getIns()->getPageTree())>$key+1)
        {
    ?>
<a title="<?php echo $page->getH1()->getValue(); ?>" href="<?php echo App::getIns()->setLink($page->getPointer()->getValue())?>">
     <?php echo $page->getMenuname()->getValue(); ?> 
</a>
 &bull; 
  <?php } else { ?>
<span class="lastBreadCrumb"> <?php echo $page->getMenuname()->getValue(); ?> </span>   
  <?php } ?>  

<?php
  } 
?>


