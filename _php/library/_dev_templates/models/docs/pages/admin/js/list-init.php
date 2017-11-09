


$(function(){


var options = {

    loadParams: {
                <?php if($grid->getModel()->isLangAble()) { ?>lang:$(".<?php echo $grid->getName(); ?>-holder select[name='lang']").val(),<?php } ?>
                <?php if($grid->getModel()->isOwnerIdAble()) { ?>ownerid:$(".<?php echo $grid->getName(); ?>-holder input[name='ownerid']").val(),<?php } ?>
                <?php if($grid->getModel()->isParentIdAble()) { ?>parentid:$(".<?php echo $grid->getName(); ?>-holder input[name='parentid']").val(),<?php } ?>    
                test:'test'
            },
    
    edit_form_id:'<?php echo $formedit->getName(); ?>',
    edit_title:'<?php echo $formedit->getTitle(); ?>',
    edit_onforminit:function(form) {
          <?php if($useTabs) { ?> 
 
            $('#<?php echo $formedit->getName(); ?>-edit-dialog-tabs').uiTabs();
        
          <?php } ?>
      
               <?php 
               foreach($formedit->getModel()->getModel() as $key=>$child) { 
                    if($child->isMixed()) printMixedJquery ($child,$formedit);
                    elseif($child->isPrimitive()&&!$child instanceof Model_Default_Content)
                        echo $child->getTemplate('form/edit/js','jquery',$formedit);                             
               } 
               ?>  
            
                                            <?php if($pcoll = $formedit->getModel()->isPhotoAble()) { ?>

                                                           /*
                                                            * FILE UPLOAD FORM
                                                            */
                                                          $("#<?php echo $formedit->getModel()->getModelName().'_file_'.$pcoll->getCollum(); ?>").pfcFileAdmin({
                                                            succ:function(res){
                                                                $('.<?php echo $formedit->getModel()->getGrid()->getName(); ?>-holder').pfcFilesGridAdmin(options).load();
                                                                if( $("#<?php echo $formedit->getName() ?>-holder .<?php echo $pcoll->getCollum(); ?>-filename").hasClass('test') )
                                                                {
                                                                    $("#<?php echo $formedit->getName() ?>-holder .mainphoto").html($("#<?php echo $formedit->getName() ?>-holder .<?php echo $pcoll->getCollum(); ?>-filename").attr('href'));
                                                                }
                                                                else $("#<?php echo $formedit->getName() ?>-holder .mainphoto").html('---');                                                                
                                                            },
                                                            succdelete:function(){
                                                                $("#<?php echo $formedit->getName() ?>-holder .mainphoto").html('---');
                                                                $('.<?php echo $formedit->getModel()->getGrid()->getName(); ?>-holder').pfcFilesGridAdmin(options).load();
                                                            }
                                                          });

                                       <?php  }   ?>             

                                       <?php if($pcoll = $formedit->getModel()->isFileAble()) { ?>

                                                           /*
                                                            * FILE UPLOAD FORM
                                                            */
                                                          $("#<?php echo $formedit->getModel()->getModelName().'_file_'.$pcoll->getCollum(); ?>").pfcFileAdmin({
                                                            succ:function(res){
                                                                $('.<?php echo $formedit->getModel()->getGrid()->getName(); ?>-holder').pfcFilesGridAdmin(options).load();
                                                                if( $("#<?php echo $formedit->getName() ?>-holder .<?php echo $pcoll->getCollum(); ?>-filename").hasClass('test') )
                                                                {
                                                                    $("#<?php echo $formedit->getName() ?>-holder .mainfile").html($("#<?php echo $formedit->getName() ?>-holder .<?php echo $pcoll->getCollum(); ?>-filename").attr('href'));
                                                                }
                                                                else $("#<?php echo $formedit->getName() ?>-holder .mainfile").html('---');
                                                            },
                                                            succdelete:function(){
                                                                $("#<?php echo $formedit->getName() ?>-holder .mainfile").html('---');
                                                                $('.<?php echo $formedit->getModel()->getGrid()->getName(); ?>-holder').pfcFilesGridAdmin(options).load();
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
                                                            succ:function(res){
                                                                $('.<?php echo $formedit->getModel()->getGrid()->getName(); ?>-holder').pfcFilesGridAdmin().load();                                                                
                                                            },
                                                            succdelete:function() {
                                                                $('.<?php echo $formedit->getModel()->getGrid()->getName(); ?>-holder').pfcFilesGridAdmin().load();
                                                            }
                                                          });                          

                                       <?php }} ?> 


                                       <?php if($content = $formedit->getModel()->isContentAble()) { ?>
                                                           /**
                                                            *  CONTENT TAB FORM
                                                            */
                                       $('#<?php echo $formedit->getName(); ?>-contentForm').pfcAjaxForm({
                                            onforminit:function(form) {
                                               <?php 
                                                   echo $content->getTemplate('form/edit/js','jquery',$formedit,array('width'=>900,'height'=>600));                             
                                               ?>                         
                                            },
                                            succ: function(json,form) {
                                                showAlert(json.succMsg);
                                                $('.<?php echo $formedit->getModel()->getGrid()->getName(); ?>-holder').pfcFilesGridAdmin(options).load();                
                                            }
                                       }); //end form

                                       <?php } ?>                                               

                                       <?php if($formedit->getModel()->isGalleryAble()) { ?>

                                                           /*
                                                            * DOCS GALLERY TAB
                                                            */
                                                          // gallerypageadmin();

                                       <?php  }   ?>                            

                                       <?php if($formedit->getModel()->isDocsAble()) { ?>

                                                           /*
                                                            * DOCS DOCS TAB
                                                            */
                                                          // docspageadmin();

                                       <?php  }   ?>                                     

            
    },//end edit forminit
    
    
}; //end options

 $('.<?php echo $grid->getName(); ?>-holder').pfcFilesGridAdmin(options).init(); 


    
})



 