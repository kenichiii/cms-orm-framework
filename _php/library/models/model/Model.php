<?php

class Model_Model extends Model_Mixed
{
    protected $_rawname = 'model';
    protected $_title = 'Model';
    
    protected $_gridClass = 'Grid';
    
    protected $_isJoin = false;
    protected $_joinFrom;
    protected $_joinTo;
    
    protected $_rels = array();
    
    protected $_rel11 = false;
    protected $_relN1 = false;
    protected $_rel1N = false;
    protected $_relNN = false;
    protected $_relFrom;
    protected $_relTo;
    protected $_relTable;
    
    protected $grid = null;    
    
    
    public function getModelName()
    {
        return $this->_name!=null?$this->_name:$this->_rawname;
    }    
    
    /**
     * 
     * @param string $name [a-z]
     * @param string $model
     * @return \Model_Model
     */
    public function modeladd($name,$model)
    {
        $this->_model [$name]= $model;
        $this->_model [$name]->setName($name);
                            
        return $this;
    }  
    
    /*
     * return array with predefined relations with other models
     * 
     * @return Array $_rels
     */
    public function getRels()
    {
        return $this->_rels;
    }
    
    /**
     *  add standart primary key called id
     * 
     *  @return Model_Model $this
     */    
    public function modeladdPkId()
    {        
        $this->modeladd('id', new Model_Default_Id());
        return $this;
    }

    /**
     *  @return Model_Model $this
     */      
    public function modeladdParentId()
    {
        $this->modeladd('parentid', new Model_Default_Parentid());        
        return $this;
    }
    
    /**
     *  @return Model_Model $this
     */      
    public function modeladdDeleted()
    {                  
        $this->modeladd('deleted', new Model_Default_Deleted());                
        return $this;
    }    

    /**
     *  @return Model_Model $this
     */      
    public function modeladdActive()
    {                   
        $this->modeladd('active', new Model_Default_Active());                        
        return $this;
    }

    /**
     *  @return \Model_Model $this
     */          
    public function modeladdLang()
    {
        $this->modeladd('lang', new Model_Default_Lang());                                
        return $this;
    }        

    /**
     *  @return Model_Model $this
     */          
    public function modeladdFile()
    {
        $this->modeladd('file', new Model_Default_File());                                
        $this->get('file')->setDir('docs/'.$this->getRawName().'/file');
        return $this;
    }        
    
    /**
     *  @return Model_Model $this
     */          
    public function modeladdH1()
    {
        $this->modeladd('h1', new Model_Default_H1());                                
        return $this;
    }    

    /**
     * 
     *  @return Model_Model $this
     */    
    public function modeladdPerex()
    {        
        $this->modeladd('perex', new Model_Default_Perex());
        return $this;
    }    

    /**
     * 
     *  @return Model_Model $this
     */    
    public function modeladdContent()
    {        
        $this->modeladd('content', new Model_Default_Content());
        return $this;
    }    
    
    
    /**
     *  @return Model_Model $this
     */          
    public function modeladdTransH1()
    {        
        $this->modeladd('h1',new Model_Default_Trans(new Model_Default_H1()));                                
        return $this;
    }        

    /**
     *  @return Model_Model $this
     */          
    public function modeladdTransUri()
    {        
        $this->modeladd('uri',new Model_Default_Trans(new Model_Default_Uri()));                                
        return $this;
    }    
    
    /**
     *  @return Model_Model $this
     */          
    public function modeladdPhoto()
    {
        $this->modeladd('photo', new Model_Default_Photo());                                        
        $this->get('photo')->setDir('docs/'.$this->getRawName().'/photo');                           
        return $this;
    }        
    
    /**
     *  @return Model_Model $this
     */          
    public function modeladdPrivatephoto()
    {
        $this->modeladd('privatephoto', new Model_Default_Privatephoto());                                        
        $this->get('privatephoto')->setDir('docs/'.$this->getRawName().'/privatephoto');                           
        return $this;        
    }

    /**
     *  @return Model_Model $this
     */          
    public function modeladdUri()
    {
        $this->modeladd('uri', new Model_Default_Uri());                                        
        return $this;
    }       
    
    /**
     *  @return Model_Model $this
     */          
   public function modeladdNestedIndexes()
   {
       $this->modeladd('nix', new Model_Default_Nix());                                        

        return $this;        
   }
   
    /**
     * 
     *  @return Model_Model $this
     */          
    public function modeladdOwnerid()
    {
        $this->modeladd('ownerid', new Model_Default_Ownerid());                                        
        return $this;
    }   
   
    /**
     *  @return Model_Model $this
     */          
    public function modeladdRank()
    {
        $this->modeladd('rank', new Model_Default_Rank());                                                                     ; 
        return $this;
    }          
    
    /**
     *  @return Model_Model $this
     */          
    public function modeladdCreated()
    {
        $this->modeladd('created', new Model_Default_Created());
        return $this;
    }         

    /**
     *  @return Model_Model $this
     */          
    public function modeladdLastupdate()
    {
        $this->modeladd('lastupdate', new Model_Default_Lastupdate());
        return $this;
    }     

    /**
     *  @return Model_Model $this
     */          
    public function modeladdDate()
    {
        $this->modeladd('date', new Model_Default_Date());
        return $this;
    }    

    /**
     *  @return Model_Model $this
     */          
    public function relationsadd($name,$model)
    {
        $this->_rels [$name]= $model;
        $this->_rels [$name]->setName($name);
                            
        return $this;
    }             
    /**
     *  @return Model_Model $this
     */          
    public function removemodel($name)
    {
        unset($this->_model [$name]);                            
        return $this;
    }             

    /**
     *  @return Model_Model $this
     */          
    public function removerelation($name)
    {
        unset($this->_rels [$name]);                            
        return $this;
    }                 
    
    
    /**
     * if $this->get<Name>() name exists defined as collum
     * or name exits in relations definition
     * 
     * @param type $name
     * @param type $arguments
     * @return Primitive|Grid|Model
     * @throws Exception not found
     */
    public function __call($name, $arguments) 
    {
        $child = parent::__call($name, $arguments);
        
        if($child!=null) return $child;
        elseif(preg_match('/^(get)/', $name)) 
        {
        
        $test = strtolower(preg_replace('/^(get)/', '', $name));    
            
        $relsall = $this->getRels();
        $relskeys = array_keys($relsall);
        
        if(in_array($test,$relskeys))
        {            
            if($relsall[$test]->is1N()) return $this->getModelRel1N($relsall[$test]);
            if($relsall[$test]->isN1()) return $this->getGridRelN1($relsall[$test]);
            elseif($relsall[$test]->isNN()) return $this->getGridRelNN($relsall[$test]);
            elseif($relsall[$test]->is11()) return $this->getModelRel11($relsall[$test]);
            else throw new Exception ("not existing relationship {$this->getModelTitle()} :: {$relsall[$test]->getTitle()} ");
        }
        else throw new Exception ("not existing relationship {$this->getModelTitle()} :: {$test} ");
        
        }
        else
        throw new Exception ("{$this->getModelTitle()} :: not have {$name}");
    }
    
    public function getRelFrom()
    {
        return $this->_relFrom;
    }
    
    public function getRelTo()
    {
        return $this->_relTo;
    }
    
    public function getGridRelN1($fromModel)
    {
       return $fromModel->getGrid(true)->where( ' and '.
               $fromModel->getGrid()->getAlias($fromModel->getRelFrom()) .' = %i', 
               $this->{"get{$fromModel->getRelTo()}"}()->getValue() 
          );
    }
    
    public function getNNGrid($fromModel)
    {
        return new NNGrid( $fromModel, $this );
    }
    
    public function getGridRelNN($fromModel)
    {
       return $this->getNNGrid($fromModel);                
    }
    
    public function getModelRel11($fromModel)
    {
       return $fromModel->getGrid(true)->where( ' and '.
               $fromModel->getGrid()->getAlias() .'.'. $fromModel->getRelFrom().' = %i', 
               $this->{"get{$fromModel->getRelTo()}"}()->getValue() 
          )->getSingle();
    }
    
    public function getModelRel1N($fromModel)
    {
       return $fromModel->getGrid()->where( ' and '.
               $fromModel->getGrid()->getAlias() .'.'. $fromModel->getRelFrom().' = %i', 
               $this->{"get{$fromModel->getRelTo()}"}()->getValue() 
          )->getSingle();
    }
    
    public function setGrid($grid)
    {
       $this->grid = $grid;        
       return $this;        
    }    
    
    
    public function get($child)
    {
            $test = explode('_',$child);
        
            $rek = array();
            for($i=1; $i < count($test); $i++)
            {
                $rek []= $test[$i];
            }
            

            
            if(isset($this->_model[$test[0]]) && count($rek) )
                return $this->_model[$test[0]]->get(implode('_',$rek));
            
            elseif(isset($this->_model[$test[0]]) && !count($rek) )     
                return $this->_model[$test[0]]; 
            
            else throw new Exception ("{$this->getModelTitle ()} cant get {$child}");        
    }
    
    /**
     * 
     * @param boolean $fresh
     * @return Model_Grid
     */
    public function getGrid($fresh=false)
    {
       if($this->grid===null||$fresh) $this->grid = new $this->_gridClass();
       return $this->grid;        
    }
    
    public function getGridClassName()
    {
        return $this->_gridClass;
    }
    
    public function setN1($fromthis,$toparent)
    {
        $this->_relN1 = true;
        $this->_relFrom = $fromthis;
        $this->_relTo = $toparent;
        
        return $this;
    }
    public function isN1() { return $this->_relN1; }
    
    public function set11($fromthis,$toparent)
    {
        $this->_rel11 = true;
        $this->_relFrom = $fromthis;
        $this->_relTo = $toparent;
        
        return $this;        
    }
    public function is11() { return $this->_rel11; }
    
    public function set1N($fromthis,$toparent)
    {
        $this->_relN1 = true;
        $this->_relFrom = $fromthis;
        $this->_relTo = $toparent;
        
        return $this;
    }    
    public function is1N() { return $this->_rel1N; }
    
    public function setNN($fromthis,$toparent,$parenttable)
    {
        $this->_relNN = true;
        $this->_relFrom = $fromthis;
        $this->_relTo = $toparent;
        $this->_relTable = $parenttable .'2'. $this->getGrid()->getTableRaw();
        
        return $this;
    }
    public function isNN() { $this->_relN1; }
    
    public function isJoin()
    {
        return $this->_isJoin;
    }
    
    public function setJoin($fromthis,$toparent)
    {
            $this->_isJoin = true;
        
            $this->_joinFrom = $fromthis;
            $this->_joinTo = $toparent;
        
        return $this;     
    }
    
    public function getJoinFrom()
    {
        return $this->_joinFrom;
    }
    
    public function getJoinTo()
    {
        return $this->_joinTo;
    }
    
    public function fromDb($data) {
        foreach($data as $key=>$value)
        {            
           $this->set( $key, $value, 'db' );     
        }
                
        return $this;
    }
    
    public function fromform($data) {
                
          parent::fromform($data);               
        
          foreach ($this->getModel() as $key => $child) 
          { 
                if( $child->isModel() )
                {
                     $this->get($child->getModelName())->fromform($data);                                
                }
          } 
           
          //add relations  
                
        return $this;
    }
    

    public function isModel()
    {
        return true;
    }
    
    public function isMixed()
    {
        return false;
    }    
    
    public function isPrimitive()
    {
        return false;
    }
    
    public function validate($formAction=null,$data=null,$model=null)
    {
        if($model==null) $model = $this;
        
        $val = new Model_Validation();
        
        $val->add(parent::validate($formAction,$data,$model));
        
        $val->add($this->checkUniques($formAction,$data));
        
        return $val;
    }
    
    public function checkUniques($action,$data=null)
    {
        $val = new Model_Validation();
        
        if($action=='new') {
            foreach($this->getCollumsRaw() as $key=>$collum)
            {
                if($collum->isUnique() && $collum->getUniqueWith()!=null && is_array($collum->getUniqueWith()) )
                {
                    $grid = $this->getGrid(true);
                    $grid->where( " and ".$grid->getAlias().'.'.$collum->getCollum().'=%s',$collum->getValue());
                    foreach( $collum->getUniqueWith() as $key2 => $c )
                        $grid->where( " and ".$grid->getAlias().'.'.$this->{"get{$c}"}()->getCollum().'=%s',$this->{"get{$c}"}()->getValue());
                        
                    if( $grid->getCount() > 0 )    
                    $val->addError ('notunique', $collum->getCollum(), 'Skupina není jedinečná');
                }
                elseif($collum->isUnique() && $collum->getUniqueWith()!=null && is_string($collum->getUniqueWith()) )
                {
                    $grid = $this->getGrid(true);
                    $grid->where( " and ".$grid->getAlias().'.'.$collum->getCollum().'=%s',$collum->getValue());
                    $grid->where( " and ".$grid->getAlias().'.'.$this->{"get{$collum->getUniqueWith()}"}()->getCollum().'=%s',$this->{"get{$collum->getUniqueWith()}"}()->getValue());
                        
                    if( $grid->getCount() > 0 )    
                    $val->addError ('notunique', $collum->getCollum(), 'Dvojice  '.$collum->getTitle().' a '.$this->{"get{$collum->getUniqueWith()}"}()->getTitle().' není jedinečná');
                }
                elseif($collum->isUnique() && $collum->getUniqueWith()==null )
                {
                    $grid = $this->getGrid(true);
                    $grid->where( " and ".$grid->getAlias().'.'.$collum->getCollum().'=%s',$collum->getValue());
                        
                    if( $grid->getCount() > 0 )    
                    $val->addError ('notunique', $collum->getCollum(), 'Položka '.$collum->getTitle().' není jedinečná');
                }
            }
        }
        elseif($action=='edit') {
            
            $old = $this->getGrid()->getByPk($this->get($this->getGrid()->getPrimaryKeyRaw())->getValue());

            foreach($this->getCollumsRaw() as $key=>$collum)
            {
                if($collum->isUnique() && $collum->getUniqueWith()!=null && is_array($collum->getUniqueWith()) )
                {
                  $same = true;  
                  if( $old->{"get{$collum->getCollum()}"}()->getValue() == $collum->getValue() )  
                  {
                    foreach( $collum->getUniqueWith() as $key2 => $c )
                        if( $old->{"get{$c}"}()->getValue() == $this->{"get{$c}"}()->getValue() )  {}
                        else {
                            $same = false;
                        }
                  } else $same = false;
                  
                  if(!$same)
                  {
                    $grid = $this->getGrid(true);
                    $grid->where( " and ".$grid->getAlias().'.'.$collum->getCollum().'=%s',$collum->getValue());
                    foreach( $collum->getUniqueWith() as $key2 => $c )
                        $grid->where( " and ".$grid->getAlias().'.'.$this->{"get{$c}"}()->getCollum().'=%s',$this->{"get{$c}"}()->getValue());                    
                    
                     if( $grid->getCount() > 0 )    
                    $val->addError ('notunique', $collum->getCollum(), 'Skupina není jedinečná');
                  }
                }
                elseif($collum->isUnique() && $collum->getUniqueWith()!=null && is_string($collum->getUniqueWith()) )
                {
                   
                  if( $old->{"get{$collum->getCollum()}"}()->getValue() != $collum->getValue() || $old->{"get{$collum->getCollum()}"}()->getValue() != $this->{"get{$collum->getUniqueWith()}"}()->getValue() )  
                  { 
                    $grid = $this->getGrid(true);
                    $grid->where( " and ".$grid->getAlias().'.'.$collum->getCollum().'=%s',$collum->getValue());
                    $grid->where( " and ".$grid->getAlias().'.'.$this->{"get{$collum->getUniqueWith()}"}()->getCollum().'=%s',$this->{"get{$collum->getUniqueWith()}"}()->getValue());
                        
                    if( $grid->getCount() > 0 )    
                    $val->addError ('notunique', $collum->getCollum(), 'Dvojice  '.$collum->getTitle().' a '.$this->{"get{$collum->getUniqueWith()}"}()->getTitle().' není jedinečná');
                  }
                }
                elseif($collum->isUnique() && $collum->getUniqueWith()==null )
                {
                  if( $old->{"get{$collum->getCollum()}"}()->getValue() != $collum->getValue() )  
                  { 
                    $grid = $this->getGrid(true);
                    $grid->where( " and ".$grid->getAlias().'.'.$collum->getCollum().'=%s',$collum->getValue());
                        
                    if( $grid->getCount() > 0 )    
                    $val->addError ('notunique', $collum->getCollum(), 'Položka '.$collum->getTitle().' není jedinečná');
                  }
                }
            }
        }
        
        return $val;
    }
    
    /**
     * 
     * @return int $newId
     */
    public function insert()
    {
        $id = $this->getGrid()->insert( $this->getCollumsInArray() );
        $this->set($this->getPrimaryKey()->getCollum(),$id);
        return $id;
    }
    
    
    /**
     *  update database record by primary key for all model defined collums
     * 
     *  @return Model_Model $this
     */
    public function update()
    {
        $this->getGrid()->updateByPK( $this->getCollumsForUpdate(), $this->getPrimaryKey()->getValue() );
        return $this;
    }
    
    
    public function delete()
    {
        $this->getGrid()->deleteByPK( $this->getPrimaryKey()->getValue() );
        return $this;
    }

    
    public function isLangAble()
    {
        $able = false;
        foreach($this->getModel() as $key=>$ch) {    
            if($ch->isDefault()&&$ch instanceof Model_Default_Lang)
            {
                return $ch;
            } 
        }
        
        return $able;
    }

    public function isUriAble()
    {
        $able = false;
        foreach($this->getModel() as $key=>$ch) {    
            if( ( $ch->isDefault() && $ch instanceof Model_Default_Uri )
             || ( $ch->isDefault() && $ch instanceof Model_Default_Trans && $ch->getCollumModel() instanceof Model_Default_Uri )       
             )
            {
                return $ch;
            } 
        }
        
        return $able;
    }

    
    
    public function isNestedAble()
    {
        $able = false;
        foreach($this->getModel() as $key=>$ch) {    
            if($ch->isDefault()&&$ch instanceof Model_Default_Nix)
            {
                return $ch;
            } 
        }
        
        return $able;
    }
    
    public function isDeletedAble()
    {
        $deletedAble = false;
        foreach($this->getModel() as $key=>$ch) {    
            if($ch->isDefault()&&$ch instanceof Model_Default_Deleted)
            {
                return $ch;
            } 
        }
        
        return $deletedAble;
    }
    
    public function isPhotoAble()
    {
        $able = false;
        foreach($this->getModel() as $key=>$ch) {    
            if($ch->isDefault()&&$ch instanceof Model_Default_Photo)
            {
                return $ch;
            } 
        }
        
        return $able;
    }

    public function isActiveAble()
    {
        $able = false;
        foreach($this->getModel() as $key=>$ch) {    
            if( ( $ch->isDefault()&&$ch instanceof Model_Default_Active )
             || ( $ch->isDefault() && $ch instanceof Model_Default_Trans && $ch->getCollumModel() instanceof Model_Default_Active )       
             )
            {
                return $ch;
            } 
        }
        
        return $able;
    }    
    
    public function isLastupdateAble()
    {
        $able = false;
        foreach($this->getModel() as $key=>$ch) {    
            if($ch->isDefault()&&$ch instanceof Model_Default_Lastupdate)
            {
                return $ch;
            } 
        }
        
        return $able;
    }        

    public function isParentIdAble()
    {
        $able = false;
        foreach($this->getModel() as $key=>$ch) {    
            if($ch->isDefault()&&$ch instanceof Model_Default_Parentid)
            {
                return $ch;
            } 
        }
        
        return $able;
    }    

    public function isRankAble()
    {
        $able = false;
        foreach($this->getModel() as $key=>$ch) {    
            if($ch->isDefault()&&$ch instanceof Model_Default_Rank)
            {
                return $ch;
            } 
        }
        
        return $able;
    }    

    public function isH1Able()
    {
        $able = false;
        foreach($this->getModel() as $key=>$ch) {    
            if( ( $ch->isDefault() && $ch instanceof Model_Default_H1 )
             || ( $ch instanceof Model_Default_Trans && $ch->getCollumModel() instanceof Model_Default_H1 )       
             )
            {
                return $ch;
            } 
        }
        
        return $able;
    }            
    

    public function isCreatedAble()
    {
        $able = false;
        foreach($this->getModel() as $key=>$ch) {    
            if($ch->isDefault() && $ch instanceof Model_Default_Created)
            {
                return $ch;
            } 
        }
        
        return $able;
    } 


    public function isPrivatePhotoAble()
    {
        $able = false;
        foreach($this->getModel() as $key=>$ch) {    
            if($ch->isDefault() && $ch instanceof Model_Default_Privatephoto)
            {
                return $ch;
            } 
        }
        
        return $able;
    } 

    public function isPerexAble()
    {
        $able = false;
        foreach($this->getModel() as $key=>$ch) {    
            if( ( $ch->isDefault() && $ch instanceof Model_Default_Perex )
             || ( $ch->isDefault() && $ch instanceof Model_Default_Trans && $ch->getCollumModel() instanceof Model_Default_Perex )       
             )
            {
                return $ch;
            } 
        }
        
        return $able;
    } 

    public function isContentAble()
    {
        $able = false;
        foreach($this->getModel() as $key=>$ch) {    
            if( ( $ch->isDefault() && $ch instanceof Model_Default_Content )
             || ( $ch->isDefault() && $ch instanceof Model_Default_Trans && $ch->getCollumModel() instanceof Model_Default_Content )       
             )
            {
                return $ch;
            } 
        }
        
        return $able;
    } 

    public function isOwnerIdAble()
    {
        $able = false;
        foreach($this->getModel() as $key=>$ch) {    
            if( $ch->isDefault() && $ch instanceof Model_Default_Ownerid )
            {
                return $ch;
            } 
        }
        
        return $able;
    }     

    public function isDateAble()
    {
        $able = false;
        foreach($this->getModel() as $key=>$ch) {    
            if( $ch->isDefault() && $ch instanceof Model_Default_Date )
            {
                return $ch;
            } 
        }
        
        return $able;
    }     
    
    public function isFileAble()
    {
        $able = false;
        foreach($this->getModel() as $key=>$ch) {    
            if( $ch->isDefault() && $ch instanceof Model_Default_File )
            {
                return $ch;
            } 
        }
        
        return $able;
    }         
    
    
    public function isGalleryAble()
    {
        $able = false;
        foreach($this->getRels() as $key=>$ch) {    
            if( $ch instanceof Model_Component_Gallery_Model )
            {
                return $ch;
            } 
        }
        
        return $able;
    }       

    public function isDocsAble()
    {
        $able = false;
        foreach($this->getRels() as $key=>$ch) {    
            if( $ch instanceof Model_Component_FilesGrid_Model && !$ch instanceof Model_Component_Gallery_Model)
            {
                return $ch;
            } 
        }
        
        return $able;
    }       
    
    
    /**
     * @return Model_Primitive database primary key model
     */
    public function getPrimaryKey()
    {
        foreach ($this->getModel() as $key=>$child)
            if($child->isPrimitive()&&$child->isPrimaryKey())
                return $child;
        return null;    
    }
}
