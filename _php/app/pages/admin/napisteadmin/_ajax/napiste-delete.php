<div class="datagridPopupHtml">
<?php

    $id = $_GET['id'];
    
    if(is_numeric($id))
    {
        
        $bean  = Napiste_Model::loadByPK($id);
        
        if($bean instanceof Napiste_Model) 
        {        
?>

    <span class="error"></span>
    Opravdu si přejete smazat tuto položku?
    <br /><br />

    <a class='goDelete button-link' href="<?php echo App::getIns()->setActionLink('_curr','napiste-delete') .'?id='.$bean->getId()->getValue() ?>">ANO</a>

    <a class="stopDelete button-link" href='#'>NE</a>

    <br /><br />
 
    
     <?php } else echo "NEPLATNE ID";  ?>       
 <?php } else echo "NEPLATNE ID";  ?>    
</div>