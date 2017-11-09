
<div class="datagridPopupHtml">
[[

    $id = $_GET['id'];
    
    if(is_numeric($id))
    {
        
        $bean  = <?php echo $modelModelClass ?>::loadByPK($id);
        
        if($bean instanceof <?php echo $modelModelClass ?>) 
        {        
]]

    <span class="error"></span>
    Opravdu si přejete smazat <b>[[ echo $bean->getH1()->getValue() ]]</b>?
    <br /><br />

    <a class='goDelete button-link' href="[[ echo App::getIns()->setActionLink('_curr','<?php echo $model->getHtmlID(); ?>-delete') .'?id='.$bean->getId()->getValue() ]]">ANO</a>

    <a class="stopDelete button-link" href='#'>NE</a>

    <br /><br />
 
    
     [[ } else echo "NEPLATNE ID";  ]]       
 [[ } else echo "NEPLATNE ID";  ]]    
</div>