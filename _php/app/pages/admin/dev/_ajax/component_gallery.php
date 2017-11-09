<?php

$_files = array();
$modelclass = $_GET['model'];
$model = new $modelclass();

if($model->getGallery() instanceof Model_Component_Gallery_Grid)
{
    if(isset($_GET['use-view']))
    {
        foreach($_GET['view']as$key=>$type)
        {
            ob_start();
            require "_dev_templates/models/gallery/pages/view/{$type}/template.php";
            $code = ob_get_contents();
            ob_end_clean();
            
            $_new = new stdClass();
            $_new->name = 'view/'.$type.'/'.$model->getModelName().'-gallery'; 
            $_new->lang = $type=='css'||$type=='js' ? $type : 'php';
            $_new->code = Model_TemplateFactory::translatePHP($code);
            $_files []= $_new;              
            
        }
    }
    
    if(isset($_GET['use-admin']))
    {
        foreach($_GET['admin']as$key=>$type)
        {
          $dir="_dev_templates/models/gallery/pages/admin/{$type}";   
          if($type=='ajax'||$type=='action'||$type=='css'||$type=='js')
          {             
             foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir) as $file )
             {
                $expl = explode('.',$file->getFilename());
                if(end($expl)=='php')
                {
                    ob_start();
                    require $dir.'/'.$file->getFilename();
                    $code = ob_get_contents();
                    ob_end_clean();

                    $_new = new stdClass();
                    $_new->name = 'admin/'.$type.'/'.$model->getModelName().'-'.preg_replace('/(\.php)$/', '', $file->getFilename()); 
                    $_new->lang = ($type=='ajax'||$type=='action')?'php':($type=='js'?'js':'css');
                    $_new->code = Model_TemplateFactory::translatePHP($code);
                    $_files []= $_new;                                                      
                }
             }
          }
          elseif($type=="templates") 
          {
             foreach( new DirectoryIterator(LIBRARY_PATH.'/'.$dir) as $file )
             {
                $expl = explode('.',$file->getFilename());
                if(end($expl)=='php')
                {
                    ob_start();
                    require $dir.'/'.$file->getFilename();
                    $code = ob_get_contents();
                    ob_end_clean();

                    $_new = new stdClass();
                    $_new->name = 'admin/'.$type.'/'.$model->getModelName().'.'.preg_replace('/(\.php)$/', '', $file->getFilename()); 
                    $_new->lang = 'php';
                    $_new->code = Model_TemplateFactory::translatePHP($code);
                    $_files []= $_new;                                                      
                }
             }                                                                                        
          }
          
          
          
          
          
          
          
          
          
          
        }
    }
    
  }
    else {
            $_file = new stdClass();
            $_file->name = 'ERROR';
            $_file->code = 'NEPLATNY  Model_Component_Gallery_Grid '.$modelclass;                                        
            $_files []= $_file;         
    }
    
    echo json_encode(array('generator'=>isset($_GET['use-view'])?'page_component_gallery':'component_gallery','files'=>$_files));
    

