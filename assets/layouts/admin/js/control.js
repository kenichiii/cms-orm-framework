

$(function(){
    
    /*
     * non cached layout
     */    
    if($("#logged-user-data-link").val())
    $.get($("#logged-user-data-link").val(),{},function(data) {
       $(".logged-user-element").html(data); 
    });


    $("#admin-my-password-btn").click(function(){
       var url = this.href;
        var dialog = $('<div style="display:hidden"></div>').appendTo('body');
            // load remote content
           dialog.load(
                url,
                {},
                function (responseText, textStatus, XMLHttpRequest) {
                    dialog.dialog({
                            title: 'Úprava hesla',
                            modal: true,
                            width: 1000,
                            close: function(event, ui) {
                                                                $(this).remove();
                            }
                    });


                        	var options = {
                                        success: passwordEditedAction,
                                        dataType:  'json'
                                };

                               $('#userformpwd').ajaxForm(options);

                });
        
        return false;
    });

    $("#admin-my-account-btn").click(function(){
       var url = this.href;
        var dialog = $('<div style="display:hidden"></div>').appendTo('body');
            // load remote content
           dialog.load(
                url,
                {},
                function (responseText, textStatus, XMLHttpRequest) {
                    dialog.dialog({
                            title: 'Úprava konta',
                            modal: true,
                            width: 1000,
                            close: function(event, ui) {
                                                                $(this).remove();
                            }
                    });


                        	var options = {
                                        success: accountEditedAction,
                                        dataType:  'json'
                                };

                               $('#userformedit').ajaxForm(options);

                });
        
        return false;
    });

 });  

function accountEditedAction(json) {   

    $('#userformedit').find(".form_err").remove();   
    
 if( json.succ == 'yes' ) {
                showAlert("Vaše údaje byly v pořádku uloženy");
    $.get($("#logged-user-data-link").val(),{},function(data) {
       $(".logged-user-element").fadeOut('fast').html(data).fadeIn('fast'); 
    });                
 }
 else {
                                    
                               if ( typeof(json.errors) == 'object' ) 
                               {                                    
                                      $('#userformedit').find('span.error') 
                                        .after('<div class="form_err">Při ukládání došlo k chybám ve validaci, prosím opravte si svoje údaje<br><br></div>');          
                                    
                                      for ( var i=0;i<json.errors.length;i++ ) 
                                      {
                                        if( json.errors[i].el && json.errors[i].el=='exception' )
                                        {
                                            showAlert(json.errors[i].mess,{mtype:'err'});                                            
                                        }
                                        
                                        if ( json.errors[i].el ) 
                                        {
                                          $('#userformedit').find("input[name='" + json.errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                          $('#userformedit').find("select[name='" + json.errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                          $('#userformedit').find("." + json.errors[i].el )                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                         }
                                       } //end for

                                  }
    }
 
 }   

function passwordEditedAction(json) {
  
           $('#userformpwd').find(".form_err").remove();   
    
 if( json.succ == 'yes' ) {
                showAlert("Vaše údaje byly v pořádku uloženy");
 }
 else {
                                    
                               if ( typeof(json.errors) == 'object' ) 
                               {
                                    
                                      $('#userformpwd').find('span.error') 
                                        .after('<div class="form_err">Při ukládání došlo k chybám ve validaci, prosím opravte si svoje údaje<br><br></div>');          
                                    
                                      for ( var i=0;i<json.errors.length;i++ ) 
                                      {
                                        if( json.errors[i].el && json.errors[i].el=='exception' )
                                        {
                                            showAlert(json.errors[i].mess,{mtype:'err'});                                            
                                        }
                                          
                                        if ( json.errors[i].el ) 
                                        {
                                          $('#userformpwd').find("input[name='" + json.errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                          $('#userformpwd').find("select[name='" + json.errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                          $('#userformpwd').find("." + json.errors[i].el )                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                         }
                                       } //end for

                                  }
    }
 
    }



/**
 * TABS
 */
function simpletabs() {
    $('.tabs-head a').removeClass('active');
    $('.tab').hide();
    $('.tab:first').show();
    $('.tabs-head a:first').addClass('active');
    
    $('.tabs-head a').unbind('click').click(function(){
        $('.tabs-head a').removeClass('active');
        $('.tab').hide();
        $($(this).attr('href')).show();
        $(this).addClass('active');
        return false;
    })
}


/**
 * 
 * ALERTS

       showConfirm('Ahoj z otazky?',function(){
           showConfirm('Zobrazit error',function(){
               showAlert('Toto je error',{mtype:'err',callback:function(){
                 showAlert('OK do confirmu',{modal:true,autohide:false,buttonText:"DALE",callback:function(){
                     showConfirm("posledni?",function(){});    
                 }})      
               }});
           })
       })

 */
function showAlert(message,params)
{                   
    var settings = {
        callback:function(){},
        mtype:"OK",//OK|err|info
        modal:null,//true|false
        autohide:null,//true|false
        buttonText:"OK",
        topMargin: 50,//pixels
        startFromMinus: 100,//pixels
        delayAutoHide: 5500,//ms
        delaySlideDownStartAni: 1000,//ms
        delaySlideUpEndAni: 500,//ms
    }
    
    
    $.extend( settings, params );
    
    var ALERT_SHOW_TIMEOUT;
    
    clearTimeout(ALERT_SHOW_TIMEOUT);
    $(".popup-alert-holder").stop();
    
       if(settings.mtype=="err"&&settings.autohide===null) settings.autohide=false;
       if(settings.autohide===null) settings.autohide= true;       
        
       if(settings.mtype=="err"&&settings.modal===null) settings.modal=true;
       if(settings.modal===null) settings.modal = false; 
     
     
    
       $('.popup-alert-holder').removeClass('popup-alert-OK').removeClass('popup-alert-err').removeClass('popup-alert-info')
               .addClass('popup-alert-'+settings.mtype)
    
     
       var pwidth = parseInt($('.popup-alert-holder').css('width')); 
       
       var wwidth = $(window).width();
       var wheight = $(window).height();               
       var wscrolltop = $(window).scrollTop();
       
       var pendtop = ""+(wscrolltop+settings.topMargin)+"px"; 
       var pstarttop = ""+(wscrolltop-settings.startFromMinus)+"px";       
       var pleft;       
 
       if(wwidth>pwidth)
       {
           
           //center
           pleft = ""+(wwidth/2-pwidth/2)+"px";           
       }
       else if(wwidth<=pwidth)
       {
           $(".popup-alert-holder").css('width',""+(wwidth-20)+"px")           
           pleft = "10%";
       }
       
       
        function hideAlert() 
        {  
                $(".popup-modal-holder").hide();
                $(".popup-alert-holder")
                        .animate({'opacity':'0','top':pstarttop},settings.delaySlideUpEndAni,
                            function(){
                                $(".popup-alert-holder").hide();
                                }
                           );
        }
    
     $('.popup-alert-button').html(settings.buttonText).unbind('click').click(function(){
         clearTimeout(ALERT_SHOW_TIMEOUT);
         hideAlert();   
         settings.callback();
         return false;
     });

       
       
       if(settings.modal)
       {
           $(".popup-modal-holder").css({'width':$(document).width(),'height':$(document).height()}).show();
       }
       
       
       $('.popup-alert-message-holder').html(message);
    
       $('.popup-alert-holder').css({'top':pstarttop,'opacity':'0','left':pleft})
          .show()
          .animate({
            opacity: 1,
            top: pendtop
            }, settings.delaySlideDownStartAni, function() {
                   
                  if(settings.autohide) 
                   ALERT_SHOW_TIMEOUT = setTimeout(function(){
                       hideAlert();
                   },settings.delayAutoHide)    
            });
           
 }

function showConfirm(question,yesfunction,params)
{
    var settings = {    
        buttonYes: 'ANO',
        buttonNo: 'NE',
        topMargin: 50,//pixels
        startFromMinus: 100,//pixels
        delaySlideDownStartAni: 1000,//ms
        delaySlideUpEndAni: 500,//ms
        nofunction: function(){}
        
    }
        
    $.extend( settings, params );       
   
   $('.popup-confirm-holder').stop()
   
   
  function hideConfirm() 
        {  
                $(".popup-modal-holder").hide();
                $(".popup-confirm-holder").animate({'opacity':'0','top':pstarttop},settings.delaySlideUpEndAni,function(){                                
                    $(".popup-confirm-holder").hide();                                                                                                           
                });
        }  
    
     $('.popup-confirm-yes-button').unbind('click').click(function(){
         hideConfirm();         
         yesfunction();
         return false;
     });
     $('.popup-confirm-no-button').unbind('click').click(function(){
         hideConfirm();
         settings.nofunction();
         return false;
     }); 
    
       var pwidth = parseInt($('.popup-alert-holder').css('width')); 
       
       var wwidth = $(window).width();
       var wheight = $(window).height();               
       var wscrolltop = $(window).scrollTop();
       
       var pendtop = ""+(wscrolltop+settings.topMargin)+"px"; 
       var pstarttop = ""+(wscrolltop-settings.startFromMinus)+"px";       
       var pleft;       
 
       if(wwidth>pwidth)
       {
           
           //center
           pleft = ""+(wwidth/2-pwidth/2)+"px";           
       }
       else if(wwidth<=pwidth)
       {
           $(".popup-confirm-holder").css('width',""+(wwidth-20)+"px")           
           pleft = "10%";
       }
       
       
           $(".popup-modal-holder").css({'width':$(document).width(),'height':$(document).height()}).show();
       
       
       
       $('.popup-confirm-question-holder').html(question);
    
       $('.popup-confirm-holder').css({'top':pstarttop,'opacity':'0','left':pleft})
          .show()
          .animate({
            opacity: 1,
            top: pendtop
            }, settings.delaySlideDownStartAni, function() {
                   
            });    
}
 

 
