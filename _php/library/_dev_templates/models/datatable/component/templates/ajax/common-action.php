[[


]]

<div class="datagridPopupHtml">
    <br /><br />
    Chcete opravdu <?php echo $gdata['title_cz']; ?> u <b><?php echo $_GET['count']; ?></b> položek?
    <br /><br />

    <a class="goGA button-link" href="[[ echo App::getIns()->setActionLink('_curr','<?php echo $model->getHtmlID(); ?>-common-<?php echo $gaction; ?>').'?selected='.$_GET['selected']; ]]"><b>ODESLAT</b>!</a>

    
    <a class="stopGA button-link"  href='#'>Storno</a>
    
</div>
