<?php
    
   $id = $_GET['id'];

    if(is_numeric($id))
    {
        
        $bean  = User_Model::loadByPK($id);
                        
        if($bean instanceof User_Model) 
        {
            $ownersubj = User_Subject_Model::loadByPK(AppSettings::getBySection("const")->OWNER_SUBJECT_ID);
            $devsubj = User_Subject_Model::loadByPK(AppSettings::getBySection("const")->DEV_SUBJECT_ID);
            
            $urgrid = new User_Roles_Grid();
            $user = $urgrid->where('and '.$urgrid->getAlias('userid').'=%i',$id)
               ->where('and '.$urgrid->getAlias('roleid').'=%i',  AppUserRoles::getIns()->getRole("admin")->getId()->getValue())
               ->getSingle(); 
        
            $adminsubroleid = $user->getSubrole()->getId()->getValue();
            
            $ursgrid = new User_Role_Subrole_Grid();
            $ursgrid->where('and '.$ursgrid->getAlias('roleid').'='.AppUserRoles::getIns()->getRole("admin")->getId()->getValue())
                    ->orderBy($ursgrid->getAlias('rank').' ASC');
            $adminsubroles = $ursgrid->getData();
        }
        else $notFoundedId = true;
    }
    else $notFoundedId = true;
    
?>


        <?php if(isset($notFoundedId)&&$notFoundedId) { ?>
    
        <h1>Neplatné ID</h1>
        
        <?php } else { ?>

        
      <div class="model-form-holder">
        <form id="userformedit" action="<?php echo App::getIns()->setActionLink('_curr','admins-edit') ?>" method="post">                        
        
        <span class='error'></span>    
        
                                <input type="hidden" name="id" value="<?php echo $bean->get('id')->getValue() ?>">
                                                                                                                                                                        
        
        


    
    
<div class="model-form-row">
    <div class="model-form-collum-title">
        Subjekt  </div>    
    <div class="model-form-collum-cell"> 
        <select name="subjectid">
            <option <?php if($ownersubj->getId()->getValue()==$bean->get('subjectid')->getValue())echo'selected="selected"' ?> value='<?php echo $ownersubj->getId()->getValue() ?>'><?php echo $ownersubj->getH1()->getValue() ?></option>
            <option <?php if($devsubj->getId()->getValue()==$bean->get('subjectid')->getValue())echo'selected="selected"' ?> value='<?php echo $devsubj->getId()->getValue() ?>'><?php echo $devsubj->getH1()->getValue() ?></option>
        </select> 
    </div>            
</div>  
  
    
<div class="model-form-row">
    <div class="model-form-collum-title">
        Přístup    </div>    
    <div class="model-form-collum-cell"> 
        <select name="subrole">
           <?php foreach ($adminsubroles as $sk=>$s) {?>
               <option <?php echo $s->getId()->getValue()==$adminsubroleid ? 'selected="selected"':''; ?> value='<?php echo $s->getId()->getValue(); ?>'><?php echo $s->getH1()->getValue(); ?></option> 
           <?php } ?>
        </select>    
    </div>            
</div>  
  
<div class="model-form-row">
    <div class="model-form-collum-title">
        Email    </div>    
    <div class="model-form-collum-cell">
        <input type="text" name="email" value="<?php echo $bean->get('email')->getValue() ?>">
    </div>            
</div>  

<div class="model-form-row">
    <div class="model-form-collum-title">
        Login    </div>    
    <div class="model-form-collum-cell">
        <input type="text" name="login" value="<?php echo $bean->get('login')->getValue() ?>">
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
        <input type="text" name="fullname_titlesbefore" value="<?php echo $bean->get('fullname_titlesbefore')->getValue() ?>">
    </div>            
</div>  

        


<div class="model-form-row">
    <div class="model-form-collum-title">
        Křestní jméno    </div>    
    <div class="model-form-collum-cell">
        <input type="text" name="fullname_firstname" value="<?php echo $bean->get('fullname_firstname')->getValue() ?>">
    </div>            
</div>  

        


<div class="model-form-row">
    <div class="model-form-collum-title">
        Příjmení    </div>    
    <div class="model-form-collum-cell">
        <input type="text" name="fullname_surname" value="<?php echo $bean->get('fullname_surname')->getValue() ?>">
    </div>            
</div>  

        


<div class="model-form-row">
    <div class="model-form-collum-title">
        Tituly za    </div>    
    <div class="model-form-collum-cell">
        <input type="text" name="fullname_titlesafter" value="<?php echo $bean->get('fullname_titlesafter')->getValue() ?>">
    </div>            
</div>  

         </div> 


                                     
            
            <div class="model-form-submit">
                <input type="submit" value="Uložit">
            </div>    
                        
        </form>    
        
       </div>  
       <br class="clear">
        
           
         
      <?php } ?>      
