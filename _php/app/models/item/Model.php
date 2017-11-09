<?php

class Item_Model extends Model_Model
{
    protected $_rawname = 'item';
    protected $_title = 'Položka';

    protected $_gridClass = 'Item_Grid';

    public function __construct()
    {        

        $this->modeladdPkId(); 

        $this->modeladdRank();

        $this->modeladdDeleted(); 

        $this->modeladdActive();

        $this->modeladdH1();

        $this->modeladdUri(); 

        $this->modeladdPerex();

        $this->modeladdContent();

        $this->modeladdPhoto();

        $this->modeladdCreated();

        $this->modeladdLastupdate();

        $vaha = new Model_Primitive_Int();
        $vaha->setTitle('Váha')        
                            ;
    $this->modeladd("vaha",$vaha);

        $vek = new Model_Primitive_Int();
        $vek->setTitle('Věk')        
                            ->setNotNull(true);
    $this->modeladd("vek",$vek);

        $miry = new Model_Primitive_Varchar();
        $miry->setTitle('Míry')        
                            ;
    $this->modeladd("miry",$miry);

    } //end __constructor

            /**
             *  load model by primary key from db table
             *
             * @param int $id
             * @return \Item_Model            
             */            
            public static function loadByPK($id)
            {
                $model = new Item_Model();
                return $model->getGrid()->getByPk($id);
            }   

            /**
             *   set rank to max+1 
             *
             * @return \Item_Model            
             */            
            public function setRank()
            {  
              $this->set('rank',$this->getGrid()->getMaxRank()+1);
              return $this;
            }            

            /**
             * set new ranks
             * FOR DESCENDING LIST
             * lastUpdate is actualised                                       
             *
             * @return \Item_Model            
             */                        
            public function moveDownAction()
            {
              $this->getGrid()->moveDownAction($this->getPrimaryKey()->getValue());  
              return $this;          
           }             

            /**
             * set new ranks
             * FOR DESCENDING LIST             
             * lastUpdate is actualised                                       
             *
             * @return \Item_Model            
             */            
           public function moveUpAction()
           {
              $this->getGrid()->moveUpAction($this->getPrimaryKey()->getValue());  
              return $this;          
           }

            /**
             * set new ranks
             * FOR DESCENDING LIST             
             * lastUpdate is actualised                                                    
             *
             * @param int $neib_id
             * @return \Item_Model            
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
             * @return \Item_Model            
             */            
            public static function loadByUri($uri)
            {
                $model = new Item_Model();
                $uriable = $model->isUriAble();
                return $model->getGrid()->where(' and '.$model->getGrid()->getAlias($uriable->getCollum()).'=%s',$uri)->getSingle();
            }            

    /**
     * update database record by primary key for all model defined collums
     * lastUpdate is geting current timestamp
     * 
     * @return \Item_Model $this
     */
    public function update()
    {
        $this->set('lastupdate',date('Y-m-d G:i:s'));
        $this->getGrid()->updateByPK( $this->getCollumsInArray(), $this->getPrimaryKey()->getValue() );
        return $this;
    }

} //end class 

