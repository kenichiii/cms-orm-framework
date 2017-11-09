<?php

class HPZnacky_Model extends Model_Model
{
    protected $_rawname = 'hpznacky';
    protected $_title = 'HP značka';

    protected $_gridClass = 'HPZnacky_Grid';

    public function __construct()
    {        

        $this->modeladdPkId(); 

        $this->modeladdRank();
        $this->get('rank')->setSorting('ASC');
        
        $this->modeladdDeleted(); 

        $this->modeladdActive();

        $this->modeladdH1();

        $this->modeladdUri(); 

        $this->modeladdContent();

        $this->modeladdPhoto();

        $this->modeladdCreated();

    } //end __constructor

            /**
             *  load model by primary key from db table
             *
             * @param int $id
             * @return \HPZnacky_Model            
             */            
            public static function loadByPK($id)
            {
                $model = new HPZnacky_Model();
                return $model->getGrid()->getByPk($id);
            }   

            /**
             *   set rank to max+1 
             *
             * @return \HPZnacky_Model            
             */            
            public function setRank()
            {  
              $this->set('rank',$this->getGrid()->getMaxRank()+1);
              return $this;
            }            

            /**
             * set new ranks
             * FOR DESCENDING LIST
             *                                       
             *
             * @return \HPZnacky_Model            
             */                        
            public function moveDownAction()
            {
              $this->getGrid()->moveDownAction($this->getPrimaryKey()->getValue());  
              return $this;          
           }             

            /**
             * set new ranks
             * FOR DESCENDING LIST             
             *                                       
             *
             * @return \HPZnacky_Model            
             */            
           public function moveUpAction()
           {
              $this->getGrid()->moveUpAction($this->getPrimaryKey()->getValue());  
              return $this;          
           }

            /**
             * set new ranks
             * FOR DESCENDING LIST             
             *                                                    
             *
             * @param int $neib_id
             * @return \HPZnacky_Model            
             */                       
           public function moveAfterAction( $neib_id = 0 )
           {
              $this->getGrid()->moveAfterAction($this->getPrimaryKey()->getValue(),$neib_id);  
              return $this;                  
            }

            /**
             *  load model by uri from db table
             *
             * @param string $uri
             * @return \HPZnacky_Model            
             */            
            public static function loadByUri($uri)
            {
                $model = new HPZnacky_Model();
                $uriable = $model->isUriAble();
                return $model->getGrid()->where(' and '.$model->getGrid()->getAlias($uriable->getCollum()).'=%s',$uri)->getSingle();
            }            

} //end class 

