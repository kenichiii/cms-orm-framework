

        <h3><a href="#"><?php echo $sectiontitle; ?></a></h3>
	<div>
           
          <div class="model-form-holder">     
            <form id="settins-form-<?php echo $pointer; ?>" class="setting" method="post" action="[[ echo App::getIns()->setActionLink('_curr','save-setting') ]]">
    
                <span class="error"></span>
 
                <div class="model-form-row">
                    <div class="model-form-collum-title">
                        <?php echo $itemname; ?>    </div>    
                    <div class="model-form-collum-cell">
                        <input type="hidden" name="id" value="[[ echo AppSettings::getByPointer('<?php echo $pointer; ?>')->getId()->getValue(); ?>">
                        <textarea class="txt[[ echo AppSettings::getByPointer('<?php echo $pointer; ?>')->getType()->getValue(); ]] txt<?php echo $pointer; ?>" name="value">[[ echo AppSettings::getByPointer('<?php echo $pointer; ?>')->get(AppSettings::getByPointer('<?php echo $pointer; ?>')->getType()->getValue())->getValue(); ]]</textarea>
                    </div>            
                </div>      
    
                <div class="model-form-submit">
                   <input type="submit" value="Uložit">
               </div>                
            </form>
          </div>    
            
       </div>  
