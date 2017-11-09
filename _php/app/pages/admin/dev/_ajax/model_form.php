<?php

    access();
    
$_files = array();
$_file = new stdClass();

//grid
ob_start();

    foreach ($_GET as $key=>$value)
    {                
        if(is_array($key)) 
        {            
            ${$key} = $key;
        }
        else    
        ${$key} = $value;
    }    
    
    require_once '_dev_templates/models/form/template.php';
    
$code = ob_get_contents();
ob_end_clean();

$_file->name = $class;
$_file->lang = 'php';
$_file->code = Model_TemplateFactory::translatePHP($code);
$_files []= $_file;


echo json_encode(array('generator'=>'form','files'=>$_files));