$(document).ready(function(){

    var hpznacky_datatablegrid = new HPZnacky_Datatable();
    hpznacky_datatablegrid.init();
});

//extend class
HPZnacky_Datatable.prototype = new jDataGrid();
HPZnacky_Datatable.prototype.constructor = HPZnacky_Datatable;

function HPZnacky_Datatable() {
    //necessery for jquery functionality
    var self = this;

    var settings = {
     id: 'hpznacky_datatable',
    jid: '#hpznacky_datatable',
    };

    this.extendSettings(settings);

   HPZnacky_Datatable.prototype.getFiltersValues = function() {

       return {
<?php $dt=new HPZnacky_Datatable(); echo $dt->getJsFilters("\n"); ?>
        };
    };

 HPZnacky_Datatable.prototype.bindeditActions = function() {

      /*
       *  UI TABS
       */
      $('#hpznackaformedit-edit-dialog-tabs').uiTabs();

      /*
       *  EDIT FORM
       */
       $('#hpznackaformedit').pfcAjaxForm({
            onforminit:function(form) {

    form.find("input[name='h1']").keyup(function(){
        form.find("input[name='uri']").val(niceUrl($(this).val()));
    });

            },//end init edit form
            succ: function(json,form) {
                showAlert(json.succMsg);
                self.load();
                self.contentRefresh();              
            }
       }); //end form

                                  /**
                            *  CONTENT TAB FORM
                            */
       $('#hpznackaformedit-contentForm').pfcAjaxForm({
            onforminit:function(form) {

       form.find("textarea[name='content']").tinymce({
                        // Location of TinyMCE script
                        script_url : '/assets/libs/tinymce/tinymce.min.js',
        width: 900,
        height: 600,
        language: "cs",
        fullpage_default_encoding: "utf-8",
        entity_encoding:	'raw',
                        plugins : "advlist,autolink,link,image,lists,charmap,preview,hr,anchor,pagebreak,searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking table contextmenu directionality template paste textcolor",
                        toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor | link image | code",
                        menubar: "format insert table edit view" //tools

                });

            },//end init content form tab
            succ: function(json,form) {
                showAlert(json.succMsg);
                self.load();
                self.contentRefresh();              
            }
       }); //end form

                           /*
                            * FILE UPLOAD FORM
                            */
                          $("#hpznacky_file_photo").pfcFileAdmin({
                            succ: function(res) {
                                self.load();
                                self.contentRefresh();
                            },
                            succdelete:function(){
                                self.load();
                                self.contentRefresh();                            
                            }
                          });

 } //end bindeditActions      

HPZnacky_Datatable.prototype.actions = function() {

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
                            close: function(event, ui) {
                              $("#hpznackaformnew .tinymce").tinymce().remove()  
                                $(this).remove();
                            }
                    });

                    self.bindeditActions();

                });
            return false;
      });

        $('a.moveUp').click(function() {
            var url = this.href;    

            $.get(url,{},function(json) {
                if(json.succ=='yes')
                {
                   showAlert(json.succMsg);
                   self.load();
                   self.contentRefresh();  
                } 
                else showAlert(json.errors[0].mess,{mtype:'err'})                
            },'json');

            return false;
        });

        $('a.moveDown').click(function() {
            var url = this.href;    

            $.get(url,{},function(json) {
                if(json.succ=='yes')
                {
                   showAlert(json.succMsg);
                   self.load();
                   self.contentRefresh();  
                } 
                else showAlert(json.errors[0].mess,{mtype:'err'})                
            },'json');

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
                        $.get( this.href,{},function(json){
                            if( json.succ == 'yes')
                                {
                                    showAlert(json.succMsg);
                                    self.load();
                                    self.contentRefresh();
                                    $(dialog).dialog('close');
                                }
                            else showAlert(json.errors[0].mess,{mtype:'err'})
                        },'json' );

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

HPZnacky_Datatable.prototype.addButton = function() {

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
                            close: function(event, ui) {

               $("#hpznackaformnew .tinymce").tinymce().remove()  
                                $(this).remove();
                            }
                    });
                    self.bindNewRecordActions();
                });
            return false;

       });
    };

HPZnacky_Datatable.prototype.bindNewRecordActions = function() {

       $('#hpznackaformnew').pfcAjaxForm({
            onforminit:function(form) {

    form.find("input[name='h1']").keyup(function(){
        form.find("input[name='uri']").val(niceUrl($(this).val()));
    });

       form.find("textarea[name='content']").tinymce({
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

            },
            succ:function(json,form) {
                    $.get( $(self.settings.jid+" input[name='dataGridActionedit']").val(), {
                        id : json.id
                    }, function(data) {
                          showAlert(json.succMsg);
                          self.load();
                          self.contentRefresh();

                          $(".datagridPopupHtml").fadeOut('slow').html( data ).fadeIn('slow');
                          $(".ui-dialog-title").fadeOut('slow').html('Upravit značku').fadeIn('slow');
                          self.bindeditActions();

                    } );            
            }
       });                             
 };

 } //end js class

 