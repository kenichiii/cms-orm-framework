
        <h3><a href="#">Nastavení příjemce kontaktního formuláře</a></h3>
	<div>
           
          <div class="model-form-holder">     
            <form id="settins-form-CONTACT_FORM_RECEPIENT" class="setting" method="post" action="<?php echo App::getIns()->setActionLink('_curr','save-setting') ?>">
    
                <span class="error"></span>
 
                <div class="model-form-row">
                    <div class="model-form-collum-title">
                        Email    </div>    
                    <div class="model-form-collum-cell">
                        <input type="hidden" name="id" value="<?php echo AppSettings::getByPointer('CONTACT_FORM_RECEPIENT')->getId()->getValue(); ?>">
                        <textarea class="txt<?php echo AppSettings::getByPointer('CONTACT_FORM_RECEPIENT')->getType()->getValue(); ?> txtCONTACT_FORM_RECEPIENT" name="value"><?php echo AppSettings::getByPointer('CONTACT_FORM_RECEPIENT')->get(AppSettings::getByPointer('CONTACT_FORM_RECEPIENT')->getType()->getValue())->getValue(); ?></textarea>
                    </div>            
                </div>      
    
                <div class="model-form-submit">
                   <input type="submit" value="Uložit">
               </div>                
            </form>
          </div>    
            
       </div>  
