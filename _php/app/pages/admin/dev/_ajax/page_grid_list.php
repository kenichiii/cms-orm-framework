<?php

$gridclass = $_GET['class'];
$grid = new $gridclass();
$detailpointer = $_GET['detail'];

if($grid instanceof Model_Grid)
{
   
   $dir= "_dev_templates/models/grid/view";  
   
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
            $_new->name = 'dt/ajax/'.$grid->getName().'-'.$file->getFilename(); 
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
            $_new->name = 'dt/templates/'.$type.'.glist.'.$grid->getName(); 
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
            $_new->name = 'dt/controller/glist.'.$grid->getName(); 
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
            $_new->name = 'dt/pjs/'.$grid->getName().'-glist'; 
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
            $_new->name = 'dt/templates/template.glist.'.$grid->getName().'.'.preg_replace('/(.php)$/', '',$file->getFilename()); 
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
            $_new->name = 'dt/css/'.$grid->getName().'-'.preg_replace('/(.php)$/', '',$file->getFilename()); 
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
            $_new->name = 'dt/js/'.$grid->getName().'-'.preg_replace('/(.php)$/', '',$file->getFilename()); 
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
    



