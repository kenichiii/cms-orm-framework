<?php

   $id = $_GET['id'];

    if(is_numeric($id))
    {

        $bean  = HPZnacky_Model::loadByPK($id);

        if($bean instanceof HPZnacky_Model) 
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

      <div class='tabs-holder' id="hpznackaformedit-edit-dialog-tabs">
        <div class='tabs-head'>
            <a href='#hpznackaformedit-tab-edit'>Základní informace</a>
            <a href='#hpznackaformedit-tab-content'>Obsah</a>            

            <br class="clear">
        </div>   
        <div class='tabs-bodies'>

   <div id='hpznackaformedit-tab-edit' class='tab'>
        <h3>Základní údaje</h3>         

    <div style="float:right;padding-right:45px;padding-top: 10px">      

        <div style="padding-bottom: 15px;"> 
            <div style="padding-bottom: 5px;"><h3>Hlavní foto</h3></div>  
            <?php require '_templates/form.hpznacky.photo.file.form.holder.php'; ?>              
        </div>    

     </div> <!-- files upload form -->            

      <div class="model-form-holder">
        <form id="hpznackaformedit" action="<?php echo App::getIns()->setActionLink('_curr','hpznacky_datatable-edit') ?>" method="post">                        

        <div class='error hidden'>Při ukládání došlo k chybám ve validaci, prosím opravte si svoje údaje.</div>    

                                <input type="hidden" name="id" value="<?php echo $bean->get('id')->getValue() ?>">

<div class="model-form-row row-active">

   <input <?php echo $bean->get('active')->getValue() > 0 ? 'checked="checked"' : '' ?> type="checkbox" id="hpznackaformedit-active" name="active" value="1">
   <label for="hpznackaformedit-active">         
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

            <div class="model-form-submit">
                <input type="submit" value="Uložit">
            </div>    

        </form>    

       </div>  
       <br class="clear">

       </div> <!-- tab basic -->

            <div id='hpznackaformedit-tab-content' class='tab'>
                <h3>Obsah</h3>
               <div class="model-form-holder"> 
                <form id="hpznackaformedit-contentForm" action="<?php echo App::getIns()->setActionLink('_curr', 'hpznacky_datatable-edit-content') ?>" method="post">                       
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

       </div> <!-- tabs bodies -->                        
     </div>   <!-- tabs holder -->       

      <?php } ?>      
