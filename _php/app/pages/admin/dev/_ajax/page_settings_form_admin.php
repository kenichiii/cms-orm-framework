<?php

$pointer = $_GET['pointer'];
$sectiontitle = $_GET['sectiontitle'];
$itemname = $_GET['itemname'];

   $dir= "_dev_templates/models/settings/";  
   
            ob_start();
            require $dir.'template-setting-form-for-admin-page.php';
            $code = ob_get_contents();
            ob_end_clean();
            
            $_new = new stdClass();
            $_new->name = 'dt/templates/form.'.$pointer.''; 
            $_new->lang = 'php';
            $_new->code = Model_TemplateFactory::translatePHP($code);
            $_files []= $_new;                                                      
        
    
    echo json_encode(array('generator'=>'component_datatable','files'=>$_files));
    



