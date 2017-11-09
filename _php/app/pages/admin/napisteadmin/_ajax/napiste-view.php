<?php
 
    $id = $_GET['id'];
   
            $bean  = Napiste_Model::loadByPK($id);
         
        
        if($bean instanceof Napiste_Model && $bean->getDeleted()->getValue()==0 ) 
        {
            
        }
        else {        
            $notfound = true;
            App::getIns()->setPageTreePage($lastindex,'h1','Error 404'); 
            App::getIns()->setPageTreePage($lastindex,'menuname','Error 404');                            
        }
    
?>

<div class="datagridPopupHtml">

 <?php if(isset($notfound)&&$notfound) { ?>    
        
    Vámi požadovaná stránka neexistuje nebo byla stažena.
        
    <?php } else { ?>    
        
    <div class="zprava-holder">
    
        
        
        
              <div class="zprava-collum id">
          <div class="zprava-collum-title "><strong>Id</strong></div>
          <div class="zprava-collum-value"><?php echo $bean->get('id')->getViewValue(); ?></div>
      </div>

                          <div class="zprava-collum jmeno">
          <div class="zprava-collum-title "><strong>Jméno</strong></div>
          <div class="zprava-collum-value"><?php echo $bean->get('jmeno')->getViewValue(); ?></div>
      </div>
                          <div class="zprava-collum email">
          <div class="zprava-collum-title "><strong>Email</strong></div>
          <div class="zprava-collum-value"><?php echo $bean->get('email')->getViewValue(); ?></div>
      </div>
                          <div class="zprava-collum telefon">
          <div class="zprava-collum-title "><strong>Telefon</strong></div>
          <div class="zprava-collum-value"><?php echo $bean->get('telefon')->getViewValue(); ?></div>
      </div>
                          <div class="zprava-collum zprava">
          <div class="zprava-collum-title "><strong>Zpráva</strong></div>
          <div class="zprava-collum-value"><?php echo $bean->get('zprava')->getViewValue(); ?></div>
      </div>
                          <div class="zprava-collum created">
          <div class="zprava-collum-title "><strong>Zaslána</strong></div>
          <div class="zprava-collum-value"><?php echo $bean->get('created')->getViewValue(); ?></div>
      </div>
                     
 
                        
      </div>
      
      <br class="clear">
                        
      
      <?php } //end else notfound ?>
      
      
      
      
 
    
</div> 