<?php

            $ownersubj = User_Subject_Model::loadByPK(AppSettings::getBySection("const")->OWNER_SUBJECT_ID);
            $devsubj = User_Subject_Model::loadByPK(AppSettings::getBySection("const")->DEV_SUBJECT_ID);
            
            
            $ursgrid = new User_Role_Subrole_Grid();
            $ursgrid->where('and '.$ursgrid->getAlias('roleid').'='.AppUserRoles::getIns()->getRole("admin")->getId()->getValue())
                    ->orderBy($ursgrid->getAlias('rank').' ASC');
            $adminsubroles = $ursgrid->getData();

?>

<div class="datagridPopupHtml">

        <div class="model-form-holder">    
            
        <form id="userformnew" action="<?php echo App::getIns()->setActionLink('_curr','admins-add') ?>" method="post">                        
        
        <span class='error'></span>    
                        
        

<div class="model-form-row">
    <div class="model-form-collum-title">
        Subjekt  </div>    
    <div class="model-form-collum-cell"> 
        <select name="subjectid">
            <option value='<?php echo $ownersubj->getId()->getValue() ?>'><?php echo $ownersubj->getH1()->getValue() ?></option>
            <option value='<?php echo $devsubj->getId()->getValue() ?>'><?php echo $devsubj->getH1()->getValue() ?></option>
        </select> 
    </div>            
</div>  
  
    
<div class="model-form-row">
    <div class="model-form-collum-title">
        Přístup    </div>    
    <div class="model-form-collum-cell"> 
        <select name="subrole">
           <?php foreach ($adminsubroles as $sk=>$s) {?>
               <option value='<?php echo $s->getId()->getValue(); ?>'><?php echo $s->getH1()->getValue(); ?></option> 
           <?php } ?>
        </select>    
    </div>            
</div>  


<div class="model-form-row">
    <div class="model-form-collum-title">
        Email    </div>    
    <div class="model-form-collum-cell">   
        <input type="text" name="email" value="">
    </div>            
</div>  

 <div class="model-form-row">
     <input checked type='checkbox' name='genemail' value='1' id='genemail'> <label for='genemail'>Odeslat oznamovací email s přístupovými údaji</label>          
</div>        
        
        
<div class="model-form-row">
    <div class="model-form-collum-title">
        Login    </div>    
    <div class="model-form-collum-cell">   
        <input type="text" name="login" value="">
    </div>            
</div>  

        

<div class="model-form-row">
    <div class="model-form-collum-title">
        Heslo    </div>    
    <div class="model-form-collum-cell">
        <input type="password" name="pwd" value="">
    </div>            
</div>  

<div class="model-form-row">
    <div class="model-form-collum-title">
        Heslo znova
    </div>    
    <div class="model-form-collum-cell">
        <input type="password" name="pwd_again" value="">
    </div>            
</div>          
        

                            <div class="model-form-mixed ">
                        <div class="model-form-mixed-title">
                            <h3>Jméno</h3>
                         </div>
                        
                    


<div class="model-form-row">
    <div class="model-form-collum-title">
        Tituly před    </div>    
    <div class="model-form-collum-cell">   
        <input type="text" name="fullname_titlesbefore" value="">
    </div>            
</div>  


        


<div class="model-form-row">
    <div class="model-form-collum-title">
        Křestní jméno    </div>    
    <div class="model-form-collum-cell">   
        <input type="text" name="fullname_firstname" value="">
    </div>            
</div>  


        


<div class="model-form-row">
    <div class="model-form-collum-title">
        Příjmení    </div>    
    <div class="model-form-collum-cell">   
        <input type="text" name="fullname_surname" value="">
    </div>            
</div>  


        


<div class="model-form-row">
    <div class="model-form-collum-title">
        Tituly za    </div>    
    <div class="model-form-collum-cell">   
        <input type="text" name="fullname_titlesafter" value="">
    </div>            
</div>  


         </div> 






    
                                                            
            <div class="model-form-submit">
                <input type="submit" value="Uložit">
            </div>    
                        
        </form>    
                    
        </div>
        <br class="clear">
        
            
    
</div>    
    

