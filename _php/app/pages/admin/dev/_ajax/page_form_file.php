<?php

  $_files = array();

  $modelclass = $_GET['modelclass'];
  $collum = $_GET['collum'];
  
  $model = new $modelclass();
  
  $dir= "_dev_templates/models/form/file";  
    
    if(isset($_GET['type']))          
    foreach($_GET['type'] as $type)
    {
          
          if($type=='action') 
          {             
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
          }
          elseif($type=='ajax') 
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
            $_new->name = 'dt/ajax/'.$model->getModelName().'-'.$collum.'-'.$file->getFilename(); 
            $_new->lang = 'php';
            $_new->code = Model_TemplateFactory::translatePHP($code);
            $_files []= $_new;                                                      
                }
             }
          }
         elseif($type=="template") {
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
            $_new->name = 'dt/js/'.$model->getModelName().'.'.$collum.'.'.preg_replace('/(.php)$/', '',$file->getFilename()); 
            $_new->lang = 'js';
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
            $_new->name = 'dt/css/'.$model->getModelName().'.'.$collum.'.'.preg_replace('/(.php)$/', '',$file->getFilename()); 
            $_new->lang = 'css';
            $_new->code = Model_TemplateFactory::translatePHP($code);
            $_files []= $_new;                                                      
                }
             }
         }           
        
        
          
        
      
    }  
    
    echo json_encode(array('generator'=>'page_form_foto','files'=>$_files));
    
    
