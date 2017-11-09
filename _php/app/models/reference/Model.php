<?php

class Reference_Model extends Model_Model
{
    protected $_rawname = 'reference';
    protected $_title = 'Reference';

    protected $_gridClass = 'Reference_Grid';

    public function __construct()
    {        

        $this->modeladdPkId(); 

        $this->modeladdDeleted(); 

        $this->modeladdActive();

        $this->modeladdH1();

        $this->modeladdUri(); 

        $this->modeladdCreated();

        $this->modeladdPhoto();

        $this->modeladdRank();

        $this->modeladdPerex();

        $this->modeladdContent();

        $datum = new Model_Primitive_Varchar();
        $datum->setTitle('Datum')        
                            ;
    $this->modeladd("datum",$datum);

        $gallery = new Reference_Gallery_Model();
        $gallery->setN1('ownerid','id');
        $this->relationsadd('gallery',$gallery);

                        ;        

    } //end __constructor

            /**
             *  load model by primary key from db table
             *
             * @param int $id
             * @return \Reference_Model            
             */            
            public static function loadByPK($id)
            {
                $model = new Reference_Model();
                return $model->getGrid()->getByPk($id);
            }   

            /**
             *  load model by uri from db table
             *
             * @param string $uri
             * @return \Reference_Model            
             */            
            public static function loadByUri($uri)
            {
                $model = new Reference_Model();
                $uriable = $model->isUriAble();
                return $model->getGrid(true)->where(' and '.$model->getGrid()->getAlias($uriable->getCollum()).'=%s',$uri)->getSingle();
            }            

            /**
             *   set rank to max+1 
             *
             * @return \Reference_Model            
             */            
            public function setRank()
            {  
              $this->set('rank',$this->getGrid()->getMaxRank()+1);
              return $this;
            }            

            /**
             *  set new ranks
             *                                       
             *
             * @return \Reference_Model            
             */                        
            public function moveDownAction()
            {
              $this->getGrid(true)->moveDownAction($this->getPrimaryKey()->getValue());  
              return $this;          
           }             

            /**
             *   set new ranks
             *                                       
             *
             * @return \Reference_Model            
             */            
           public function moveUpAction()
           {
              $this->getGrid(true)->moveUpAction($this->getPrimaryKey()->getValue());  
              return $this;          
           }

            /**
             *   set new ranks
             *                                                    
             *
             * @param int $neib_id
             * @return \Reference_Model            
             */                       
           public function moveAfterAction( $neib_id = 0 )
           {
              $this->getGrid(true)->moveAfterAction($this->getPrimaryKey()->getValue(),$neib_id);  
              return $this;                  
            }

} //end class 

