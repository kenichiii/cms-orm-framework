$(document).ready(function(){
  
    var napistegrid = new Napiste_Datatable();
    napistegrid.init();
});

//extend class
Napiste_Datatable.prototype = new jDataGrid();
Napiste_Datatable.prototype.constructor = Napiste_Datatable;

function Napiste_Datatable() {
    //necessery for jquery functionality
    var self = this;

    var settings = {
     id: 'napiste',
    jid: '#napiste',
    };
        
    this.extendSettings(settings);
  
  
   Napiste_Datatable.prototype.getFiltersValues = function() {
  
       return {
<?php $dt=new Napiste_Datatable(); echo $dt->getJsFilters("\n"); ?>
        };
    };
  
          
        
    Napiste_Datatable.prototype.bindviewActions = function() {
  
        //form init here
    }

         
    
Napiste_Datatable.prototype.actions = function() {
    
  

    
           
        $('a.view').click(function() {
            var url = this.href;
            self.dialog = $('<div style="display:hidden"></div>').appendTo('body');
            // load remote content
            self.dialog.load(
                url,
                {},
                function (responseText, textStatus, XMLHttpRequest) {
                    self.dialog.dialog({
                            title: 'Zobrazit',
                            modal: true,
                            width: 1000,
                            close: function(event, ui) {
                                                                $(this).remove();
                            }
                    });


                    self.bindviewActions();

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
    
    


 

 
 
 
 } //end js class
 
 
 