[[

class <?php echo $grid; ?> extends Model_Component_Gallery_Grid<?php ?>

{    
    
    protected $_modelClass = '<?php echo $model; ?>';
    
    protected $_table = '<?php echo $table; ?>';

    protected $_alias = '<?php echo $alias; ?>';
    
    protected $dir = '<?php echo $dir; ?>';    
        
    protected $allowedExt = array("<?php echo implode('","',explode(',',$allowed)) ?>");
}


