
        <h3><a href="#">Nastavení Google Analytics</a></h3>
	<div>
           
          <div class="model-form-holder">     
            <form id="settins-form-GA_CODE" class="setting" method="post" action="<?php echo App::getIns()->setActionLink('_curr','save-setting') ?>">
    
                <span class="error"></span>
 
                <div class="model-form-row">
                    <div class="model-form-collum-title">
                        Google kód    </div>    
                    <div class="model-form-collum-cell">
                        <input type="hidden" name="id" value="<?php echo AppSettings::getByPointer('GA_CODE')->getId()->getValue(); ?>">
                        <textarea class="txt<?php echo AppSettings::getByPointer('GA_CODE')->getType()->getValue(); ?> txtGA_CODE" name="value"><?php echo AppSettings::getByPointer('GA_CODE')->get(AppSettings::getByPointer('GA_CODE')->getType()->getValue())->getValue(); ?></textarea>
                    </div>            
                </div>      
    
                <div class="model-form-submit">
                   <input type="submit" value="Uložit">
               </div>                
            </form>
          </div>    
            
       </div>  
