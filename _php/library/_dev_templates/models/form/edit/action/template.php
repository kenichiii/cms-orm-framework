[[

    $succ = 'no';
    $err  = array();
    
    try
     {
     
        $model = <?php echo $this->getModelClass() ?>::loadByPK($_POST['id']);
        
        if(! $model instanceof <?php echo $this->getModelClass() ?>)
        { throw new Exception('not-valid-id'); }
        
        $model->fromform($_POST);
        
<?php 
        foreach($this->getModel()->getModel() as $key=>$child) { 
           if($child->isMixed()) printMixedAction($child);
           elseif($child->isPrimitive()&&$child instanceof Model_Primitive_Bit && $key!='deleted')
           {
?>
        $model->set('<?php echo $child->getCollum(); ?>',(isset($_POST['<?php echo $child->getCollum(); ?>'])?1:0));
        
<?php } } ?>        
        
        $val = $model->validate(Model_Form::ACTION_EDIT,$_POST,$model);                                              
                
        
        if($val->isSucc())
        {
            $model->update();                        
            $succ = 'yes';
            __c()->clean();
        }
        else        
        $err = $val->getErrors();
        
     }
     catch(Exception $e) 
     {        
        errorException($e);
        $err[]= array( 'el' => 'exception','mess'=>'Došlo k nečekanému běhu aplikace. Vaše akce nemohla být přijata.','type'=>'exception');        
     }
     
     
        echo json_encode(array(
                'succ' => $succ,
                'id' => $_POST['id'],
                'succMsg'=>'Vaše údaje byly v pořádku uloženy',
                'url' => App::getIns()->setLink('home'),//change this to succ redirect url
                'errors' => $err
            ));
        
    