<div class="datagridPopupHtml">
<?php

    $id = $_GET['id'];
    
    if(is_numeric($id))
    {
        
        $bean  = Znacky_Model::loadByPK($id);
        
        if($bean instanceof Znacky_Model) 
        {        
?>

    <span class="error"></span>
    Opravdu si přejete smazat <b><?php echo $bean->getH1()->getValue() ?></b>?
    <br /><br />

    <a class='goDelete button-link' href="<?php echo App::getIns()->setActionLink('_curr','znacky-delete') .'?id='.$bean->getId()->getValue() ?>">ANO</a>

    <a class="stopDelete button-link" href='#'>NE</a>

    <br /><br />
 
    
     <?php } else echo "NEPLATNE ID";  ?>       
 <?php } else echo "NEPLATNE ID";  ?>    
</div>