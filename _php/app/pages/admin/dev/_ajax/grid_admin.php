<?php

$_files = array();
$class = $_GET['class'];
$grid = new $class();

if($grid instanceof Model_Grid)
{ 
   $useTabs = isset($_GET['useTabs']) ? true : false; 
    
   $modelModelClass = $_GET['modelModelClass'];
   if($modelModelClass) 
   {       
       $modelModel = new $modelModelClass();
   }
       
   $formnew =  new $_GET['formnew']();   
   $formedit =  new $_GET['formedit']();

   if($formedit->getModel()->isContentAble()||$formedit->getModel()->isGalleryAble()||$formedit->getModel()->isDocsAble())
           $useTabs = true;
   
       
    
    if(isset($_GET['use-admin']))
    {
        foreach($_GET['admin']as$key=>$type)
        {
          $dir="_dev_templates/models/grid/admin/{$type}";   
          if($type=='ajax'||$type=='action'||$type=='css'||$type=='js')
          {             
             foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir) as $pfile )
             {
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
                                                                                                    
        } //end foreach
        
        
      if($formedit->getModel()->isFileAble())
      {
              $modelclass = $_GET['modelModelClass'];
              
              $file_coll = $formedit->getModel()->isFileAble();
              
              $collum = $file_coll->getCollum();
  
              $model = new $modelclass();
  
              $dir= "_dev_templates/models/form/file";  
    
                                     foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir.'/action') as $pfile )
                                     {
                                        $expl = explode('.',$pfile->getFilename());
                                        if(end($expl)=='php')
                                        {
                                    ob_start();
                                    require $dir.'/action/'.$pfile->getFilename();
                                    $code = ob_get_contents();
                                    ob_end_clean();

                                    $_new = new stdClass();
                                    $_new->name = 'dt/action/'.$model->getModelName().'-'.$collum.'-'.$pfile->getFilename(); 
                                    $_new->lang = 'php';
                                    $_new->code = Model_TemplateFactory::translatePHP($code);
                                    $_files []= $_new;                                                      
                                        }
                                     }
    
                                     foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir.'/ajax') as $pfile )
                                     {
                                        $expl = explode('.',$pfile->getFilename());
                                        if(end($expl)=='php')
                                        {
                                    ob_start();
                                    require $dir.'/ajax/'.$pfile->getFilename();
                                    $code = ob_get_contents();
                                    ob_end_clean();

                                    $_new = new stdClass();
                                    $_new->name = 'dt/ajax/'.$model->getModelName().'-'.$collum.'-'.$pfile->getFilename(); 
                                    $_new->lang = 'php';
                                    $_new->code = Model_TemplateFactory::translatePHP($code);
                                    $_files []= $_new;                                                      
                                        }
                                     }

                                     foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir.'/templates') as $pfile )
                                     {
                                        $expl = explode('.',$pfile->getFilename());
                                        if(end($expl)=='php')
                                        {
                                    ob_start();
                                    require $dir.'/templates/'.$pfile->getFilename();
                                    $code = ob_get_contents();
                                    ob_end_clean();

                                    $_new = new stdClass();
                                    $_new->name = 'dt/templates/form.'.$model->getModelName().'.'.$collum.'.'.preg_replace('/(.php)$/', '',$pfile->getFilename()); 
                                    $_new->lang = 'php';
                                    $_new->code = Model_TemplateFactory::translatePHP($code);
                                    $_files []= $_new;                                                      
                                        }
                                     }
                                   /*  
                                   foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir.'/js') as $file )
                                     {
                                        $expl = explode('.',$pfile->getFilename());
                                        if(end($expl)=='php')
                                        {
                                    ob_start();
                                    require $dir.'/js/'.$pfile->getFilename();
                                    $code = ob_get_contents();
                                    ob_end_clean();

                                    $_new = new stdClass();
                                    $_new->name = 'dt/js/'.$model->getModelName().'.'.$collum.'.'.preg_replace('/(.php)$/', '',$pfile->getFilename()); 
                                    $_new->lang = 'js';
                                    $_new->code = Model_TemplateFactory::translatePHP($code);
                                    $_files []= $_new;                                                      
                                        }
                                     }
                                     */
                                     foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir.'/css') as $pfile )
                                     {
                                        $expl = explode('.',$pfile->getFilename());
                                        if(end($expl)=='php')
                                        {
                                    ob_start();
                                    require $dir.'/css/'.$pfile->getFilename();
                                    $code = ob_get_contents();
                                    ob_end_clean();

                                    $_new = new stdClass();
                                    $_new->name = 'dt/css/'.$model->getModelName().'.'.$collum.'.'.preg_replace('/(.php)$/', '',$pfile->getFilename()); 
                                    $_new->lang = 'css';
                                    $_new->code = Model_TemplateFactory::translatePHP($code);
                                    $_files []= $_new;                                                      
                                        }
                                     }
                                                                                                      
      }   //end photo,file 

     if($formedit->getModel()->isPhotoAble())
      {
              $modelclass = $_GET['modelModelClass'];
              
        
              $photo_coll = $formedit->getModel()->isPhotoAble();
              
              $collum = $photo_coll->getCollum();
  
              $model = new $modelclass();
  
              $dir= "_dev_templates/models/form/file";  
    
                                     foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir.'/action') as $pfile )
                                     {
                                        $expl = explode('.',$pfile->getFilename());
                                        if(end($expl)=='php')
                                        {
                                    ob_start();
                                    require $dir.'/action/'.$pfile->getFilename();
                                    $code = ob_get_contents();
                                    ob_end_clean();

                                    $_new = new stdClass();
                                    $_new->name = 'dt/action/'.$model->getModelName().'-'.$collum.'-'.$pfile->getFilename(); 
                                    $_new->lang = 'php';
                                    $_new->code = Model_TemplateFactory::translatePHP($code);
                                    $_files []= $_new;                                                      
                                        }
                                     }
    
                                     foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir.'/ajax') as $pfile )
                                     {
                                        $expl = explode('.',$pfile->getFilename());
                                        if(end($expl)=='php')
                                        {
                                    ob_start();
                                    require $dir.'/ajax/'.$pfile->getFilename();
                                    $code = ob_get_contents();
                                    ob_end_clean();

                                    $_new = new stdClass();
                                    $_new->name = 'dt/ajax/'.$model->getModelName().'-'.$collum.'-'.$pfile->getFilename(); 
                                    $_new->lang = 'php';
                                    $_new->code = Model_TemplateFactory::translatePHP($code);
                                    $_files []= $_new;                                                      
                                        }
                                     }

                                     foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir.'/templates') as $pfile )
                                     {
                                        $expl = explode('.',$pfile->getFilename());
                                        if(end($expl)=='php')
                                        {
                                    ob_start();
                                    require $dir.'/templates/'.$pfile->getFilename();
                                    $code = ob_get_contents();
                                    ob_end_clean();

                                    $_new = new stdClass();
                                    $_new->name = 'dt/templates/form.'.$model->getModelName().'.'.$collum.'.'.preg_replace('/(.php)$/', '',$pfile->getFilename()); 
                                    $_new->lang = 'php';
                                    $_new->code = Model_TemplateFactory::translatePHP($code);
                                    $_files []= $_new;                                                      
                                        }
                                     }
                                   /*  
                                   foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir.'/js') as $file )
                                     {
                                        $expl = explode('.',$pfile->getFilename());
                                        if(end($expl)=='php')
                                        {
                                    ob_start();
                                    require $dir.'/js/'.$pfile->getFilename();
                                    $code = ob_get_contents();
                                    ob_end_clean();

                                    $_new = new stdClass();
                                    $_new->name = 'dt/js/'.$model->getModelName().'.'.$collum.'.'.preg_replace('/(.php)$/', '',$pfile->getFilename()); 
                                    $_new->lang = 'js';
                                    $_new->code = Model_TemplateFactory::translatePHP($code);
                                    $_files []= $_new;                                                      
                                        }
                                     }
                                     */
                                     foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir.'/css') as $pfile )
                                     {
                                        $expl = explode('.',$pfile->getFilename());
                                        if(end($expl)=='php')
                                        {
                                    ob_start();
                                    require $dir.'/css/'.$pfile->getFilename();
                                    $code = ob_get_contents();
                                    ob_end_clean();

                                    $_new = new stdClass();
                                    $_new->name = 'dt/css/'.$model->getModelName().'.'.$collum.'.'.preg_replace('/(.php)$/', '',$pfile->getFilename()); 
                                    $_new->lang = 'css';
                                    $_new->code = Model_TemplateFactory::translatePHP($code);
                                    $_files []= $_new;                                                      
                                        }
                                     }
                                                                                                      
      }   //end photo      
      
      foreach($formedit->getModel()->getCollumsInArray()as$cname=>$ccoll)
      if($formedit->getModel()->get($cname) instanceof Model_Extended_File && !$formedit->getModel()->get($cname)->isDefault())
      {
              $modelclass = $_GET['modelModelClass'];
              
              $collum = $formedit->getModel()->get($cname)->getCollum();
  
              $model = new $modelclass();
  
              $dir= "_dev_templates/models/form/file";  
    
                                     foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir.'/action') as $pfile )
                                     {
                                        $expl = explode('.',$pfile->getFilename());
                                        if(end($expl)=='php')
                                        {
                                    ob_start();
                                    require $dir.'/action/'.$pfile->getFilename();
                                    $code = ob_get_contents();
                                    ob_end_clean();

                                    $_new = new stdClass();
                                    $_new->name = 'dt/action/'.$model->getModelName().'-'.$collum.'-'.$pfile->getFilename(); 
                                    $_new->lang = 'php';
                                    $_new->code = Model_TemplateFactory::translatePHP($code);
                                    $_files []= $_new;                                                      
                                        }
                                     }
    
                                     foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir.'/ajax') as $pfile )
                                     {
                                        $expl = explode('.',$pfile->getFilename());
                                        if(end($expl)=='php')
                                        {
                                    ob_start();
                                    require $dir.'/ajax/'.$pfile->getFilename();
                                    $code = ob_get_contents();
                                    ob_end_clean();

                                    $_new = new stdClass();
                                    $_new->name = 'dt/ajax/'.$model->getModelName().'-'.$collum.'-'.$pfile->getFilename(); 
                                    $_new->lang = 'php';
                                    $_new->code = Model_TemplateFactory::translatePHP($code);
                                    $_files []= $_new;                                                      
                                        }
                                     }

                                     foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir.'/templates') as $pfile )
                                     {
                                        $expl = explode('.',$pfile->getFilename());
                                        if(end($expl)=='php')
                                        {
                                    ob_start();
                                    require $dir.'/templates/'.$pfile->getFilename();
                                    $code = ob_get_contents();
                                    ob_end_clean();

                                    $_new = new stdClass();
                                    $_new->name = 'dt/templates/form.'.$model->getModelName().'.'.$collum.'.'.preg_replace('/(.php)$/', '',$pfile->getFilename()); 
                                    $_new->lang = 'php';
                                    $_new->code = Model_TemplateFactory::translatePHP($code);
                                    $_files []= $_new;                                                      
                                        }
                                     }
                                   /*  
                                   foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir.'/js') as $file )
                                     {
                                        $expl = explode('.',$pfile->getFilename());
                                        if(end($expl)=='php')
                                        {
                                    ob_start();
                                    require $dir.'/js/'.$pfile->getFilename();
                                    $code = ob_get_contents();
                                    ob_end_clean();

                                    $_new = new stdClass();
                                    $_new->name = 'dt/js/'.$model->getModelName().'.'.$collum.'.'.preg_replace('/(.php)$/', '',$pfile->getFilename()); 
                                    $_new->lang = 'js';
                                    $_new->code = Model_TemplateFactory::translatePHP($code);
                                    $_files []= $_new;                                                      
                                        }
                                     }
                                     */
                                     foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir.'/css') as $pfile )
                                     {
                                        $expl = explode('.',$pfile->getFilename());
                                        if(end($expl)=='php')
                                        {
                                    ob_start();
                                    require $dir.'/css/'.$pfile->getFilename();
                                    $code = ob_get_contents();
                                    ob_end_clean();

                                    $_new = new stdClass();
                                    $_new->name = 'dt/css/'.$model->getModelName().'.'.$collum.'.'.preg_replace('/(.php)$/', '',$pfile->getFilename()); 
                                    $_new->lang = 'css';
                                    $_new->code = Model_TemplateFactory::translatePHP($code);
                                    $_files []= $_new;                                                      
                                        }
                                     }
                                                                                                      
      }   //end model files 

        
        
        
        
        
        
    } //end if use-admin
    
  }
    else {
            $_file = new stdClass();
            $_file->name = 'ERROR';
            $_file->code = 'NEPLATNY  Model_Component_Gallery_Grid '.$modelclass;                                        
            $_files []= $_file;         
    }
    
    echo json_encode(array('generator'=>isset($_GET['use-view'])?'page_component_gallery':'component_gallery','files'=>$_files));
    

