[[

class <?php echo $model; ?> extends Model_Component_Gallery_Model<?php ?>

{
    protected $_name = '<?php echo $name ?>';
    protected $_gridClass = '<?php echo $grid; ?>';
 
    
            /**
             *  load model by primary key from db table
             *
             * @param int $id
             * @return \<?php echo $model; ?>            
             */            
            public static function loadByPK($id)
            {
                $model = new <?php echo $model; ?>();
                return $model->getGrid()->getByPk($id);
            }   
    
    
}
