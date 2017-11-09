<?php

$modelclass = $_GET['class'];
$model = new $modelclass();


if($model instanceof Model_Model)
{
   
   $dir= "_dev_templates/models/model/view";  
   
        foreach($_GET['type']as$key=>$type)
        {
          
          if($type=='ajax') //datatable,autocomplete
          {             
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
            $_new->name = 'dt/ajax/'.$model->getModelName().'-'.$file->getFilename(); 
            $_new->lang = 'php';
            $_new->code = Model_TemplateFactory::translatePHP($code);
            $_files []= $_new;                                                      
                }
             }
          }
          elseif($type=="template") {
            ob_start();
            require $dir.'/template/template.php';
            $code = ob_get_contents();
            ob_end_clean();
            
            $_new = new stdClass();
            $_new->name = 'dt/templates/'.$type.'.mview.'.$model->getModelName(); 
            $_new->lang = 'php';
            $_new->code = Model_TemplateFactory::translatePHP($code);
            $_files []= $_new;              
          }  
          elseif($type=="controller") {
            ob_start();
            require $dir.'/controller/template.php';
            $code = ob_get_contents();
            ob_end_clean();
            
            $_new = new stdClass();
            $_new->name = 'dt/controller/mview.'.$model->getModelName(); 
            $_new->lang = 'php';
            $_new->code = Model_TemplateFactory::translatePHP($code);
            $_files []= $_new;              
          }                      
          elseif($type=="pjs") {
            ob_start();
            require $dir.'/pjs/template.php';
            $code = ob_get_contents();
            ob_end_clean();
            
            $_new = new stdClass();
            $_new->name = 'dt/pjs/'.$model->getModelName().'-mview'; 
            $_new->lang = 'php';
            $_new->code = Model_TemplateFactory::translatePHP($code);
            $_files []= $_new;              
          }            
         elseif($type=="templates") {
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
            $_new->name = 'dt/templates/template.glist.'.$model->getModelName().'.'.preg_replace('/(.php)$/', '',$file->getFilename()); 
            $_new->lang = 'php';
            $_new->code = Model_TemplateFactory::translatePHP($code);
            $_files []= $_new;                                                      
                }
             }
         } 
         elseif($type=="css") {
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
            $_new->name = 'dt/css/'.$model->getModelName().'.'.preg_replace('/(.php)$/', '',$file->getFilename()); 
            $_new->lang = 'php';
            $_new->code = Model_TemplateFactory::translatePHP($code);
            $_files []= $_new;                                                      
                }
             }
         } 
         elseif($type=="js") {
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
            $_new->name = 'dt/js/'.$model->getModelName().'.'.preg_replace('/(.php)$/', '',$file->getFilename()); 
            $_new->lang = 'php';
            $_new->code = Model_TemplateFactory::translatePHP($code);
            $_files []= $_new;                                                      
                }
             }
         } 
         
        }
        
        
          
  }
    else {
            $_file = new stdClass();
            $_file->name = 'ERROR';
            $_file->code = 'NEPLATNY Grid '.$gridclass;                                        
            $_files []= $_file;        
    }
    
    echo json_encode(array('generator'=>'component_datatable','files'=>$_files));
    



