<?php

    $owner = new $_GET['model']();    
    
    $cc = array();
    if(isset($_GET['gallery'])) $cc []= $owner->isGalleryAble();
    if(isset($_GET['docs'])) $cc []= $owner->isDocsAble();

    foreach( $cc as $component)  
      if($component)
      {
        $class = $component->getGridClassName();
        $grid = new $class();

        $useTabs = false; 
    
        $modelModelClass = $grid->getModelClassName();
        $modelModel = new $modelModelClass();
       
        $formnewclass = str_replace('_Model', '_Form_New', $modelModelClass);
        $formeditclass = str_replace('_Model', '_Form_Edit', $modelModelClass);
        
        $formnew =  new $formnewclass();   
        $formedit =  new $formeditclass();

            if($formedit->getModel()->isContentAble()||$formedit->getModel()->isGalleryAble()||$formedit->getModel()->isDocsAble())
                $useTabs = true;

        $dir="_dev_templates/models/docs/pages/admin/";   
                    ob_start();
                    require $dir.'templates/holder.php';
                    $code = ob_get_contents();
                    ob_end_clean();

                    $_new = new stdClass();
                    $_new->name = 'admin/templates/'.$grid->getName().'.holder'; 
                    $_new->lang = 'php';
                    $_new->code = Model_TemplateFactory::translatePHP($code);
                    $_files []= $_new;           
        
               
                    ob_start();
                    require $dir.'action/add.php';
                    $code = ob_get_contents();
                    ob_end_clean();

                    $_new = new stdClass();
                    $_new->name = 'admin/action/'.$grid->getName().'-add'; 
                    $_new->lang = 'php';
                    $_new->code = Model_TemplateFactory::translatePHP($code);
                    $_files []= $_new;                               

                    ob_start();
                    require $dir.'js/list-init.php';
                    $code = ob_get_contents();
                    ob_end_clean();

                    $_new = new stdClass();
                    $_new->name = 'admin/js/'.$grid->getName().'-list-init'; 
                    $_new->lang = 'js';
                    $_new->code = Model_TemplateFactory::translatePHP($code);
                    $_files []= $_new;                         
            
        foreach(array('ajax','action','css','templates')as$type)
        {
          $dir="_dev_templates/models/grid/admin/{$type}";   
          if($type=='ajax'||$type=='action'||$type=='css'||$type=='js')
          {             
             foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir) as $pfile )
             {
                if($pfile=='add.php'&&($type=='action'||$type=='ajax'))
                continue;                     
                                                                 
                 
                if($pfile=='edit-content.php'&&$type=='action'&&!$formedit->getModel()->isContentAble())
                continue;    
                                  
                $expl = explode('.',$pfile->getFilename());
                if(end($expl)=='php')
                {
                    ob_start();
                    require $dir.'/'.$pfile->getFilename();
                    $code = ob_get_contents();
                    ob_end_clean();

                    $_new = new stdClass();
                    $_new->name = 'admin/'.$type.'/'.$grid->getName().'-'.preg_replace('/(\.php)$/', '', $pfile->getFilename()); 
                    $_new->lang = ($type=='ajax'||$type=='action')?'php':($type=='js'?'js':'css');
                    $_new->code = Model_TemplateFactory::translatePHP($code);
                    $_files []= $_new;                                                      
                }
             }
          }
          elseif($type=="templates") 
          {
             foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir) as $pfile )
             {
                if($pfile=='holder.php'&&$type=='templates')
                continue;        
                 
                $expl = explode('.',$pfile->getFilename());
                if(end($expl)=='php')
                {
                    ob_start();
                    require $dir.'/'.$pfile->getFilename();
                    $code = ob_get_contents();
                    ob_end_clean();

                    $_new = new stdClass();
                    $_new->name = 'admin/'.$type.'/'.$grid->getName().'.'.preg_replace('/(\.php)$/', '', $pfile->getFilename()); 
                    $_new->lang = 'php';
                    $_new->code = Model_TemplateFactory::translatePHP($code);
                    $_files []= $_new;                                                      
                }
             }                                                                                        
          }
        } //endforeach  
        
        
        
      if($formedit->getModel()->isFileAble())
      {
              $modelclass = $formedit->getModel()->getGrid()->getModelClassName();
              
              $file_coll = $formedit->getModel()->isFileAble();
              
              $collum = $file_coll->getCollum();
  
              $model = new $modelclass();
  
              $dir= "_dev_templates/models/form/file";  
    
                                     foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir.'/action') as $file )
                                     {
                                        $expl = explode('.',$file->getFilename());
                                        if(end($expl)=='php')
                                        {
                                    ob_start();
                                    require $dir.'/action/'.$file->getFilename();
                                    $code = ob_get_contents();
                                    ob_end_clean();

                                    $_new = new stdClass();
                                    $_new->name = 'dt/action/'.$model->getModelName().'-'.$collum.'-'.$file->getFilename(); 
                                    $_new->lang = 'php';
                                    $_new->code = Model_TemplateFactory::translatePHP($code);
                                    $_files []= $_new;                                                      
                                        }
                                     }
    
                                     foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir.'/ajax') as $file )
                                     {
                                        $expl = explode('.',$file->getFilename());
                                        if(end($expl)=='php')
                                        {
                                    ob_start();
                                    require $dir.'/ajax/'.$file->getFilename();
                                    $code = ob_get_contents();
                                    ob_end_clean();

                                    $_new = new stdClass();
                                    $_new->name = 'dt/ajax/'.$model->getModelName().'-'.$collum.'-'.$file->getFilename(); 
                                    $_new->lang = 'php';
                                    $_new->code = Model_TemplateFactory::translatePHP($code);
                                    $_files []= $_new;                                                      
                                        }
                                     }

                                     foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir.'/templates') as $file )
                                     {
                                        $expl = explode('.',$file->getFilename());
                                        if(end($expl)=='php')
                                        {
                                    ob_start();
                                    require $dir.'/templates/'.$file->getFilename();
                                    $code = ob_get_contents();
                                    ob_end_clean();

                                    $_new = new stdClass();
                                    $_new->name = 'dt/templates/form.'.$model->getModelName().'.'.$collum.'.'.preg_replace('/(.php)$/', '',$file->getFilename()); 
                                    $_new->lang = 'php';
                                    $_new->code = Model_TemplateFactory::translatePHP($code);
                                    $_files []= $_new;                                                      
                                        }
                                     }
                                     
                                   foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir.'/js') as $file )
                                     {
                                        $expl = explode('.',$file->getFilename());
                                        if(end($expl)=='php')
                                        {
                                    ob_start();
                                    require $dir.'/js/'.$file->getFilename();
                                    $code = ob_get_contents();
                                    ob_end_clean();

                                    $_new = new stdClass();
                                    $_new->name = 'dt/js/'.$model->getModelName().'.'.$collum.'.'.preg_replace('/(.php)$/', '',$file->getFilename()); 
                                    $_new->lang = 'js';
                                    $_new->code = Model_TemplateFactory::translatePHP($code);
                                    $_files []= $_new;                                                      
                                        }
                                     }
                                     
                                     foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir.'/css') as $file )
                                     {
                                        $expl = explode('.',$file->getFilename());
                                        if(end($expl)=='php')
                                        {
                                    ob_start();
                                    require $dir.'/css/'.$file->getFilename();
                                    $code = ob_get_contents();
                                    ob_end_clean();

                                    $_new = new stdClass();
                                    $_new->name = 'dt/css/'.$model->getModelName().'.'.$collum.'.'.preg_replace('/(.php)$/', '',$file->getFilename()); 
                                    $_new->lang = 'css';
                                    $_new->code = Model_TemplateFactory::translatePHP($code);
                                    $_files []= $_new;                                                      
                                        }
                                     }
                                                                                                      
      }   //end photo,file 

     if($formedit->getModel()->isPhotoAble())
      {
              $modelclass = $formedit->getModel()->getGrid()->getModelClassName();
              
        
              $photo_coll = $formedit->getModel()->isPhotoAble();
              
              $collum = $photo_coll->getCollum();
  
              $model = new $modelclass();
  
              $dir= "_dev_templates/models/form/file";  
    
                                     foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir.'/action') as $file )
                                     {
                                        $expl = explode('.',$file->getFilename());
                                        if(end($expl)=='php')
                                        {
                                    ob_start();
                                    require $dir.'/action/'.$file->getFilename();
                                    $code = ob_get_contents();
                                    ob_end_clean();

                                    $_new = new stdClass();
                                    $_new->name = 'dt/action/'.$model->getModelName().'-'.$collum.'-'.$file->getFilename(); 
                                    $_new->lang = 'php';
                                    $_new->code = Model_TemplateFactory::translatePHP($code);
                                    $_files []= $_new;                                                      
                                        }
                                     }
    
                                     foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir.'/ajax') as $file )
                                     {
                                        $expl = explode('.',$file->getFilename());
                                        if(end($expl)=='php')
                                        {
                                    ob_start();
                                    require $dir.'/ajax/'.$file->getFilename();
                                    $code = ob_get_contents();
                                    ob_end_clean();

                                    $_new = new stdClass();
                                    $_new->name = 'dt/ajax/'.$model->getModelName().'-'.$collum.'-'.$file->getFilename(); 
                                    $_new->lang = 'php';
                                    $_new->code = Model_TemplateFactory::translatePHP($code);
                                    $_files []= $_new;                                                      
                                        }
                                     }

                                     foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir.'/templates') as $file )
                                     {
                                        $expl = explode('.',$file->getFilename());
                                        if(end($expl)=='php')
                                        {
                                    ob_start();
                                    require $dir.'/templates/'.$file->getFilename();
                                    $code = ob_get_contents();
                                    ob_end_clean();

                                    $_new = new stdClass();
                                    $_new->name = 'dt/templates/form.'.$model->getModelName().'.'.$collum.'.'.preg_replace('/(.php)$/', '',$file->getFilename()); 
                                    $_new->lang = 'php';
                                    $_new->code = Model_TemplateFactory::translatePHP($code);
                                    $_files []= $_new;                                                      
                                        }
                                     }
                                    
                                   foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir.'/js') as $file )
                                     {
                                        $expl = explode('.',$file->getFilename());
                                        if(end($expl)=='php')
                                        {
                                    ob_start();
                                    require $dir.'/js/'.$file->getFilename();
                                    $code = ob_get_contents();
                                    ob_end_clean();

                                    $_new = new stdClass();
                                    $_new->name = 'dt/js/'.$model->getModelName().'.'.$collum.'.'.preg_replace('/(.php)$/', '',$file->getFilename()); 
                                    $_new->lang = 'js';
                                    $_new->code = Model_TemplateFactory::translatePHP($code);
                                    $_files []= $_new;                                                      
                                        }
                                     }
                                     
                                     foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir.'/css') as $file )
                                     {
                                        $expl = explode('.',$file->getFilename());
                                        if(end($expl)=='php')
                                        {
                                    ob_start();
                                    require $dir.'/css/'.$file->getFilename();
                                    $code = ob_get_contents();
                                    ob_end_clean();

                                    $_new = new stdClass();
                                    $_new->name = 'dt/css/'.$model->getModelName().'.'.$collum.'.'.preg_replace('/(.php)$/', '',$file->getFilename()); 
                                    $_new->lang = 'css';
                                    $_new->code = Model_TemplateFactory::translatePHP($code);
                                    $_files []= $_new;                                                      
                                        }
                                     }
                                                                                                      
      }   //end photo      
      
      foreach($formedit->getModel()->getCollumsInArray()as$cname=>$val)
      if( $formedit->getModel()->get($cname) instanceof Model_Extended_File && !$formedit->getModel()->get($cname)->isDefault())
      {
              $modelclass = $formedit->getModel()->getGrid()->getModelClassName();
              
              $collum = $formedit->getModel()->get($cname)->getCollum();
  
              $model = new $modelclass();
  
              $dir= "_dev_templates/models/form/file";  
    
                                     foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir.'/action') as $file )
                                     {
                                        $expl = explode('.',$file->getFilename());
                                        if(end($expl)=='php')
                                        {
                                    ob_start();
                                    require $dir.'/action/'.$file->getFilename();
                                    $code = ob_get_contents();
                                    ob_end_clean();

                                    $_new = new stdClass();
                                    $_new->name = 'dt/action/'.$model->getModelName().'-'.$collum.'-'.$file->getFilename(); 
                                    $_new->lang = 'php';
                                    $_new->code = Model_TemplateFactory::translatePHP($code);
                                    $_files []= $_new;                                                      
                                        }
                                     }
    
                                     foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir.'/ajax') as $file )
                                     {
                                        $expl = explode('.',$file->getFilename());
                                        if(end($expl)=='php')
                                        {
                                    ob_start();
                                    require $dir.'/ajax/'.$file->getFilename();
                                    $code = ob_get_contents();
                                    ob_end_clean();

                                    $_new = new stdClass();
                                    $_new->name = 'dt/ajax/'.$model->getModelName().'-'.$collum.'-'.$file->getFilename(); 
                                    $_new->lang = 'php';
                                    $_new->code = Model_TemplateFactory::translatePHP($code);
                                    $_files []= $_new;                                                      
                                        }
                                     }

                                     foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir.'/templates') as $file )
                                     {
                                        $expl = explode('.',$file->getFilename());
                                        if(end($expl)=='php')
                                        {
                                    ob_start();
                                    require $dir.'/templates/'.$file->getFilename();
                                    $code = ob_get_contents();
                                    ob_end_clean();

                                    $_new = new stdClass();
                                    $_new->name = 'dt/templates/form.'.$model->getModelName().'.'.$collum.'.'.preg_replace('/(.php)$/', '',$file->getFilename()); 
                                    $_new->lang = 'php';
                                    $_new->code = Model_TemplateFactory::translatePHP($code);
                                    $_files []= $_new;                                                      
                                        }
                                     }
                                     
                                   foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir.'/js') as $file )
                                     {
                                        $expl = explode('.',$file->getFilename());
                                        if(end($expl)=='php')
                                        {
                                    ob_start();
                                    require $dir.'/js/'.$file->getFilename();
                                    $code = ob_get_contents();
                                    ob_end_clean();

                                    $_new = new stdClass();
                                    $_new->name = 'dt/js/'.$model->getModelName().'.'.$collum.'.'.preg_replace('/(.php)$/', '',$file->getFilename()); 
                                    $_new->lang = 'js';
                                    $_new->code = Model_TemplateFactory::translatePHP($code);
                                    $_files []= $_new;                                                      
                                        }
                                     }
                                     
                                     foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir.'/css') as $file )
                                     {
                                        $expl = explode('.',$file->getFilename());
                                        if(end($expl)=='php')
                                        {
                                    ob_start();
                                    require $dir.'/css/'.$file->getFilename();
                                    $code = ob_get_contents();
                                    ob_end_clean();

                                    $_new = new stdClass();
                                    $_new->name = 'dt/css/'.$model->getModelName().'.'.$collum.'.'.preg_replace('/(.php)$/', '',$file->getFilename()); 
                                    $_new->lang = 'css';
                                    $_new->code = Model_TemplateFactory::translatePHP($code);
                                    $_files []= $_new;                                                      
                                        }
                                     }
                                                                                                      
      }   //end model files 

        
        
          
          
      } //end docs
      
              
    
    echo json_encode(array('generator'=>'component_datatable','files'=>$_files));
    

