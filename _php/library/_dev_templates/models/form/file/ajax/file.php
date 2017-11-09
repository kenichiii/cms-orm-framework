[[

if(!isset($bean))
{
    $bean = <?php echo $modelclass; ?>::loadByPK($_GET['id']);
}



if($bean->get('<?php echo $collum ?>')->getValue())
{

]]

<div>
  [[ if($bean->get('<?php echo $collum ?>')->isImage()) { ]]  
    <img src="[[ echo Project::$WEB_URL . Magick_Factory::thumb( '/'.$bean->get('<?php echo $collum ?>')->getDir().'/'. $bean->get('<?php echo $collum ?>')->getValue(), 250, 250); ]]" alt=''>            
  [[ } elseif($bean->get('<?php echo $collum ?>')->isVideo()) { ]]  
  <video controls="controls" width="250" height="250">
        <source src="[[ echo Project::$WEB_URL . '/'.$bean->get('<?php echo $collum ?>')->getDir().'/'. $bean->get('<?php echo $collum ?>')->getValue() ]]" />
  </video>    
  [[ } else { ]]
    <h2>[[ echo $bean->get('<?php echo $collum ?>')->getExt() ]]</h2>    
  [[ } ]]  
  <div><a href="[[ echo Project::$WEB_URL . '/'.$bean->get('<?php echo $collum ?>')->getDir().'/'. $bean->get('<?php echo $collum ?>')->getValue() ]]" target="_blank" class="<?php echo $collum ?>-filename test">zdroj</a></div>
</div>
<div style='text-align: center;padding-bottom: 15px;padding-top:5px;'>
    [ <a  class="button-link-after action-delete" href="[[ echo  App::getIns()->setActionLink('_curr','<?php echo $model->getModelName().'-'.$collum.'-'; ?>file-delete'); ]]?id=[[ echo $bean->getId()->getValue() ]]">smazat soubor</a> ]
</div>

[[ } else { ]]
<div>
    Zatím nebyl nahrán žádný soubor!
</div>
[[ } ]]