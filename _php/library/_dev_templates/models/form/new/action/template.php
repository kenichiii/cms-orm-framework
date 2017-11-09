[[
     

     $id = 0;
     $succ = 'no';
     $err  = array();
     
     try {

        $model = new <?php echo $this->getModelClass() ?>();
        
        $model->fromform($_POST);
        
<?php 
        foreach($this->getModel()->getModel() as $key=>$child) { 
           if($child->isMixed()) printMixedNewAction($child);
           elseif($child->isPrimitive()&&$child instanceof Model_Primitive_Bit&&($key!='deleted'&&$key!='active'))
           {
?>
        $model->set('<?php echo $child->getCollum(); ?>',(isset($_POST['<?php echo $child->getCollum(); ?>'])?1:0));
        
<?php        
           }
           
       } //endforeach 
?>           
        
        
<?php if($rank=$this->getModel()->isRankAble()) { ?>  
        $model->setRank();
<?php } ?>          
        
        
        
        $val = $model->validate(Model_Form::ACTION_NEW,$_POST,$model);
                                                                                                                                
        if($val->isSucc())
        {
            $id = $model->insert();                        
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
                'id' => $id,
                'url' => App::getIns()->setLink('home'),
                'errors' => $err
            ));
        
       
        