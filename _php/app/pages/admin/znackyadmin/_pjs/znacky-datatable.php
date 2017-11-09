$(document).ready(function(){
  
    var znackygrid = new Znacky_Datatable();
    znackygrid.init();
});

//extend class
Znacky_Datatable.prototype = new jDataGrid();
Znacky_Datatable.prototype.constructor = Znacky_Datatable;

function Znacky_Datatable() {
    //necessery for jquery functionality
    var self = this;

    var settings = {
     id: 'znacky',
    jid: '#znacky',
    };
        
    this.extendSettings(settings);
  
  
   Znacky_Datatable.prototype.getFiltersValues = function() {
  
       return {
<?php $dt=new Znacky_Datatable(); echo $dt->getJsFilters("\n"); ?>
        };
    };
  
          
        
 Znacky_Datatable.prototype.bindeditActions = function() {
    	var options = {
	        success: this.recordEditedAction,
	        dataType:  'json'
        };
       
       $('#znackyformedit').ajaxForm(options);
       
       activateFotoFormListener();
                 
    }       
       
 Znacky_Datatable.prototype.recordEditedAction = function(json) {   
    $('#znackyformedit').find(".form_err").remove();   
    
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
                                        $('#znackyformedit').find('span.error') 
                                        .after('<div class="form_err">'+json.errors[0].mess+'<br><br></div>');          
                                    }
                                    else {
                                      $('#znackyformedit').find('span.error') 
                                        .after('<div class="form_err">Při ukládání došlo k chybám ve validaci, prosím opravte si svoje údaje<br><br></div>');          
                                    
                                      for ( var i=0;i<json.errors.length;i++ ) 
                                      {
                                        if ( json.errors[i].el ) 
                                        {
                                          $('#znackyformedit').find("input[name='" + json.errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                          $('#znackyformedit').find("select[name='" + json.errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                          $('#znackyformedit').find("." + json.errors[i].el )                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                         }
                                       } //end for
                                     } //end else exception 
                                  }
    }
    
 }   
    
        
         
    
Znacky_Datatable.prototype.actions = function() {
    
  

    
           
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
                            close: function(event, ui) {$(this).remove();}
                    });


                    self.bindeditActions();

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
                            else showAlert('Error - zopakujte prosím akci')
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
    
    


 

Znacky_Datatable.prototype.addButton = function() {
  
       $(this.settings.jid + " .dataGridAddButton").css('cursor','pointer').click(function(){            
            var url = $(self.settings.jid+ " input[name='dataGridAddNewRecord']").val();
            var dialog = $('<div style="display:hidden"></div>').appendTo('body');

            dialog.load(
                url,
                {},
                function (responseText, textStatus, XMLHttpRequest) {
                    dialog.dialog({
                            title: 'Nová značka',
                            modal: true,
                            width: 1000,
                            close: function(event, ui) {$(this).remove();}
                    });
                    self.bindNewRecordActions();
                });
            return false;

          
       });
    };

Znacky_Datatable.prototype.bindNewRecordActions = function() {
  
	var options = {
	        success: this.newRecordAdd,
	        dataType:  'json'
        };
       
       $('#znackyformnew').ajaxForm(options);
       
       
       
                 

    };
    
    
Znacky_Datatable.prototype.newRecordAdd = function(json) {
 $('#znackyformnew').find(".form_err").remove();   
    
 if( json.succ == 'yes' ) {
          $.get( $(self.settings.jid+" input[name='dataGridActionedit']").val(), {
              id : json.id
          }, function(data) {
                showAlert("Nový záznam byl v pořádku vložen");
                self.load();
                self.contentRefresh();
                
                $(".datagridPopupHtml").fadeOut('slow').html( data ).fadeIn('slow');
                $(".ui-dialog-title").fadeOut('slow').html('Úprava značky').fadeIn('slow');
                self.bindeditActions();
                
          } );
 }
 else {      
                               if ( typeof(json.errors) == 'object' ) 
                               {
                                    
                                    if(json.errors[0].el=='exception')
                                    {
                                        $('#znackyformnew').find('span.error') 
                                        .after('<div class="form_err">'+json.errors[0].mess+'<br><br></div>');          
                                    }
                                    else {
                                      $('#znackyformnew').find('span.error') 
                                        .after('<div class="form_err">Při ukládání došlo k chybám ve validaci, prosím opravte si svoje údaje<br><br></div>');          
                                    
                                      for ( var i=0;i<json.errors.length;i++ ) 
                                      {
                                        if ( json.errors[i].el ) 
                                        {
                                          $('#znackyformnew').find("input[name='" + json.errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                          $('#znackyformnew').find("select[name='" + json.errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                          $('#znackyformnew').find("." + json.errors[i].el )                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                         }
                                       } //end for
                                     } //end else exception 
                                  }

    }  

 };
 

 
 
 
 } //end js class