<?php

if(!isset($bean))

{

    $bean = HPZnacky_Model::loadByPK($_GET['id']);

}

if($bean->get('photo')->getValue())

{

?>

<div>

  <?php if($bean->get('photo')->isImage()) { ?>  

    <img src="<?php echo Project::$WEB_URL . Magick_Factory::thumb( '/'.$bean->get('photo')->getDir().'/'. $bean->get('photo')->getValue(), 250, 250); ?>" alt=''>            

  <?php } elseif($bean->get('photo')->isVideo()) { ?>  

  <video controls="controls" width="250" height="250">

        <source src="<?php echo Project::$WEB_URL . '/'.$bean->get('photo')->getDir().'/'. $bean->get('photo')->getValue() ?>" />

  </video>    

  <?php } else { ?>

    <h2><?php echo $bean->get('photo')->getExt() ?></h2>    

  <?php } ?>  

  <div><a href="<?php echo Project::$WEB_URL . '/'.$bean->get('photo')->getDir().'/'. $bean->get('photo')->getValue() ?>" target="_blank" class="photo-filename test">zdroj</a></div>

</div>

<div style='text-align: center;padding-bottom: 15px;padding-top:5px;'>

    [ <a  class="button-link-after action-delete" href="<?php echo  App::getIns()->setActionLink('_curr','hpznacky-photo-file-delete'); ?>?id=<?php echo $bean->getId()->getValue() ?>">smazat soubor</a> ]

</div>

<?php } else { ?>

<div>

    Zatím nebyl nahrán žádný soubor!

</div>

<?php } ?>