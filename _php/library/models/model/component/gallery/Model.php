<?php

class Model_Component_Gallery_Model extends Model_Model
{
    protected $_rawname = 'gallery';
    protected $_title = 'Galerie';
    
    protected $_gridClass = 'Model_Component_Gallery_Grid';
    
    public function __construct()
    {        
    
        $this->modeladdPkId(); 
                     
        $ownerid = new Model_Primitive_Int();
        $ownerid->setTitle('Patří')->setKey(true);
        $this->modeladd('ownerid',$ownerid);
        
        $this->modeladdH1();
        
                        
        $content = new Model_Primitive_Text();
        $content->setTitle('Popis');        
        $this->modeladd('content', $content);

                                                                             
        $src = new Model_Primitive_Varchar();
        $src->setTitle('Soubor');        
        $this->modeladd('src', $src);

        $link = new Model_Primitive_Varchar();
        $link->setTitle('Odkaz');        
        $this->modeladd('link', $link);        
        
        $this->modeladdRank();
        
        $this->modeladdCreated();
        
        $this->modeladdLastupdate();
        
    
    } //end __constructor

 
           /**
            *  load model by primary key from db table
            *
            * @return <?php echo $class ?>
            **/            
            public static function loadByPK($id)
            {
                $model = new Model_Component_Gallery_Model();
                return $model->getGrid(true)->getByPk($id);
            } 
   

                                 

        
   

                                 
    
                
} //end class 



