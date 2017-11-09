$(document).ready(function(){
  
    var <?php echo $model->getHtmlID(); ?>grid = new <?php echo $modelclass; ?>();
    <?php echo $model->getHtmlID(); ?>grid.init();
});

//extend class
<?php echo $modelclass; ?>.prototype = new jDataGrid();
<?php echo $modelclass; ?>.prototype.constructor = <?php echo $modelclass; ?>;

function <?php echo $modelclass; ?>() {
    //necessery for jquery functionality
    var self = this;

    var settings = {
     id: '<?php echo $model->getHtmlID(); ?>',
    jid: '#<?php echo $model->getHtmlID(); ?>',
    };
        
    this.extendSettings(settings);
  
  
   <?php echo $modelclass; ?>.prototype.getFiltersValues = function() {
  
       return {
[[ $dt=new <?php echo $modelclass; ?>(); echo $dt->getJsFilters("\n"); ]]
        };
    };
  
          
    <?php foreach($model->getActions() as $action2=>$data2 ) { 
        
    if($action2=='delete'||$action2=='moveup'||$action2=='movedown') continue;
    elseif($action2=='edit') {
    ?>
    
 <?php echo $modelclass; ?>.prototype.bind<?php echo $action2 ?>Actions = function() {

      <?php if($useTabs) { ?> 
 
      /*
       *  UI TABS
       */
      $('#<?php echo $formedit->getName(); ?>-edit-dialog-tabs').uiTabs();
        
      <?php } ?>
 
      
      /*
       *  EDIT FORM
       */
       $('#<?php echo $formedit->getName(); ?>').pfcAjaxForm({
            onforminit:function(form) {
               <?php 
               foreach($formedit->getModel()->getModel() as $key=>$child) { 
                    if($child->isMixed()) printMixedJquery ($child,$formedit);
                    elseif($child->isPrimitive()&&!$child instanceof Model_Default_Content)
                        echo $child->getTemplate('form/edit/js','jquery',$formedit);                             
               } 
               ?>                                    
            },//end init edit form
            succ: function(json,form) {
                showAlert(json.succMsg);
                self.load();
                self.contentRefresh();              
            }
       }); //end form
       

                           
       <?php if($content = $formedit->getModel()->isContentAble()) { ?>
                           /**
                            *  CONTENT TAB FORM
                            */
       $('#<?php echo $formedit->getName(); ?>-contentForm').pfcAjaxForm({
            onforminit:function(form) {
               <?php 
                   echo $content->getTemplate('form/edit/js','jquery',$formedit,array('width'=>900,'height'=>600));                                                                               
               ?>                         
            },//end init content form tab
            succ: function(json,form) {
                showAlert(json.succMsg);
                self.load();
                self.contentRefresh();              
            }
       }); //end form
                           
       <?php } ?>                                               
                           
       
       <?php if($pcoll = $formedit->getModel()->isPhotoAble()) { ?>
                           
                           /*
                            * FILE UPLOAD FORM
                            */
                          $("#<?php echo $formedit->getModel()->getModelName().'_file_'.$pcoll->getCollum(); ?>").pfcFileAdmin({
                            succ: function(res) {
                                self.load();
                                self.contentRefresh();
                            },
                            succdelete:function(){
                                self.load();
                                self.contentRefresh();                            
                            }
                          });
       
       <?php  }   ?>             

       <?php if($pcoll = $formedit->getModel()->isFileAble()) { ?>
                           
                           /*
                            * FILE UPLOAD FORM
                            */
                          $("#<?php echo $formedit->getModel()->getModelName().'_file_'.$pcoll->getCollum(); ?>").pfcFileAdmin({
                            succ: function(res) {
                                self.load();
                                self.contentRefresh();                            
                            },
                            succdelete:function() {
                                self.load();
                                self.contentRefresh();
                            }
                          });
       
       <?php  }   ?>                                       
                          
       <?php foreach($formedit->getModel()->getCollumsInArray()as$cname=>$ccoll) { 
                if($formedit->getModel()->get($cname) instanceof Model_Extended_File && !$formedit->getModel()->get($cname)->isDefault()) {
           ?>                   
                          
                           /*
                            * FILE UPLOAD FORM
                            */
                          $("#<?php echo $formedit->getModel()->getModelName().'_file_'.$formedit->getModel()->get($cname)->getCollum(); ?>").pfcFileAdmin({
                            succ: function(res) {
                                self.load();
                                self.contentRefresh();                            
                            },
                            succdelete:function() {
                                self.load();
                                self.contentRefresh();                                                        
                            }
                          });                          
                          
       <?php }} ?>                   
                          
                          
                          
                          
                   <?php if($gallery = $formedit->getModel()->isGalleryAble()) { 
                                                  
                               $formnewclassgallery = str_replace('_Model', '_Form_New', $gallery->getGrid()->getModelClassName());
                               $formeditclassgallery = str_replace('_Model', '_Form_Edit', $gallery->getGrid()->getModelClassName());

                                $formnewgallery =  new $formnewclassgallery();   
                                $formeditgallery =  new $formeditclassgallery();

                                    if($gallery->isContentAble()||$gallery->isGalleryAble()||$gallery->isDocsAble())
                                        $galleryuseTabs = true;
                                    else $galleryuseTabs = false;
                       ?>
                           
                           /*
                            * GALLERY TAB
                            */
                         
                      var galleryOptions = {

                                    loadParams: {
                                                <?php if($gallery->isLangAble()) { ?>lang:$(".<?php echo $formeditgallery->getModel()->getGrid()->getName(); ?>-holder select[name='lang']").val(),<?php } ?>
                                                <?php if($gallery->isOwnerIdAble()) { ?>ownerid:$(".<?php echo $formeditgallery->getModel()->getGrid()->getName(); ?>-holder input[name='ownerid']").val(),<?php } ?>
                                                <?php if($gallery->isParentIdAble()) { ?>parentid:$(".<?php echo $formeditgallery->getModel()->getGrid()->getName(); ?>-holder input[name='parentid']").val(),<?php } ?>    
                                                test:'test'
                                            },

                                    edit_form_id:'<?php echo $formeditgallery->getName(); ?>',
                                    edit_title:'<?php echo $formeditgallery->getTitle(); ?>',
                                    edit_onforminit:function(form) {
                                          <?php if($galleryuseTabs) { ?> 

                                            $('#<?php echo $formeditgallery->getName(); ?>-edit-dialog-tabs').uiTabs();

                                          <?php } ?>

                                               <?php 
                                               foreach($formeditgallery->getModel()->getModel() as $key=>$child) { 
                                                    if($child->isMixed()) printMixedJquery ($child,$formeditgallery);
                                                    elseif($child->isPrimitive()&&!$child instanceof Model_Default_Content)
                                                        echo $child->getTemplate('form/edit/js','jquery',$formeditgallery);                             
                                               } 
                                               ?>  

                                       <?php if($pcoll = $formeditgallery->getModel()->isPhotoAble()) { ?>

                                                           /*
                                                            * GALLERY FILE UPLOAD FORM
                                                            */
                                                          $("#<?php echo $formeditgallery->getModel()->getModelName().'_file_'.$pcoll->getCollum(); ?>").pfcFileAdmin({
                                                            succ:function(){
                                                                $('.<?php echo $formeditgallery->getModel()->getGrid()->getName(); ?>-holder').pfcFilesGridAdmin(galleryOptions).load();
                                                                if( $("#<?php echo $formeditgallery->getName() ?>-holder .<?php echo $pcoll->getCollum(); ?>-filename").hasClass('test') )
                                                                {
                                                                    $("#<?php echo $formeditgallery->getName() ?>-holder .mainphoto").html($("#<?php echo $formeditgallery->getName() ?>-holder .<?php echo $pcoll->getCollum(); ?>-filename").attr('href'));
                                                                }
                                                                else $("#<?php echo $formeditgallery->getName() ?>-holder .mainphoto").html('---');                                                                
                                                            },
                                                            succdelete:function() {
                                                                $('.<?php echo $formeditgallery->getModel()->getGrid()->getName(); ?>-holder').pfcFilesGridAdmin(galleryOptions).load();
                                                                $("#<?php echo $formeditgallery->getName() ?>-holder .mainphoto").html('---');
                                                            }
                                                          });

                                       <?php  }   ?>             

                                       <?php if($pcoll = $formeditgallery->getModel()->isFileAble()) { ?>

                                                           /*
                                                            * GALLERY FILE UPLOAD FORM
                                                            */
                                                          $("#<?php echo $formeditgallery->getModel()->getModelName().'_file_'.$pcoll->getCollum(); ?>").pfcFileAdmin({
                                                            succ:function(){
                                                                $('.<?php echo $formeditgallery->getModel()->getGrid()->getName(); ?>-holder').pfcFilesGridAdmin(galleryOptions).load();
                                                                if( $("#<?php echo $formeditgallery->getName() ?>-holder .<?php echo $pcoll->getCollum(); ?>-filename").hasClass('test') )
                                                                {
                                                                    $("#<?php echo $formeditgallery->getName() ?>-holder .mainfile").text($("#<?php echo $formeditgallery->getName() ?>-holder .<?php echo $pcoll->getCollum(); ?>-filename").attr('href'));
                                                                }
                                                                else $("#<?php echo $formeditgallery->getName() ?>-holder .mainfile").text('---');
                                                            },
                                                            succdelete:function(){
                                                                $("#<?php echo $formeditgallery->getName() ?>-holder .mainfile").text('---');
                                                                $('.<?php echo $formeditgallery->getModel()->getGrid()->getName(); ?>-holder').pfcFilesGridAdmin(galleryOptions).load();
                                                            }                                                            
                                                          });

                                       <?php  }   ?>                                       

                                       <?php foreach($formeditgallery->getModel()->getCollumsInArray()as$cname=>$ccoll) { 
                                                if($formeditgallery->getModel()->get($cname) instanceof Model_Extended_File && !$formeditgallery->getModel()->get($cname)->isDefault()) {
                                           ?>                   

                                                           /*
                                                            * GALLERY FILE UPLOAD FORM
                                                            */
                                                          $("#<?php echo $formeditgallery->getModel()->getModelName().'_file_'.$formeditgallery->getModel()->get($cname)->getCollum(); ?>").pfcFileAdmin({
                                                            succ:function(){
                                                                $('.<?php echo $formeditgallery->getModel()->getGrid()->getName(); ?>-holder').pfcFilesGridAdmin(galleryOptions).load();                                                                
                                                            },
                                                            succdelete:function() {
                                                                $('.<?php echo $formeditgallery->getModel()->getGrid()->getName(); ?>-holder').pfcFilesGridAdmin(galleryOptions).load();
                                                            }
                                                          });                          

                                       <?php }} ?> 


                                       <?php if($content = $formeditgallery->getModel()->isContentAble()) { ?>
                                                           /**
                                                            *  GALLERY CONTENT TAB FORM
                                                            */
                                       $('#<?php echo $formeditgallery->getName(); ?>-contentForm').pfcAjaxForm({
                                            onforminit:function(form) {
                                               <?php 
                                                   echo $content->getTemplate('form/edit/js','jquery',$formeditgallery,array('width'=>900,'height'=>600));                             
                                               ?>                         
                                            },
                                            succ: function(json,form) {
                                                showAlert(json.succMsg);
                                                $('.<?php echo $formeditdocs->getModel()->getGrid()->getName(); ?>-holder').pfcFilesGridAdmin(docsOptions).load();                
                                            }
                                       }); //end form

                                       <?php } ?>                                               

                                       <?php if($formeditgallery->getModel()->isGalleryAble()) { ?>

                                                           /*
                                                            * GALLERY GALLERY TAB
                                                            */
                                                          // gallerypageadmin();

                                       <?php  }   ?>                            

                                       <?php if($formeditgallery->getModel()->isDocsAble()) { ?>

                                                           /*
                                                            * GALLERY DOCS TAB
                                                            */
                                                          // docspageadmin();

                                       <?php  }   ?>                                     

                                    },//end edit forminit docs


                                };
                                
                       //run options             
                            $('.<?php echo $formeditgallery->getModel()->getGrid()->getName(); ?>-holder').pfcFilesGridAdmin(galleryOptions).init();
                      //end Gallery pfcGridAdmin
       
                   <?php  } //END GALLERY  ?>     

                          
                   <?php if($docs = $formedit->getModel()->isDocsAble()) { 
                       
                               $formnewclassdocs = str_replace('_Model', '_Form_New', $docs->getGrid()->getModelClassName());
                               $formeditclassdocs = str_replace('_Model', '_Form_Edit', $docs->getGrid()->getModelClassName());

                                $formnewdocs =  new $formnewclassdocs();   
                                $formeditdocs =  new $formeditclassdocs();

                                    if($docs->isContentAble()||$docs->isGalleryAble()||$docs->isDocsAble())
                                        $docsuseTabs = true;
                                    else $docsuseTabs = false;
                       ?>
                           
                           /*
                            * DOCS TAB
                            */
                         
                      var docsOptions = {

                                    loadParams: {
                                                <?php if($docs->isLangAble()) { ?>lang:$(".<?php echo $formeditdocs->getModel()->getGrid()->getName(); ?>-holder select[name='lang']").val(),<?php } ?>
                                                <?php if($docs->isOwnerIdAble()) { ?>ownerid:$(".<?php echo $formeditdocs->getModel()->getGrid()->getName(); ?>-holder input[name='ownerid']").val(),<?php } ?>
                                                <?php if($docs->isParentIdAble()) { ?>parentid:$(".<?php echo $formeditdocs->getModel()->getGrid()->getName(); ?>-holder input[name='parentid']").val(),<?php } ?>    
                                                test:'test'
                                            },

                                    edit_form_id:'<?php echo $formeditdocs->getName(); ?>',
                                    edit_title:'<?php echo $formeditdocs->getTitle(); ?>',
                                    edit_onforminit:function(form) {
                                          <?php if($docsuseTabs) { ?> 

                                            $('#<?php echo $formeditdocs->getName(); ?>-edit-dialog-tabs').uiTabs();

                                          <?php } ?>

                                               <?php 
                                               foreach($formeditdocs->getModel()->getModel() as $key=>$child) { 
                                                    if($child->isMixed()) printMixedJquery ($child,$formeditdocs);
                                                    elseif($child->isPrimitive()&&!$child instanceof Model_Default_Content)
                                                        echo $child->getTemplate('form/edit/js','jquery',$formeditdocs);                             
                                               } 
                                               ?>  

                                       <?php if($pcoll = $formeditdocs->getModel()->isPhotoAble()) { ?>

                                                           /*
                                                            * DOCS FILE UPLOAD FORM
                                                            */
                                                          $("#<?php echo $formeditdocs->getModel()->getModelName().'_file_'.$pcoll->getCollum(); ?>").pfcFileAdmin({
                                                            succ:function(){
                                                                $('.<?php echo $formeditdocs->getModel()->getGrid()->getName(); ?>-holder').pfcFilesGridAdmin(docsOptions).load();
                                                                if( $("#<?php echo $formeditdocs->getName() ?>-holder .<?php echo $pcoll->getCollum(); ?>-filename").hasClass('test') )
                                                                {
                                                                    $("#<?php echo $formeditdocs->getName() ?>-holder .mainphoto").html($("#<?php echo $formeditdocs->getName() ?>-holder .<?php echo $pcoll->getCollum(); ?>-filename").attr('href'));
                                                                }
                                                                else $("#<?php echo $formeditdocs->getName() ?>-holder .mainphoto").html('---');                                                                
                                                            },
                                                            succdelete:function(){
                                                                    $('.<?php echo $formeditdocs->getModel()->getGrid()->getName(); ?>-holder').pfcFilesGridAdmin(docsOptions).load();
                                                                    $("#<?php echo $formeditdocs->getName() ?>-holder .mainphoto").html('---');                                                                
                                                            }
                                                          });

                                       <?php  }   ?>             

                                       <?php if($pcoll = $formeditdocs->getModel()->isFileAble()) { ?>

                                                           /*
                                                            * DOCS FILE UPLOAD FORM
                                                            */
                                                          $("#<?php echo $formeditdocs->getModel()->getModelName().'_file_'.$pcoll->getCollum(); ?>").pfcFileAdmin({
                                                            succ:function(){
                                                                $('.<?php echo $formeditdocs->getModel()->getGrid()->getName(); ?>-holder').pfcFilesGridAdmin(docsOptions).load();
                                                                if( $("#<?php echo $formeditdocs->getName() ?>-holder .<?php echo $pcoll->getCollum(); ?>-filename").hasClass('test') )
                                                                {
                                                                    $("#<?php echo $formeditdocs->getName() ?>-holder .mainfile").text($("#<?php echo $formeditdocs->getName() ?>-holder .<?php echo $pcoll->getCollum(); ?>-filename").attr('href'));
                                                                }
                                                                else $("#<?php echo $formeditdocs->getName() ?>-holder .mainfile").text('---');
                                                            },
                                                            succdelete:function(){
                                                                $('.<?php echo $formeditdocs->getModel()->getGrid()->getName(); ?>-holder').pfcFilesGridAdmin(docsOptions).load();
                                                                $("#<?php echo $formeditdocs->getName() ?>-holder .mainfile").text('---');
                                                            }
                                                          });

                                       <?php  }   ?>                                       

                                       <?php foreach($formeditdocs->getModel()->getCollumsInArray()as$cname=>$ccoll) { 
                                                if($formeditdocs->getModel()->get($cname) instanceof Model_Extended_File && !$formeditdocs->getModel()->get($cname)->isDefault()) {
                                           ?>                   

                                                           /*
                                                            * DOCS FILE UPLOAD FORM
                                                            */
                                                          $("#<?php echo $formeditdocs->getModel()->getModelName().'_file_'.$formeditdocs->getModel()->get($cname)->getCollum(); ?>").pfcFileAdmin({
                                                            succ:function(){
                                                                $('.<?php echo $formeditdocs->getModel()->getGrid()->getName(); ?>-holder').pfcFilesGridAdmin(docsOptions).load();                                                                
                                                            },
                                                            succdelete:function(){
                                                                $('.<?php echo $formeditdocs->getModel()->getGrid()->getName(); ?>-holder').pfcFilesGridAdmin(docsOptions).load();                                                                
                                                            }
                                                          });                          

                                       <?php }} ?> 


                                       <?php if($content = $formeditdocs->getModel()->isContentAble()) { ?>
                                                           /**
                                                            *  DOCS CONTENT TAB FORM
                                                            */
                                       $('#<?php echo $formeditdocs->getName(); ?>-contentForm').pfcAjaxForm({
                                            onforminit:function(form) {
                                               <?php 
                                                   echo $content->getTemplate('form/edit/js','jquery',$formeditdocs,array('width'=>900,'height'=>600));                             
                                               ?>                         
                                            },
                                            succ: function(json,form) {
                                                showAlert(json.succMsg);
                                                $('.<?php echo $formeditdocs->getModel()->getGrid()->getName(); ?>-holder').pfcFilesGridAdmin(docsOptions).load();                
                                            }
                                       }); //end form

                                       <?php } ?>                                               

                                       <?php if($formeditdocs->getModel()->isGalleryAble()) { ?>

                                                           /*
                                                            * DOCS GALLERY TAB
                                                            */
                                                          // gallerypageadmin();

                                       <?php  }   ?>                            

                                       <?php if($formeditdocs->getModel()->isDocsAble()) { ?>

                                                           /*
                                                            * DOCS DOCS TAB
                                                            */
                                                          // docspageadmin();

                                       <?php  }   ?>                                     

                                    },//end edit forminit docs


                                };
                                
                       //run options             
                            $('.<?php echo $formeditdocs->getModel()->getGrid()->getName(); ?>-holder').pfcFilesGridAdmin(docsOptions).init();
                      //end DOCS pfcGridAdmin
       
                   <?php  } //isDocsAble  ?>            
                           
 } //end bindeditActions      
       
            
    <?php } else { //end action2=edit?>
    
<?php echo $modelclass; ?>.prototype.bind<?php echo $action2 ?>Actions = function() {
         
       $('#<?php echo $model->getHtmlID() ?>-form-<?php echo $action2 ?>').pfcAjaxForm();        
        
}
       
    <?php } ?>
 <?php } //endforeach ?>
    
    
<?php echo $modelclass; ?>.prototype.actions = function() {
    
  

    <?php foreach($model->getActions() as $action=>$data ) { ?>

     <?php if($action=="delete") { ?>   
       $('a.<?php echo $data['class']; ?>').click(function() {
            var url = this.href;
            var dialog = $('<div style="display:hidden"></div>').appendTo('body');
            // load remote content
            dialog.load(
                url,
                {},
                function (responseText, textStatus, XMLHttpRequest) {
                    dialog.dialog({ 
                            title: '<?php echo $data['title_cz'] ?>',
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
     <?php } elseif($action=='movedown') { ?> 
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
     <?php } elseif($action=='moveup') { ?> 
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
     <?php } else { ?>
      
        $('a.<?php echo $data['class']; ?>').click(function() {
            var url = this.href;
            self.dialog = $('<div style="display:hidden"></div>').appendTo('body');
            // load remote content
            self.dialog.load(
                url,
                {},
                function (responseText, textStatus, XMLHttpRequest) {
                    self.dialog.dialog({
                            title: '<?php echo $data['title_cz']; ?>',
                            modal: true,
                            width: 1000,
                            close: function(event, ui) {
               <?php 
               if($formedit && $action=='edit')
               foreach($formedit->getModel()->getModel() as $key=>$child) { 
                if($child->isMixed()) printTestTinyMixedJqueryNew ($child);
                elseif($child->isPrimitive()&&$child instanceof Model_Extended_RichText)
                    echo '               $("#'. $formnew->getName().' .tinymce").tinymce().remove()';           
               } 
               ?>  
                                $(this).remove();
                            }
                    });


                    self.bind<?php echo $action ?>Actions();

                });
            return false;
      });
     <?php } ?>  
      
    <?php } ?>
      
    };
    
    


 <?php if(count($model->getGroupActions())) { ?>   

 <?php echo $modelclass; ?>.prototype.execCheckboxesAction = function( select ) {
      var checked = '';
        
      $(self.settings.jid + " .dataGridCheckBox input").filter(':checked').each(function(){
           checked += checked != '' ? ',' + $(this).val() : $(this).val();
      });
      
      var count = $(self.settings.jid + " .dataGridCheckBox input").filter(':checked').size();
      
  switch(select.val())
        {
    <?php foreach($model->getGroupActions() as $action=>$data ) { ?>
       case "<?php echo $action ?>":
            var url = $(self.settings.jid + " input[name='checkboxesStatus']").val() + "?count=" + count + "&selected=" + checked;
            var dialog = $('<div style="display:hidden"></div>').appendTo('body');
            // load remote content
            dialog.load(
                url,
                {},
                function (responseText, textStatus, XMLHttpRequest) {
                    dialog.dialog({
                            title: '<?php echo $data['title_cz']; ?>',
                            modal: true,
                            width: 1000,
                            close: function(event, ui) {$(this).remove();}
                    });

                    $('a.goGA').click(function() {                                                
                        $.get( this.href,{},function(json){
                            if( json.succ=='yes' )
                                {
                                    showAlert(json.succMsg);
                                    self.load();
                                    self.contentRefresh();
                                    $(dialog).dialog('close');
                                }
                            else showAlert(json.errors[0].mess,{mtype:'err'});
                        },'json' );

                        return false;
                    });

                    $('a.stopGA').click(function() {

                        $(dialog).dialog('close');

                        return false;
                    });


                });
            
            break;
    <?php } ?>      
            case "none": 
            default:
        }
     
 };
 
 <?php } ?>


<?php if($hasActionNew) { ?>
<?php echo $modelclass; ?>.prototype.addButton = function() {
  
       $(this.settings.jid + " .dataGridAddButton").css('cursor','pointer').click(function(){            
            var url = $(self.settings.jid+ " input[name='dataGridAddNewRecord']").val();
            var dialog = $('<div style="display:hidden"></div>').appendTo('body');

            dialog.load(
                url,
                {},
                function (responseText, textStatus, XMLHttpRequest) {
                    dialog.dialog({
                            title: '<?php echo $formnew->getTitle(); ?>',
                            modal: true,
                            width: 1000,
                            close: function(event, ui) {
                                
               <?php 
               foreach($formnew->getModel()->getModel() as $key=>$child) { 
                if($child->isMixed()) printTestTinyMixedJqueryNew ($child);
                elseif($child->isPrimitive()&&$child instanceof Model_Extended_RichText)
                    echo '$("#'. $formnew->getName().' .tinymce").tinymce().remove()';           
               } 
               ?>  
                                $(this).remove();
                            }
                    });
                    self.bindNewRecordActions();
                });
            return false;

          
       });
    };

<?php echo $modelclass; ?>.prototype.bindNewRecordActions = function() {
         
       $('#<?php echo $formnew->getName(); ?>').pfcAjaxForm({
            onforminit:function(form) {
               <?php 
               foreach($formnew->getModel()->getModel() as $key=>$child) { 
                if($child->isMixed()) printMixedJquery ($child,$formnew);
                elseif($child->isPrimitive()&&!$child->isInnerSql()&&!$child->isPrimaryKey())
                    echo $child->getTemplate('form/new/js','jquery',$formnew);                                                              
               } 
               ?>            
            },
            succ:function(json,form) {
                    $.get( $(self.settings.jid+" input[name='dataGridActionedit']").val(), {
                        id : json.id
                    }, function(data) {
                          showAlert(json.succMsg);
                          self.load();
                          self.contentRefresh();

                          $(".datagridPopupHtml").fadeOut('slow').html( data ).fadeIn('slow');
                          $(".ui-dialog-title").fadeOut('slow').html('<?php echo $formedit->getTitle(); ?>').fadeIn('slow');
                          self.bindeditActions();

                    } );            
            }
       });                             
 };
 

<?php } ?> 
 
 
 } //end js class
 
 

 
 