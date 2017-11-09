<?php

  $_files = array();

  $form = new $_GET['form']();
  
  if( $form instanceof Model_Form )  
  {  
    
    if(isset($_GET['type']))          
    foreach($_GET['type'] as $type)
    {
      if($form->templateExists($form->getModelAction(),$type))  
      {      
            $code = Model_TemplateFactory::translatePHP($form->getTemplate($form->getModelAction(),$type));

            $_new = new stdClass();
            $_new->name = 'f/'.$type.'/form-'.$form->getModel()->getModelName();
            $_new->lang = $type=='css'||$type=='js' ? $type : 'php';
            $_new->code = Model_TemplateFactory::translatePHP($code);
            $_files []= $_new;  
      }
      
      if($type=='action'||$type=='ajax')
      {
          
          foreach($form->getModel()->getModel() as $key=>$child)
          {
            if($child->isPrimitive())
            {    
              $dir = LIBRARY_PATH . '/_dev_templates/models/form/'.$form->getModelAction().'/'.$type.'/'.  strtolower($child->getTemplateName());
              if( is_dir($dir))
              {
                  
                  
                        foreach( new DirectoryIterator($dir) as $file )
                        {
                           if( $file->isDir() && $file->getFilename()!='..' && $file->getFilename()!='.' )
                           {
                               $action_name = $child->getCollum().'-'.$file->getFilename();
                               $code = $form->getTemplate($form->getModelAction(),$type.'/'.strtolower($child->getTemplateName()).'/'.$file->getFilename(),$child);
                               
                                           $_child = new stdClass();
                                            $_child->name = $type.'/'.$action_name;
                                            $_child->lang = 'php';
                                            $_child->code = Model_TemplateFactory::translatePHP($code);
                                            $_files []= $_child;  
 
                           }
                        }  
                }
                             
            } elseif( $child->isMixed() ) {
                
                $_files = array_merge($_files,getFileCode($type,$child,$form));
            }      
              
          }
      }
      
    }  
    else {
            $_file = new stdClass();
            $_file->name = 'ERROR';
            $_file->code = 'ZADNY TYP K VYKRESLENI '.$form;                                        
            $_files []= $_file;        
    }
    
    

    
  }
    else {
            $_file = new stdClass();
            $_file->name = 'ERROR';
            $_file->code = 'NEPLATNY FORMULAR '.$form;                                        
            $_files []= $_file;        
    }
    
    echo json_encode(array('generator'=>'component_datatable','files'=>$_files));
    
    
function getFileCode($type,$cd,$form)
           {
            $_files = array();
          foreach($cd->getModel() as $key=>$child)
          {    
            if($child->isPrimitive())
            {    
              $dir = LIBRARY_PATH . '/_dev_templates/models/form/'.$form->getModelAction().'/'.$type.'/'.  strtolower($child->getTemplateName());
              if( is_dir($dir))
              {
                        foreach( new DirectoryIterator($dir) as $file )
                        {
                           if( $file->isDir() && $file->getFilename()!='..' && $file->getFilename()!='.' )
                           {
                               $action_name = $child->getCollum().'-'.$file->getFilename();
                               $code = $form->getTemplate($form->getModelAction(),$type.'/'.strtolower($child->getTemplateName()).'/'.$file->getFilename(),$child);
                               
                                           $_child = new stdClass();
                                            $_child->name = $type.'/'.$action_name;
                                            $_child->lang = 'php';
                                            $_child->code = Model_TemplateFactory::translatePHP($code);
                                            $_files []= $_child;  
 
                           }
                        }  
              }
            } elseif( $child->isMixed() ) {
                
                $_files = array_merge($_files,getFileCode($child,$form));
            }                        
          }  
            return $_files;
           }    