<?php

if(!isset($bean))
{
    $bean = Page_Model::loadByPK($_GET['id']);
}



if($bean->get('photo')->getValue())
{

?>

<div>
    <img src="<?php echo Project::$WEB_URL . Magick_Factory::thumb( '/'.$bean->get('photo')->getDir().'/'. $bean->get('photo')->getValue(), 250, 250); ?>" alt=''>            
</div>
<div style='text-align: center'>
    <a  class="button-link-after" id="page-foto-delete" href="<?php echo  App::getIns()->setActionLink('_curr','page-foto-delete'); ?>?id=<?php echo $bean->getId()->getValue() ?>">smazat obrázek</a>
</div>

<?php } else { ?>
<div>
    Zatím nebyl nahrán žádný obrázek!
</div>
<?php } ?>