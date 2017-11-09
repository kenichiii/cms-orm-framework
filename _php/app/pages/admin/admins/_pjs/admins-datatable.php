$(document).ready(function(){
  
    var adminsgrid = new Admins_Datatable();
    adminsgrid.init();
});

//extend class
Admins_Datatable.prototype = new jDataGrid();
Admins_Datatable.prototype.constructor = Admins_Datatable;

function Admins_Datatable() {
    //necessery for jquery functionality
    var self = this;

    var settings = {
     id: 'admins',
    jid: '#admins',
    };
        
    this.extendSettings(settings);
  
  
   Admins_Datatable.prototype.getFiltersValues = function() {
  
       return {
<?php $dt=new Admins_Datatable(); echo $dt->getJsFilters("\n"); ?>
        };
    };
  
          
        
 Admins_Datatable.prototype.bindeditActions = function() {
 

    	var options = {
	        success: this.recordEditedAction,
	        dataType:  'json'
        };
       
       $('#userformedit').ajaxForm(options);
       
       
                

    }       
       
 Admins_Datatable.prototype.recordEditedAction = function(json) {   

    $('#userformedit').find(".form_err").remove();   
    
 if( json.succ == 'yes' ) {
                showAlert("Vaše údaje byly v pořádku uloženy");
                self.load();
                self.contentRefresh();  
 }
 else {
                                    
                               if ( typeof(json.errors) == 'object' ) 
                               {
                                    
                                    if(json.errors[0].el=='exception')
                                    {
                                        $('#userformedit').find('span.error') 
                                        .after('<div class="form_err">'+json.errors[0].mess+'<br><br></div>');          
                                    }
                                    else {
                                      $('#userformedit').find('span.error') 
                                        .after('<div class="form_err">Při ukládání došlo k chybám ve validaci, prosím opravte si svoje údaje<br><br></div>');          
                                    
                                      for ( var i=0;i<json.errors.length;i++ ) 
                                      {
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
                                     } //end else exception 
                                  }
    }
 
 }   
    
    Admins_Datatable.prototype.bindpasswordActions = function() {
    
    	var options = {
	        success: this.passwordEditedAction,
	        dataType:  'json'
        };
       
       $('#userformpwd').ajaxForm(options);
       
       
    }
         
    Admins_Datatable.prototype.passwordEditedAction = function(json) {
  
           $('#userformpwd').find(".form_err").remove();   
    
 if( json.succ == 'yes' ) {
                showAlert("Vaše údaje byly v pořádku uloženy");
 }
 else {
                                    
                               if ( typeof(json.errors) == 'object' ) 
                               {
                                    
                                    if(json.errors[0].el=='exception')
                                    {
                                        $('#userformpwd').find('span.error') 
                                        .after('<div class="form_err">'+json.errors[0].mess+'<br><br></div>');          
                                    }
                                    else {
                                      $('#userformpwd').find('span.error') 
                                        .after('<div class="form_err">Při ukládání došlo k chybám ve validaci, prosím opravte si svoje údaje<br><br></div>');          
                                    
                                      for ( var i=0;i<json.errors.length;i++ ) 
                                      {
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
                                     } //end else exception 
                                  }
    }
 
    }

         
    
Admins_Datatable.prototype.actions = function() {
    
  

    
           
        $('a.actionEdit').click(function() {
            var url = this.href;
            self.dialog = $('<div style="display:hidden"></div>').appendTo('body');
            // load remote content
            self.dialog.load(
                url,
                {},
                function (responseText, textStatus, XMLHttpRequest) {
                    self.dialog.dialog({
                            title: 'Editovat',
                            modal: true,
                            width: 1000,
                            close: function(event, ui) {
                                                                $(this).remove();
                            }
                    });


                    self.bindeditActions();

                });
            return false;
      });
       
      
    
           
        $('a.actionPwdChange').click(function() {
            var url = this.href;
            self.dialog = $('<div style="display:hidden"></div>').appendTo('body');
            // load remote content
            self.dialog.load(
                url,
                {},
                function (responseText, textStatus, XMLHttpRequest) {
                    self.dialog.dialog({
                            title: 'Změna hesla',
                            modal: true,
                            width: 1000,
                            close: function(event, ui) {
                                                                $(this).remove();
                            }
                    });


                    self.bindpasswordActions();

                });
            return false;
      });
       
      
    
        
       $('a.actionDelete').click(function() {
            var url = this.href;
            var dialog = $('<div style="display:hidden"></div>').appendTo('body');
            // load remote content
            dialog.load(
                url,
                {},
                function (responseText, textStatus, XMLHttpRequest) {
                    dialog.dialog({ 
                            title: 'Smazat',
                            modal: true,
                            width: 600,
                            close: function(event, ui) {$(this).remove();}
                    });


                    $('a.goDelete').click(function() {
                        $.get( this.href,{},function(data){
                            if( data != "error" )
                                {
                                    showAlert(data);
                                    self.load();
                                    self.contentRefresh();
                                    $(dialog).dialog('close');
                                }
                            else showAlert('Error - zopakujte prosím akci',{mtype:'err'})
                        } );

                        return false;
                    });

                    $('a.stopDelete').click(function() {

                        $(dialog).dialog('close');

                        return false;
                    });


                });
            return false;
      });
       
      
          
    };
    
    


 

Admins_Datatable.prototype.addButton = function() {
  
       $(this.settings.jid + " .dataGridAddButton").css('cursor','pointer').click(function(){            
            var url = $(self.settings.jid+ " input[name='dataGridAddNewRecord']").val();
            var dialog = $('<div style="display:hidden"></div>').appendTo('body');

            dialog.load(
                url,
                {},
                function (responseText, textStatus, XMLHttpRequest) {
                    dialog.dialog({
                            title: 'Nové konto',
                            modal: true,
                            width: 1000,
                            close: function(event, ui) {
                                $(this).remove();
                 
                                
                            }
                    });
                    self.bindNewRecordActions();
                });
            return false;

          
       });
    };

Admins_Datatable.prototype.bindNewRecordActions = function() {
  
	var options = {
	        success: this.newRecordAdd,
	        dataType:  'json'
        };
       
       $('#userformnew').ajaxForm(options);
       
       
       
                 

    };
    
    
Admins_Datatable.prototype.newRecordAdd = function(json) {
 $('#userformnew').find(".form_err").remove();   
    
 if( json.succ == 'yes' ) {
          $.get( $(self.settings.jid+" input[name='dataGridActionedit']").val(), {
              id : json.id
          }, function(data) {
                showAlert("Nový záznam byl v pořádku vložen");
                self.load();
                self.contentRefresh();
                
                $(".datagridPopupHtml").fadeOut('slow').html( data ).fadeIn('slow');
                $(".ui-dialog-title").fadeOut('slow').html('Upravit konto').fadeIn('slow');
                self.bindeditActions();
                
          } );
 }
 else {      
                               if ( typeof(json.errors) == 'object' ) 
                               {
                                    
                                    if(json.errors[0].el=='exception')
                                    {
                                        $('#userformnew').find('span.error') 
                                        .after('<div class="form_err">'+json.errors[0].mess+'<br><br></div>');          
                                    }
                                    else {
                                      $('#userformnew').find('span.error') 
                                        .after('<div class="form_err">Při ukládání došlo k chybám ve validaci, prosím opravte si svoje údaje<br><br></div>');          
                                    
                                      for ( var i=0;i<json.errors.length;i++ ) 
                                      {
                                        if ( json.errors[i].el ) 
                                        {
                                          $('#userformnew').find("input[name='" + json.errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                          $('#userformnew').find("select[name='" + json.errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                          $('#userformnew').find("." + json.errors[i].el )                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                         }
                                       } //end for
                                     } //end else exception 
                                  }

    }  

 };
 

 
 
 
 } //end js class
 
 
 