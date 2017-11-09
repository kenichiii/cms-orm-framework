<?php

class Model_NNGrid extends Model_Grid
{
    protected $_title = 'NNGrid';
    
    protected $modelFrom;
    protected $modelTo;
    
    public function __construct($from,$to) {
        $this->_table = $from->getRelTable();
        $this->setAlias('nn');
        $this->modelFrom = $from;
        $this->modelTo = $to;                
    }
    
    public function getModel($fresh = false) {
        if($this->model===null||$fresh)
        {
            $this->model = new Model();
            
            $this->model->setName($this->modelFrom->getGrid()->getTableRaw().'2'.$this->modelTo->getGrid()->getTableRaw());
            $this->model->setTitle('NNModel');
            $this->model->setGrid($this);
            
            $this->model->addChild('id',new Int());
            $this->model->getId()->setTitle('Id')->setName('id')->setPrimaryKey(true);
            
            $this->model->addChild('from'.$this->modelFrom->getRelFrom(),new Int());
            $this->model->{"get{'from'.$this->modelFrom->getRelFrom()}"}()->setTitle('From collum')->setName('from'.$this->modelFrom->getRelFrom())
                    ->setNotNull(true)->setKey(true);
            
            $this->model->addChild('to'.$this->modelFrom->getRelTo(),new Int());
            $this->model->{"get{'to'.$this->modelFrom->getRelTo()}"}()->setTitle('Model collum')->setName('to'.$this->modelFrom->getRelTo())
                    ->setNotNull(true)->setKey(true);            
            
            $this->model->addChild('from',$this->modelFrom->getGrid()->getModel(true));
            $this->model->getFrom()->setJoin($this->modelFrom->getRelFrom(),'from'.$this->modelFrom->getRelFrom());                        
            
            $this->model->addChild('to',$this->modelTo->getGrid()->getModel(true));
            $this->model->getTo()->setJoin($this->modelFrom->getRelTo(),'to'.$this->modelFrom->getRelTo());                        
            
        }
        
        return $this->model;
    }
    
    public function getAllFromByModelTo($value)
    {
        $this->clearwhere();
        $this->clearorderBy();
        $this->clearlimit();
        
        $this->where(' and '.$this->getAlias('to'.$this->modelFrom->getRelTo()).'=%i',$value);
        
        return $this;
    }        
    
    public function getAllFromExceptModelTo($value)
    {                
        return $this->modelFrom->getGrid(true)->where(' and '.
                $this->modelFrom->getGrid()->getAlias($this->modelFrom->getRelFrom()).
                ' NOT IN (SELECT from'.$this->modelFrom->getRelFrom().' FROM '.$this->getTableRaw().' WHERE to'.$this->modelFrom->getRelTo().'=%i )',$value);
    }    
}
