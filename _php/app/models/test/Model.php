<?php

class Test_Model extends Model_Model
{
    protected $_rawname = 'test';
    protected $_title = 'sdasasdads';

    protected $_gridClass = 'Test_Grid';

    public function __construct()
    {        

        $this->modeladdActive();

        $this->modeladdH1();

        $this->modeladdUri(); 

        $this->modeladdContent();

        $this->modeladdPhoto();

        $this->modeladdCreated();

        $this->modeladdLastupdate();

        $sadsas = new Model_Primitive_Varchar();
        $sadsas->setTitle('sadsas')        
                            ;
    $this->modeladd("sadsas",$sadsas);

    } //end __constructor

            /**
             *  load model by uri from db table
             *
             * @param string $uri
             * @return \Test_Model            
             */            
            public static function loadByUri($uri)
            {
                $model = new Test_Model();
                $uriable = $model->isUriAble();
                return $model->getGrid()->where(' and '.$model->getGrid()->getAlias($uriable->getCollum()).'=%s',$uri)->getSingle();
            }            

    /**
     * update database record by primary key for all model defined collums
     * lastUpdate is geting current timestamp
     * 
     * @return \Test_Model $this
     */
    public function update()
    {
        $this->set('lastupdate',date('Y-m-d G:i:s'));
        $this->getGrid()->updateByPK( $this->getCollumsInArray(), $this->getPrimaryKey()->getValue() );
        return $this;
    }

} //end class 

