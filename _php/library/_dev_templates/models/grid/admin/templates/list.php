
<?php 

$ownerId = $grid->getModel()->isOwnerIdAble();
$parentId = $grid->getModel()->isParentIdAble();
$rank = $grid->getModel()->isRankAble();
$active = $grid->getModel()->isActiveAble();
$photo = $grid->getModel()->isPhotoAble();
$file = $grid->getModel()->isFileAble();
$h1 = $grid->getModel()->isH1Able();
$uri = $grid->getModel()->isUriAble();
$date = $grid->getModel()->isDateAble();
$perex = $grid->getModel()->isPerexAble();
$content = $grid->getModel()->isContentAble();
$created = $grid->getModel()->isCreatedAble();
$lastupdate = $grid->getModel()->isLastupdateAble();

?>


    
[[ if($showcount) { ]]
 <div>
  <b>Celkem záznamů:</b> [[ echo $<?php echo $grid->getName(); ?>_count ]]
 </div>
[[ } ]]

 [[ if( $<?php echo $grid->getName(); ?>_count > 0 ) { ]]

         [[ if($showPreviosPaging)  { ]]
        <div class="paging-previos-holder" style="margin-top: 18px;">
            <a class="button-link" href="[[ echo App::getIns()->setAjaxLink('_curr','<?php echo $grid->getName(); ?>-list',$<?php echo $grid->getName(); ?>_previos_params); ]]">Načíst předchozích [[ echo $<?php echo $grid->getName(); ?>_per_page; ]]</a>
        </div>   <!-- paging-holder  -->       
        [[ } ]]
 
 
        <div class="grid-admin-list">        
     
            
        [[ foreach( $<?php echo $grid->getName();  ?>_data as $key => $<?php echo $grid->getModel()->getModelName();  ?> ) { ]]
        
                        
            <div class="grid-list-item" id='<?php echo $grid->getName(); ?>_gridadminlistitem_[[ echo $<?php echo $grid->getModel()->getModelName();  ?>->getPrimaryKey()->getViewValue(); ]]'>
              <?php if($photo||$file) { ?>  
                               
                <?php if($photo) { ?>                   
                [[ if( $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $photo->getCollum(); ?>')->getValue()!='' ) { ]]
                 <div class="item-photo-holder"> 
                    <div class="item-photo">                        
                        <a href="[[ echo Project::$WEB_URL . '/' . $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $photo->getCollum(); ?>')->getDir(). '/' . $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $photo->getCollum(); ?>')->getValue() ]]" target="_blank">   
                           <img src="[[ echo Project::$WEB_URL . Magick_Factory::thumb('/'. $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $photo->getCollum(); ?>')->getFullPath(),180,180); ]]" alt="[[ echo strip_tags($<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $h1->getCollum(); ?>')->getViewValue()); ]]">                         
                        </a>   
                    </div>    
                <?php } elseif($file) { ?>
                [[ if( $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $file->getCollum(); ?>')->getValue()!='' ) { ]]    
                 <div class="item-photo-holder"> 
                    <div class="item-photo">
                     <a href="[[ echo Project::$WEB_URL . '/' . $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $file->getCollum(); ?>')->getDir(). '/' . $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $file->getCollum(); ?>')->getValue() ]]" target="_blank">   
                       [[ if( $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $file->getCollum(); ?>')->isImage() ) { ]]     
                        <img src="[[ echo Project::$WEB_URL . Magick_Factory::thumb('/'. $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $file->getCollum(); ?>')->getFullPath(),180,180); ]]" alt="[[ echo strip_tags($<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $h1->getCollum(); ?>')->getViewValue()); ]]"> 
                       [[ } else {  ]] 
                        <h2>[[ echo $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $file->getCollum(); ?>')->getExt() ]]</h2>                                                        
                       [[ }  ]] 
                     </a>  
                    </div>                        
                <?php } //end if file ?>    
                
                    <div class="item-body">
                        <?php if($h1) { ?>
                        <h4>[[ echo $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $h1->getCollum(); ?>')->getViewValue(); ]]</h4>
                        <?php } ?>
                        <?php if($active) { ?>
                        <div>
                            <b class="[[ echo  $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $active->getCollum(); ?>')->getValue() ? 'active':'neactive' ]]">
                                [[ echo  $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $active->getCollum(); ?>')->getValue() ? 'Aktivní':'Neaktivní' ]]
                            </b>
                        </div>
                        <?php } ?>
                        <div class="defdate-holder">
                            <?php if($date) { ?><div class="defdate">
                                <span class="defdatetitle">[[ echo  $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $date->getCollum(); ?>')->getTitle() ]]:</span>
                                <span class="defdatebody">[[ echo  $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $date->getCollum(); ?>')->getViewValue() ]]</span>
                            </div><?php } ?>
                        </div>
                        <?php if($lastupdate||$created) { ?><div class="datedefaults"><?php } ?>
                        <?php if($lastupdate) { ?><div class="lastupdate">
                            <span class="defdatetitle">[[ echo  $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $lastupdate->getCollum(); ?>')->getTitle() ]]:</span>
                            <span class="defdatebody">[[ echo  $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $lastupdate->getCollum(); ?>')->getViewValue() ]]
                                            </div><?php } ?>
                        <?php if($created) { ?><div class="created">
                            <span class="defdatetitle">[[ echo  $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $created->getCollum(); ?>')->getTitle() ]]:</span>
                            <span class="defdatebody">[[ echo  $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $created->getCollum(); ?>')->getViewValue() ]]</span>
                        </div><?php } ?>
                        <?php if($lastupdate||$created) { ?></div><?php } ?>
                        
                        <?php if($perex) { ?>
                        <p>[[ echo  $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $perex->getCollum(); ?>')->getViewValue() ]]</p>
                        <?php } elseif($content) { ?>
                        <p>[[ echo  perex($<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $content->getCollum(); ?>')->getViewValue()) ]]</p>
                        <?php } ?>
                        
                        <?php if($file) { ?>
                        <div class="filename"><b>Soubor: </b>[[ echo $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $file->getCollum(); ?>')->getValue()!='' ? '<a href="'.Project::$WEB_URL . '/' . $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $file->getCollum(); ?>')->getDir(). '/' . $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $file->getCollum(); ?>')->getValue().'" target="_blank">'.$<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $file->getCollum(); ?>')->getValue().'</a>' : '---'; ]]</div>
                        <?php } ?>

                        <?php if($photo) { ?>
                        <div class="filename"><b>Obrázek: </b>[[ echo $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $photo->getCollum(); ?>')->getValue()!='' ?  '<a target="_blank" href="'.Project::$WEB_URL . '/' . $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $photo->getCollum(); ?>')->getDir(). '/' . $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $photo->getCollum(); ?>')->getValue().'">'.$<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $photo->getCollum(); ?>')->getValue().'</a>' : '---'; ]]</div>
                        <?php } ?>
                        
                        
                    <div class='grid-admin-item-actions'>    
                        <a class="button-link action-edit" href="[[ echo App::getIns()->setAjaxLink('_curr','<?php echo $grid->getName(); ?>-edit',array('id'=>$<?php echo $grid->getModel()->getModelName();  ?>->getPrimaryKey()->getViewValue())); ]]">upravit</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;                        
                        <a class="button-link action-delete" href="[[ echo App::getIns()->setActionLink('_curr','<?php echo $grid->getName(); ?>-delete',array('id'=>$<?php echo $grid->getModel()->getModelName();  ?>->getPrimaryKey()->getViewValue())); ]]">smazat</a>
                    </div>    
                    </div>    
                </div>
                
                [[ } else { ]]
              <?php } //is photoable ?>
                <div class="no-photo-item-holder">
                        <?php if($h1) { ?>
                        <h4>[[ echo $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $h1->getCollum(); ?>')->getViewValue(); ]]</h4>
                        <?php } ?>
                        <?php if($active) { ?>
                        <div>
                            <b class="[[ echo  $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $active->getCollum(); ?>')->getValue() ? 'active':'neactive' ]]">
                                [[ echo  $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $active->getCollum(); ?>')->getValue() ? 'Aktivní':'Neaktivní' ]]
                            </b>
                        </div>
                        <?php } ?>                        
                        <div class="defdate-holder">
                            <?php if($date) { ?><div class="defdate">
                                <span class="defdatetitle">[[ echo  $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $date->getCollum(); ?>')->getTitle() ]]:</span>
                                <span class="defdatebody">[[ echo  $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $date->getCollum(); ?>')->getViewValue() ]]</span>
                            </div><?php } ?>
                        </div>
                        <?php if($lastupdate||$created) { ?><div class="datedefaults"><?php } ?>
                        <?php if($lastupdate) { ?><span class="lastupdate">
                            <span class="defdatetitle">[[ echo  $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $lastupdate->getCollum(); ?>')->getTitle() ]]:</span>
                            <span class="defdatebody">[[ echo  $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $lastupdate->getCollum(); ?>')->getViewValue() ]]
                                            </span><?php } ?>
                        <?php if($created) { ?><span class="created">
                            <span class="defdatetitle">[[ echo  $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $created->getCollum(); ?>')->getTitle() ]]:</span>
                            <span class="defdatebody">[[ echo  $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $created->getCollum(); ?>')->getViewValue() ]]</span>
                        </span><?php } ?>
                        <?php if($lastupdate||$created) { ?></div><?php } ?>
                        
                        <?php if($perex) { ?>
                        <p>[[ echo  $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $perex->getCollum(); ?>')->getViewValue() ]]</p>
                        <?php } elseif($content) { ?>
                        <p>[[ echo  perex($<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $content->getCollum(); ?>')->getViewValue()) ]]</p>
                        <?php } ?>
                    <div class='grid-admin-item-actions'>        
                        <a class="button-link action-edit" href="[[ echo App::getIns()->setAjaxLink('_curr','<?php echo $grid->getName(); ?>-edit',array('id'=>$<?php echo $grid->getModel()->getModelName();  ?>->getPrimaryKey()->getViewValue())); ]]">upravit</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="button-link action-delete" href="[[ echo App::getIns()->setActionLink('_curr','<?php echo $grid->getName(); ?>-delete',array('id'=>$<?php echo $grid->getModel()->getModelName();  ?>->getPrimaryKey()->getViewValue())); ]]">smazat</a>
                    </div>    
                </div>
              <?php if($photo||$file) { ?>  
                
                [[ } ]]
              <?php } ?>  
           </div> <!-- grid-list-item  -->
        
        [[ } //endforeach ]]        
        </div>  <!-- grid-admin-list  -->
        
        [[ if($showpaging)  { ]]
        <div class="paging-holder">
            <a class="button-link" href="[[ echo App::getIns()->setAjaxLink('_curr','<?php echo $grid->getName(); ?>-list',$<?php echo $grid->getName(); ?>_params); ]]">Načíst dalších [[ echo $<?php echo $grid->getName(); ?>_per_page; ]]</a>
        </div>   <!-- paging-holder  -->       
        [[ } ]]

 [[ } else { ]]
 <br><br>
 Tato sekce je zatím prázdná.
 
 [[ } ]]
        
        