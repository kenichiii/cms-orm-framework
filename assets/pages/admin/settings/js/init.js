

$(function(){
     
             var options = {
	        success: settingEditedAction,
	        dataType:  'json'
              };       
     $('.setting').ajaxForm(options);   
    
     $( "#accordion" ).accordion({collapsible:true});
     $( "#accordion h3 a" ).first().trigger('click');
     $("#accordion .ui-icon").css({float:'left','margin-right':'2px','margin-top':'3px'});
               
});


function settingEditedAction(json)
{
    var form = '#settings-form-'+json.pointer;
    
    //$(form).find(".form_err").remove();   
    
    if( json.succ == 'yes' ) {
        showAlert(json.mess);
    }
    else {
        showAlert(json.mess,{mtype:'err'});
    }
}