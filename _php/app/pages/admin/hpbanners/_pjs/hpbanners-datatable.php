$(document).ready(function(){
  
    var hpbannersgrid = new Hpbanner_Datatable();
    hpbannersgrid.init();
});

//extend class
Hpbanner_Datatable.prototype = new jDataGrid();
Hpbanner_Datatable.prototype.constructor = Hpbanner_Datatable;

function Hpbanner_Datatable() {
    //necessery for jquery functionality
    var self = this;

    var settings = {
     id: 'hpbanners',
    jid: '#hpbanners',
    };
        
    this.extendSettings(settings);
    
    //this.settings = settings;
  
  
   Hpbanner_Datatable.prototype.getFiltersValues = function() {
 
       return {
<?php $dt=new Hpbanner_Datatable(); echo $dt->getJsFilters("\n"); ?>
        };
    };
  
          
        
    Hpbanner_Datatable.prototype.bindeditActions = function() {
 
        	var options = {
	        success: this.formhomebannerformedit,
	        dataType:  'json'
        };
       
       $('#homebannerformedit').ajaxForm(options);
       
       activateFotoFormListener();
    }
    
Hpbanner_Datatable.prototype.formhomebannerformedit = function(json) {
        $('#homebannerformedit').find(".form_err").remove();   

         if( json.succ == 'yes' ) {         
                showAlert("Vaše údaje byly v pořádku uloženy");
                self.load();
                self.contentRefresh();                
         }
         else {
              window.scrollTo(0,0);      
                                    
                               if ( typeof(json.errors) == 'object' ) 
                               {
                                    
                                    if(json.errors[0].el=='exception')
                                    {
                                        $('#homebannerformedit').find('span.error') 
                                        .after('<div class="form_err">'+json.errors[0].mess+'<br><br></div>');          
                                    }
                                    else {
                                      $('#homebannerformedit').find('span.error') 
                                        .after('<div class="form_err">Při ukládání došlo k chybám ve validaci, prosím opravte si svoje údaje<br><br></div>');          
                                    
                                      for ( var i=0;i<json.errors.length;i++ ) 
                                      {
                                        if ( json.errors[i].el ) 
                                        {
                                          $('#homebannerformedit').find("input[name='" + json.errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                          $('#homebannerformedit').find("select[name='" + json.errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                          $('#homebannerformedit').find("." + json.errors[i].el )                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                         }
                                       } //end for
                                     } //end else exception 
                                  }
    }    
    }
    
                      

    
Hpbanner_Datatable.prototype.actions = function() {
    
 

    
           
        $('a.actionEdit').click(function() {
            var url = this.href;
            self.dialog = $('<div style="display:hidden"></div>').appendTo('body');
            // load remote content
            self.dialog.load(
                url,
                {},
                function (responseText, textStatus, XMLHttpRequest) {
                    self.dialog.dialog({
                            title: 'Upravit',
                            modal: true,
                            width: 1000,
                            close: function(event, ui) {$(this).remove();}
                    });


                    self.bindeditActions();

                });
            return false;
      });
       
      
    
           
      $('a.moveUp').click(function() {
            var url = this.href;    
            
            $.get(url,{},function(res) {
                if(res=="done")
                {
                   showAlert("Banner byl v pořádku posunut nahoru");
                   self.load();
                   self.contentRefresh();  
                } 
                else showAlert(res,{mtype:'err'})                
            });
      
            return false;
      });
       
      
    
           
        $('a.moveDown').click(function() {
            var url = this.href;    
            
            $.get(url,{},function(res) {
                if(res=="done")
                {
                   showAlert("Banner byl v pořádku posunut dolů");
                   self.load();
                   self.contentRefresh();  
                } 
                else showAlert(res,{mtype:'err'})                
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
                            if( data == "done" )
                             {
                                    showAlert("Banner byl vpořádku smazán");
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
    
    


 

Hpbanner_Datatable.prototype.addButton = function() {
 
       $(this.settings.jid + " .dataGridAddButton").css('cursor','pointer').click(function(){            
            var url = $(self.settings.jid+ " input[name='dataGridAddNewRecord']").val();
            var dialog = $('<div style="display:hidden"></div>').appendTo('body');

            dialog.load(
                url,
                {},
                function (responseText, textStatus, XMLHttpRequest) {
                    dialog.dialog({
                            title: 'Nový',
                            modal: true,
                            width: 1000,
                            close: function(event, ui) {$(this).remove();}
                    });
                    self.bindNewRecordActions();
                });
            return false;

          
       });
    };


    
Hpbanner_Datatable.prototype.newRecordAdd = function(json) {



 $('#homebannerformnew').find(".form_err").remove();   
    
 if( json.succ == 'yes' ) {
          $.get( $(self.settings.jid+" input[name='dataGridActionedit']").val(), {
              id : json.id
          }, function(data) {
                showAlert("Banner byl v pořádku vložen");
                self.load();
                self.contentRefresh();
                $(".datagridPopupHtml").fadeOut('slow').html( data ).fadeIn('slow');
                $(".ui-dialog-title").fadeOut('slow').html('Úprava banneru').fadeIn('slow');
                self.bindeditActions();
                
          } );
 }
 else {
      
                               if ( typeof(json.errors) == 'object' ) 
                               {
                                    
                                    if(json.errors[0].el=='exception')
                                    {
                                        $('#homebannerformnew').find('span.error') 
                                        .after('<div class="form_err">'+json.errors[0].mess+'<br><br></div>');          
                                    }
                                    else {
                                      $('#homebannerformnew').find('span.error') 
                                        .after('<div class="form_err">Při ukládání došlo k chybám ve validaci, prosím opravte si svoje údaje<br><br></div>');          
                                    
                                      for ( var i=0;i<json.errors.length;i++ ) 
                                      {
                                        if ( json.errors[i].el ) 
                                        {
                                          $('#homebannerformnew').find("input[name='" + json.errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                          $('#homebannerformnew').find("select[name='" + json.errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                          $('#homebannerformnew').find("." + json.errors[i].el )                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                         }
                                       } //end for
                                     } //end else exception 
                                  }

    }       
      
      
 };
     
    
    
Hpbanner_Datatable.prototype.bindNewRecordActions = function() {
 
       //new init
       	var options = {
	        success: this.newRecordAdd,
	        dataType:  'json'
        };
       
       $('#homebannerformnew').ajaxForm(options);

    };
    

} 