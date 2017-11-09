$(document).ready(function(){
  
    var newsgrid = new News_Datatable();
    newsgrid.init();
});

//extend class
News_Datatable.prototype = new jDataGrid();
News_Datatable.prototype.constructor = News_Datatable;

function News_Datatable() {
    //necessery for jquery functionality
    var self = this;

    var settings = {
     id: 'news',
    jid: '#news',
    };
        
    this.extendSettings(settings);
  
  
   News_Datatable.prototype.getFiltersValues = function() {
  
       return {
<?php $dt=new News_Datatable(); echo $dt->getJsFilters("\n"); ?>
        };
    };
  
          
        
 News_Datatable.prototype.bindeditActions = function() {
 

    	var options = {
	        success: this.recordEditedAction,
	        dataType:  'json'
        };
       
       $('#newsformedit').ajaxForm(options);
       
    	var options = {
	        success: this.contentEditedAction,
	        dataType:  'json'
        };
       
       $('#contentForm').ajaxForm(options);       
               

       $('#contentForm .wys-obsah').tinymce({
                        // Location of TinyMCE script
                        script_url : '/assets/libs/tinymce/tinymce.min.js',
        width: 800,
        height: 300,
        language: "cs",
        fullpage_default_encoding: "utf-8",
        entity_encoding:	'raw',
                        plugins : "advlist,autolink,link,image,lists,charmap,preview,hr,anchor,pagebreak,searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking table contextmenu directionality template paste textcolor",
                        toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor | link image | code",
                        menubar: "format insert table edit view" //tools


                });




       $("#newsformedit .idate-datum").datepicker(); 
       
       activateFotoFormListener();
       
      $("#newsformedit input[name='h1']").keyup(function() {
            var uri = niceUrl(this.value);
            $("#newsformedit input[name='uri']").val(uri);
       });
       
       gallerypageadmin();
       
       simpletabs();  
    }       
       
 News_Datatable.prototype.recordEditedAction = function(json) {   

    $('#newsformedit').find(".form_err").remove();   
    
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
                                        $('#newsformedit').find('span.error') 
                                        .after('<div class="form_err">'+json.errors[0].mess+'<br><br></div>');          
                                    }
                                    else {
                                      $('#newsformedit').find('span.error') 
                                        .after('<div class="form_err">Při ukládání došlo k chybám ve validaci, prosím opravte si svoje údaje<br><br></div>');          
                                    
                                      for ( var i=0;i<json.errors.length;i++ ) 
                                      {
                                        if ( json.errors[i].el ) 
                                        {
                                          $('#newsformedit').find("input[name='" + json.errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                          $('#newsformedit').find("select[name='" + json.errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                          $('#newsformedit').find("." + json.errors[i].el )                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                         }
                                       } //end for
                                     } //end else exception 
                                  }
    }
 
 }   
    
 News_Datatable.prototype.contentEditedAction = function(json) {   

    $('#contentForm').find(".form_err").remove();   
    
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
                                        $('#newsformedit').find('span.error') 
                                        .after('<div class="form_err">'+json.errors[0].mess+'<br><br></div>');          
                                    }
                                    else {
                                      $('#newsformedit').find('span.error') 
                                        .after('<div class="form_err">Při ukládání došlo k chybám ve validaci, prosím opravte si svoje údaje<br><br></div>');          
                                    
                                      for ( var i=0;i<json.errors.length;i++ ) 
                                      {
                                        if ( json.errors[i].el ) 
                                        {
                                          $('#contentForm').find("input[name='" + json.errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                          $('#contentForm').find("select[name='" + json.errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                          $('#contentForm').find("." + json.errors[i].el )                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                         }
                                       } //end for
                                     } //end else exception 
                                  }
    }
 
 }   
        
         
    
News_Datatable.prototype.actions = function() {
    
  

    
           
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
    
    


 

News_Datatable.prototype.addButton = function() {
  
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
                            close: function(event, ui) {
                                $(this).remove();
               $("#newsformnew .tinymce").tinymce().remove()  
                                
                            }
                    });
                    self.bindNewRecordActions();
                });
            return false;

          
       });
    };

News_Datatable.prototype.bindNewRecordActions = function() {
  
	var options = {
	        success: this.newRecordAdd,
	        dataType:  'json'
        };
       
       $('#newsformnew').ajaxForm(options);
       
       
       
               

       $('#newsformnew .wys-obsah').tinymce({
                        // Location of TinyMCE script
                        script_url : '/assets/libs/tinymce/tinymce.min.js',
        width: 600,
        height: 300,
        language: "cs",
        fullpage_default_encoding: "utf-8",
        entity_encoding:	'raw',
                        plugins : "advlist,autolink,link,image,lists,charmap,preview,hr,anchor,pagebreak,searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking table contextmenu directionality template paste textcolor",
                        toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor | link image | code",
                        menubar: "format insert table edit view" //tools


                });




       $("#newsformnew .idate-datum").datepicker();  
        
       
       $("#newsformnew input[name='h1']").keyup(function() {
            var uri = niceUrl(this.value);
            $("#newsformnew input[name='uri']").val(uri);
       });
       
    };
    
    
News_Datatable.prototype.newRecordAdd = function(json) {
 $('#newsformnew').find(".form_err").remove();   
    
 if( json.succ == 'yes' ) {
          $.get( $(self.settings.jid+" input[name='dataGridActionedit']").val(), {
              id : json.id
          }, function(data) {
                showAlert("Nový záznam byl v pořádku vložen");
                self.load();
                self.contentRefresh();
                $(".datagridPopupHtml").fadeOut('slow').html( data ).fadeIn('slow');
                $(".ui-dialog-title").fadeOut('slow').html('Úprava novinky').fadeIn('slow');
                self.bindeditActions();
                
          } );
 }
 else {      
                               if ( typeof(json.errors) == 'object' ) 
                               {
                                    
                                    if(json.errors[0].el=='exception')
                                    {
                                        $('#newsformnew').find('span.error') 
                                        .after('<div class="form_err">'+json.errors[0].mess+'<br><br></div>');          
                                    }
                                    else {
                                      $('#newsformnew').find('span.error') 
                                        .after('<div class="form_err">Při ukládání došlo k chybám ve validaci, prosím opravte si svoje údaje<br><br></div>');          
                                    
                                      for ( var i=0;i<json.errors.length;i++ ) 
                                      {
                                        if ( json.errors[i].el ) 
                                        {
                                          $('#newsformnew').find("input[name='" + json.errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                          $('#newsformnew').find("select[name='" + json.errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                          $('#newsformnew').find("." + json.errors[i].el )                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                         }
                                       } //end for
                                     } //end else exception 
                                  }

    }  

 };
 

 
 
 
 } //end js class
 
 
 