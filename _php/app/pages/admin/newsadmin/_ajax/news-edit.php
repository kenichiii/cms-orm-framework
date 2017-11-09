<?php
    
   $id = $_GET['id'];

    if(is_numeric($id))
    {
        
        $bean  = News_Model::loadByPK($id);
                        
        if($bean instanceof News_Model) 
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

        
        
  <div class='tabs-holder'>
        <div class='tabs-head'>
            <a href='#tab-edit'>Základní informace</a>
            <a href='#tab-content'>Obsah</a>            
            <a href='#tab-gallery'>Galerie</a>        
            <br class="clear">
        </div>   
        <div class='tabs-bodies'>
            
   <div id='tab-edit' class='tab'>
        <h3>Základní údaje</h3> 
        
        
      <div style="float:right;padding-right:45px;padding-top: 10px">  
        <?php require '_templates/form.news.foto.holder.php'; ?>        
      </div>  
        
        
        
      <div class="model-form-holder">
        <form id="newsformedit" action="<?php echo App::getIns()->setActionLink('_curr','news-edit') ?>" method="post">                        
        
        <span class='error'></span>    
        
                                <input type="hidden" name="id" value="<?php echo $bean->get('id')->getValue() ?>">
                                                                                                                                                                        
        
       

<div class="model-form-row">

   <label for="active"> 
    <input <?php echo $bean->get('active')->getValue() > 0 ? 'checked="checked"' : '' ?> type="checkbox" id="active" name="active" value="1">
    Aktivní    
   </label> 

</div>  



<div class="model-form-row">
    <div class="model-form-collum-title">
        Název    </div>    
    <div class="model-form-collum-cell">
        <input type="text" name="h1" value="<?php echo $bean->get('h1')->getValue() ?>">
    </div>            
</div>  

        
<div class="model-form-row">
    <div class="model-form-collum-title">
        Uri    </div>    
    <div class="model-form-collum-cell">   
        <input type="text" name="uri" value="<?php echo $bean->get('uri')->getValue() ?>">
    </div>            
</div> 

        
        
<div class="model-form-row">
    <div class="model-form-collum-title perex">
        Perex    </div>    
    <div class="model-form-collum-cell">
        <textarea name="perex"><?php echo $bean->get('perex')->getValue(); ?></textarea>
    </div>            
</div>  
                                
<div class="model-form-row">
    <div class="model-form-collum-title">
        Datum    </div>    
    <div class="model-form-collum-cell">   
        <input type="text" id="idate-datum" name="date" value="<?php echo $bean->get('date')->getToDate() ?>">                                                    
    </div>            
</div>  
    
                                     
            
            <div class="model-form-submit">
                <input type="submit" value="Uložit">
            </div>    
                        
        </form>    
        
       </div>
        
    </div>    
                                

            <div id='tab-content' class='tab'>
                <h3>Obsah</h3>
                <form id="contentForm" action="<?php echo App::getIns()->setActionLink('_curr', 'news-edit-content')?>" method="post">                       
                <div class='newa-content'>
                  
                
                        <input type="hidden" name="id" value="<?php echo $bean->getId()->getValue() ?>">                 
        
                        <textarea class="tinymce wys-obsah" name="content"><?php echo $bean->get('content')->getValue(); ?></textarea>

            
                </div>
                 <br>            
                 <div class="model-form-submit"><input type="submit" class='page-content-update-btn' value="Uložit"></div>
              </form>  
            </div>            
    
                    
            <div id='tab-gallery' class='tab'>
               <?php require '_templates/template.news.gallery.holder.php' ?>     
            </div>    

       </div>                         
     </div>   

       <br class="clear">
        
           
         
      <?php } ?>      
