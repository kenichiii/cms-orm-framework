<div class="datagridPopupHtml">
<?php

    $id = $_GET['id'];
    
    if(is_numeric($id))
    {
        
        $bean  = User_Model::loadByPK($id);
        
        if($bean instanceof User_Model) 
        {        
?>

    <span class="error"></span>
    Opravdu si přejete smazat <b><?php echo $bean->getFullname()->getWholeName() ?></b>?
    <br /><br />

    <a class='goDelete button-link' href="<?php echo App::getIns()->setActionLink('_curr','admins-delete') .'?id='.$bean->getId()->getValue() ?>">ANO</a>

    <a class="stopDelete button-link" href='#'>NE</a>

    <br /><br />
 
    
     <?php } else echo "NEPLATNE ID";  ?>       
 <?php } else echo "NEPLATNE ID";  ?>    
</div>