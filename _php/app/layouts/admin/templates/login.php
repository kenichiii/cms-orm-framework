<div class="current-page-system-content">


   <div id="login-holder"> 
       <h1>Přihlášení</h1>
       <br>
       <form id="login-form" method="post" action="<?php echo App::getIns()->setActionLink(Project::$ADMIN_PAGE_POINTER,'login') ?>">
           <div style='float:left;width:400px;'>
                <div class="model-form-row">
                   <div class="model-form-collum-title">
                       Login    </div>    
                   <div class="model-form-collum-cell">
                       <input type="text" name="login">
                   </div>            
               </div>              
         
                <div class="model-form-row">
                   <div class="model-form-collum-title">
                       Heslo    </div>    
                   <div class="model-form-collum-cell">
                       <input type="password" name="password">
                   </div>            
               </div>  
                                                             
            <div class="model-form-submit">
                <input type='submit'  value='Přihlásit'>
                
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <a id="forgoten-href" href="#" class='button-link-after'>Zapoměl/a jsem heslo</a>                
            </div>    
          </div>              
        </form>    
    
 
       

       <br class="clear">
            

    </form>
    <br>
      
  </div>


  <div id="forgoten-holder" class="hidden">
      <h1>Zapomenuté heslo</h1>  
      <br>
    <form id="forgoten-form" method="post" action="<?php echo App::getIns()->setActionLink(Project::$ADMIN_PAGE_POINTER,'forgoten') ?>">

            <div style='float:left;width:400px;'>
                <div class="model-form-row">
                   <div class="model-form-collum-title">
                       Email    </div>    
                   <div class="model-form-collum-cell">
                       <input type="text" name="email">
                   </div>            
               </div>              
         
                                                             
            <div class="model-form-submit">
                <input type='submit'  value='Vygenerovat nové heslo'>
            </div>    
          </div>    
    </form><br class='clear'><br>
      <a id="login-href" href="#" class='button-link-after'>Přihlášení</a>   
      
      <br><br><br><br>
  </div>    


</div>
