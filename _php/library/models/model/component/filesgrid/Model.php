<?php

class Model_Component_FilesGrid_Model extends Model_Model
{
    protected $_rawname = 'docs';
    protected $_title = 'Soubor';

    protected $_gridClass = 'Model_Component_FilesGrid_Grid';

    public function __construct()
    {        

        $this->modeladdPkId(); 

        $this->modeladdOwnerid(); 
        
        $this->modeladdRank();

        $this->modeladdDeleted(); 

        $this->modeladdActive();

        $this->modeladdH1();

        $this->modeladdFile();
        $this->getFile()->setDir($this->getGrid()->getDir())
                        ->setAllowedExt($this->getGrid()->getAllowedExt());
                
        $this->modeladdCreated();

        $this->modeladdLastupdate();

    } //end __constructor

            /**
             *  load model by primary key from db table
             *
             * @param int $id
             * @return \Model_Component_FilesGrid_Model            
             */            
            public static function loadByPK($id)
            {
                $model = new Model_Component_FilesGrid_Model();
                return $model->getGrid()->getByPk($id);
            }   

            /**
             * set rank to max+1 from current parent group
             *
             * @return \Model_Component_FilesGrid_Model            
             */
            public function setRank()
            {
                $this->set('rank',$this->getGrid()->getMaxRank($this->getOwnerid()->getValue())+1);                
                return $this;
            }            

            /**
             * set new ranks 
             * FOR DESCENDING LIST             
             * lastUpdate is actualised  
             *
             * @param int $neib_id
             * @return \Model_Component_FilesGrid_Model            
             */                
            public function moveAfterAction( $neib_id = 0 )
            {
                $this->getGrid()->moveAfterAction($this->getPrimaryKey()->getValue(),$neib_id);
                return $this;
             }

    /**
     * update database record by primary key for all model defined collums
     * lastUpdate is geting current timestamp
     * 
     * @return \Model_Component_FilesGrid_Model $this
     */
    public function update()
    {
        $this->set('lastupdate',date('Y-m-d G:i:s'));
        $this->getGrid()->updateByPK( $this->getCollumsInArray(), $this->getPrimaryKey()->getValue() );
        return $this;
    }

} //end class 

