
    /*
     *  Login forms
     */
    
 $(function(){   
     
    $("#forgoten-href").click(function(){
        $("#login-holder").fadeOut(function(){
            $("#forgoten-holder").fadeIn();
        })                
        return false;
    });
    
    $("#login-href").click(function(){
        $("#forgoten-holder").fadeOut(function(){
            $("#login-holder").fadeIn();
        })                
        return false;
    });
    
        var options = {
	        success: formadminlogin,
	        dataType:  'json'
        };       
       $('#login-form').ajaxForm(options);

        var options2 = {
	        success: formadminzapomenute,
	        dataType:  'json'
        };       
       $('#forgoten-form').ajaxForm(options2);
       

});

function formadminlogin(json)
{
  $('#login-form').find(".form_err").remove();   
  
 if( json.succ == 'yes' ) {        
        window.location.reload();
 }
 else {      
                                        if( json.errors[0] && json.errors[0].el=='exception' )
                                        {
                                            showAlert(json.errors[0].mess,{mtype:'err'});                                            
                                        }
                                        else
        $('#login-form').prepend('<div class="form_err">Neplatné přihlašovací údaje<br><br></div>');                                     
    }
}


function formadminzapomenute(json)
{
 $('#forgoten-form').find(".form_err").remove();   
    
 if( json.succ == 'yes' ) {
        showAlert("Na Váš email byly odeslány informace s přihlašovacímy údaji",{autohide:false});
 }
 else {
      
        $('#forgoten-form').prepend('<div class="form_err">Při ukládání došlo k chybám ve validaci, prosím opravte si svoje údaje<br><br></div>'); 
                                    
                                    if ( typeof(json.errors) == 'object' ) 
                                    {
                                      for ( var i=0;i<json.errors.length;i++ ) 
                                      {
                                        if( json.errors[i].el && json.errors[i].el=='exception' )
                                        {
                                            showAlert(json.errors[0].mess,{mtype:'err'});                                            
                                        }
                                        
                                        if ( json.errors[i].el ) 
                                        {
                                          $('#forgoten-form').find("input[name='" + json.errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                          $('#forgoten-form').find("select[name='" + json.errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                          $('#forgoten-form').find("." + json.errors[i].el )                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                        }
                                      }
                                    } 
                            
    }
}


