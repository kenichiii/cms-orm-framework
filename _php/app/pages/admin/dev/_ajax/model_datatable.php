<?php

$_files = array();


    $collum_name = array();
    $action_name = array();
    $groupaction_name = array();
    foreach ($_GET as $key=>$value)
    {                
        if(is_array($key)) 
        {            
            ${$key} = $key;
        }
        else    
        ${$key} = $value;
    }
    
    //$class = $class.'_Datatable';
    
//model
ob_start();

    require_once '_dev_templates/models/datatable/template.php';
    
$code = ob_get_contents();
ob_end_clean();

$_model = new stdClass();
$_model->name = $class;
$_model->lang = 'php';
$_model->code = Model_TemplateFactory::translatePHP($code);
$_files []= $_model;
//end model

if($rowClass!='')
{    
    ob_start();
        
    require_once '_dev_templates/models/datatable/rowclass.php';

    $code = ob_get_contents();
    ob_end_clean();    
    
    $_rc = new stdClass();
    $_rc->name = $rowClass;
    $_rc->lang = 'php';
    $_rc->code = Model_TemplateFactory::translatePHP($code);
    $_files []= $_rc;  
}


echo json_encode(array('generator'=>'datatablemodel','files'=>$_files));