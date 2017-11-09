<?php

   $id = $_GET['id'];

    if(is_numeric($id))
    {

        $bean  = Reference_Model::loadByPK($id);

        if($bean instanceof Reference_Model) 
        {

            //

        }
        else $notFoundedId = true;
    }
    else $notFoundedId = true;

?>

        <?php if(isset($notFoundedId)&&$notFoundedId) { ?>

        <h1>Neplatné ID</h1>

        <?php } else { ?>

      <div class='tabs-holder' id="referenceformedit-edit-dialog-tabs">
        <div class='tabs-head'>
            <a href='#referenceformedit-tab-edit'>Základní informace</a>
            <a href='#referenceformedit-tab-content'>Obsah</a>            
            <a href='#referenceformedit-tab-gallery'>Galerie</a>        
            <br class="clear">
        </div>   
        <div class='tabs-bodies'>

   <div id='referenceformedit-tab-edit' class='tab'>
        <h3>Základní údaje</h3>         

      <div style="float:right;padding-right:45px;padding-top: 10px">  
        <div style="padding-bottom: 5px;"><h3>Hlavní foto</h3></div>          
        <?php require '_templates/form.reference.foto.holder.php'; ?>        
      </div>          

      <div class="model-form-holder">
        <form id="referenceformedit" action="<?php echo App::getIns()->setActionLink('_curr','refs-edit') ?>" method="post">                        

        <div class='error hidden'>Při ukládání došlo k chybám ve validaci, prosím opravte si svoje údaje.</div>    

                                <input type="hidden" name="id" value="<?php echo $bean->get('id')->getValue() ?>">

<div class="model-form-row row-active">

   <input <?php echo $bean->get('active')->getValue() > 0 ? 'checked="checked"' : '' ?> type="checkbox" id="referenceformedit-active" name="active" value="1">
   <label for="referenceformedit-active">         
    Aktivní    
   </label> 

</div> 

<div class="model-form-row row-h1">
    <div class="model-form-collum-title">
        Nadpis    </div>    
    <div class="model-form-collum-cell">
        <input type="text" name="h1" value="<?php echo $bean->get('h1')->getValue() ?>">
    </div>            
</div>  

<div class="model-form-row row-uri">
    <div class="model-form-collum-title">
        Uri    </div>    
    <div class="model-form-collum-cell">   
        <input type="text" name="uri" value="<?php echo $bean->get('uri')->getValue() ?>">
    </div>            
</div> 

<div class="model-form-row row-perex">
    <div class="model-form-collum-title">
        Perex    </div>    
    <div class="model-form-collum-cell">
        <textarea name="perex"><?php echo $bean->get('perex')->getValue(); ?></textarea>
    </div>            
</div>  

<div class="model-form-row row-datum">
    <div class="model-form-collum-title">
        Datum    </div>    
    <div class="model-form-collum-cell">
        <input type="text" name="datum" value="<?php echo $bean->get('datum')->getValue() ?>">
    </div>            
</div>  

            <div class="model-form-submit">
                <input type="submit" value="Uložit">
            </div>    

        </form>    

       </div>  
       <br class="clear">

       </div> <!-- tab basic -->

            <div id='referenceformedit-tab-content' class='tab'>
                <h3>Obsah</h3>
               <div class="model-form-holder"> 
                <form id="referenceformedit-contentForm" action="<?php echo App::getIns()->setActionLink('_curr', 'refs-edit-content') ?>" method="post">                       
                    <div class="row-content">
                            <input type="hidden" name="id" value="<?php echo $bean->getId()->getValue() ?>">                        
                            <textarea class="tinymce" name="content"><?php echo $bean->get('content')->getValue(); ?></textarea>            
                    </div>
                     <br>            
                     <div class="model-form-submit">
                         <input type="submit" value="Uložit">
                     </div>
                 </form>  
                </div>     
             </div>            

            <div id='referenceformedit-tab-gallery' class='tab'>
               <?php require '_templates/reference.gallery.holder.php' ?>     
            </div>    

       </div> <!-- tabs bodies -->                        
     </div>   <!-- tabs holder -->       

      <?php } ?>      
