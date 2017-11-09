<?php


$_files = array();


    $children = array();
    $collum_class = array();
    $rel_class = array();
    foreach ($_GET as $key=>$value)
    {                
        if(is_array($key)) 
        {            
            ${$key} = $key;
        }
        else    
        ${$key} = $value;
    }
    
    $class = $class.'_Model';
    

//model
ob_start();

    require '_dev_templates/models/model/template.php';
    
$code = ob_get_contents();
ob_end_clean();

$_model = new stdClass();
$_model->name = $class;
$_model->lang = 'php';
$_model->code = Model_TemplateFactory::translatePHP($code);
$_files []= $_model;
//end model

if( isset($creategrid) )
{
    $model = $_GET['class'].'_Model';
    $class = $grid;
    $title = $grid_title;
    $extends = $grid_extends;
     
    $table = $grid_table;
    $alias = $grid_alias;
    
    ob_start();
        
    require_once '_dev_templates/models/grid/template.php';

    $code = ob_get_contents();
    ob_end_clean();    
    
    $_grid = new stdClass();
    $_grid->name = $class;
    $_grid->lang = 'php';
    $_grid->code = Model_TemplateFactory::translatePHP($code);
    $_files []= $_grid;    
}

if( isset($createformnew) )
{
    $model = $_GET['class'].'_Model';
    $class = $form_new_class;
    $title = $form_new_title;
    $name = $form_new_name;
    $extends = $form_new_extends;
    $action = $form_new_action;
    
    ob_start();
        
    require '_dev_templates/models/form/template.php';

    $code = ob_get_contents();
    ob_end_clean();    
    
    $_new = new stdClass();
    $_new->name = $class;
    $_new->lang = 'php';
    $_new->code = Model_TemplateFactory::translatePHP($code);
    $_files []= $_new;    
}

if( isset($createformedit) )
{
    $model = $_GET['class'].'_Model';
    $class = $form_edit_class;
    $title = $form_edit_title;
    $name = $form_edit_name;
    $extends = $form_edit_extends;
    $action = $form_edit_action;
    
    ob_start();
        
    require '_dev_templates/models/form/template.php';

    $code = ob_get_contents();
    ob_end_clean();    
    
    $_edit = new stdClass();
    $_edit->name = $class;
    $_edit->lang = 'php';
    $_edit->code = Model_TemplateFactory::translatePHP($code);
    $_files []= $_edit;    
}

if( isset($add_gallery) )
{
    $allowed = $gallery_allowed;
    $model = $gallery_model;
    $grid = $gallery_grid;
    $table = $gallery_table;
    $dir = $gallery_dir;    
    $alias = $gallery_alias;
    
    ob_start();        
    require '_dev_templates/models/gallery/model.php';
    $code = ob_get_contents();
    ob_end_clean();    
    
    $_gm = new stdClass();
    $_gm->name = $model;
    $_gm->lang = 'php';
    $_gm->code = Model_TemplateFactory::translatePHP($code);
    $_files []= $_gm;    
    
    
    ob_start();        
    require '_dev_templates/models/gallery/grid.php';
    $code = ob_get_contents();
    ob_end_clean();    
    
    $_gg = new stdClass();
    $_gg->name = $grid;
    $_gg->lang = 'php';
    $_gg->code = Model_TemplateFactory::translatePHP($code);
    $_files []= $_gg;        
               
    if(isset($gallery_createformnew))
    {        
        $model = $gallery_form_new_model;
        $class = $gallery_form_new_class;
        $title = $gallery_form_new_title;
        $name = $gallery_form_new_name;
        $extends = $gallery_form_new_extends;
        $action = $gallery_form_new_action;

        ob_start();

        require '_dev_templates/models/gallery/formnew.php';

        $code = ob_get_contents();
        ob_end_clean();    

        $_new = new stdClass();
        $_new->name = $class;
        $_new->lang = 'php';
        $_new->code = Model_TemplateFactory::translatePHP($code);
        $_files []= $_new;    
    }

    if( isset($gallery_createformedit) )
    {
        $model = $gallery_form_edit_model;
        $class = $gallery_form_edit_class;
        $title = $gallery_form_edit_title;
        $name = $gallery_form_edit_name;
        $extends = $gallery_form_edit_extends;
        $action = $gallery_form_edit_action;

        ob_start();

        require '_dev_templates/models/gallery/formedit.php';

        $code = ob_get_contents();
        ob_end_clean();    

        $_edit = new stdClass();
        $_edit->name = $class;
        $_edit->lang = 'php';
        $_edit->code = Model_TemplateFactory::translatePHP($code);
        $_files []= $_edit;    
    }    
    
} //end gallery

if( isset($add_docs) )
{
    $allowed = $docs_allowed;
    $model = $docs_model;
    $grid = $docs_grid;
    $table = $docs_table;
    $dir = $docs_dir;
    $alias = $docs_alias;
    
    ob_start();        
    require '_dev_templates/models/docs/model.php';
    $code = ob_get_contents();
    ob_end_clean();    
    
    $_gm = new stdClass();
    $_gm->name = $model;
    $_gm->lang = 'php';
    $_gm->code = Model_TemplateFactory::translatePHP($code);
    $_files []= $_gm;    
    
    
    ob_start();        
    require '_dev_templates/models/docs/grid.php';
    $code = ob_get_contents();
    ob_end_clean();    
    
    $_gg = new stdClass();
    $_gg->name = $grid;
    $_gg->lang = 'php';
    $_gg->code = Model_TemplateFactory::translatePHP($code);
    $_files []= $_gg;        
    
    
    if(isset($docs_createformnew))
    {        
        $model = $docs_form_new_model;
        $class = $docs_form_new_class;
        $title = $docs_form_new_title;
        $name = $docs_form_new_name;
        $extends = $docs_form_new_extends;
        $action = $docs_form_new_action;

        ob_start();

        require '_dev_templates/models/docs/formnew.php';

        $code = ob_get_contents();
        ob_end_clean();    

        $_new = new stdClass();
        $_new->name = $class;
        $_new->lang = 'php';
        $_new->code = Model_TemplateFactory::translatePHP($code);
        $_files []= $_new;    
    }

    if( isset($docs_createformedit) )
    {
        $model = $docs_form_edit_model;
        $class = $docs_form_edit_class;
        $title = $docs_form_edit_title;
        $name = $docs_form_edit_name;
        $extends = $docs_form_edit_extends;
        $action = $docs_form_edit_action;

        ob_start();

        require '_dev_templates/models/docs/formedit.php';

        $code = ob_get_contents();
        ob_end_clean();    

        $_edit = new stdClass();
        $_edit->name = $class;
        $_edit->lang = 'php';
        $_edit->code = Model_TemplateFactory::translatePHP($code);
        $_files []= $_edit;    
    }                                    
} //end docs



echo json_encode(array('generator'=>'model','files'=>$_files));

