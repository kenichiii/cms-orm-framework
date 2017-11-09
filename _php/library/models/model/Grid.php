<?php

class Model_Grid
{
    protected $_title = 'Grid';
    
    protected $_modelClass = 'Model';
    protected $_table = ':db:table';
    protected $_alias = 'tb';
    
    protected $model;
    
    protected $whereStart = 'WHERE 1=1';
    protected $where   = array();    
    
    protected $groupBy = null;    
    
    protected $havingStart = 'HAVING 1=1';    
    protected $having  = array();
    
    protected $orderBy = null;
    
    protected $limit   = null;    
    
    
   
    protected $isTest = false;

    public static function getConn()
    {
        return App::getConn();
    }
    
    public function setTable($tbl)
    {
        $this->_table = $tbl;
        return $this;
    }

    public function getModelClassName()
    {
        return $this->_modelClass;
    }    
    
    public static function transactionCommit()
    {
         self::getConn()->query("COMMIT");
         self::getConn()->query("SET AUTOCOMMIT=1");
    }

    public static function transactionStart()
    {
          self::getConn()->query("SET AUTOCOMMIT=0");
          self::getConn()->query("START TRANSACTION");
    }

    public static function transactionRollback()
    {
          self::getConn()->query("ROLLBACK");
          self::getConn()->query("SET AUTOCOMMIT=0");          
    }
    
    
    public function setDeletedCond() {
        
        foreach($this->getModel()->getModel() as $key=>$child)
        {
            if($child->isModel())
            {
               if( $child->isJoin() )
               {
                   if($collum = $child->isDeletedAble())                   
                      $this->where(' and '.$child->getGrid()->getAlias($collum->getCollum()).'=0 ');                   
               }    
            }            
        }
        
            if( $c = $this->getModel()->isDeletedAble() )
            {               
               $this->where(' and '.$this->getAlias($c->getCollum()).'=0 ');
            }
                
        return $this;
    }

    public function setActiveCond() {
        foreach($this->getModel()->getModel() as $key=>$child)
        {
            if($child->isModel())
            {
               if( $child->isJoin() )
               {
                   if($collum = $child->isActiveAble())                   
                      $this->andWhere($child->getGrid()->getAlias($collum->getCollum()).'=1');                   
               }    
            }            
        }
        
            if( $c = $this->getModel()->isActiveAble() )
            {               
               $this->andWhere($this->getAlias($c->getCollum()).'=1');
            }
                
        return $this;
    }    

    public function setOwnerIdCond($ownerid) {     
        
            if( $c = $this->getModel()->isOwnerIdAble() )
            {               
               $this->where(' and '.$this->getAlias($c->getCollum()).'=%i',$ownerid);
            }
                
        return $this;
    }     

    public function setParentIdCond($parentid) {     
        
            if( $c = $this->getModel()->isParentIdAble() )
            {               
               $this->where( ' and '.$this->getAlias($c->getCollum()).'=%i',$parentid);
            }
                
        return $this;
    }     

    
    public function setLangCond($lang) {
        foreach($this->getModel()->getModel() as $key=>$child)
        {
            if($child->isModel())
            {
               if( $child->isJoin() )
               {
                   if($collum = $child->isLangAble())                   
                      $this->andWhere($child->getGrid()->getAlias($collum->getCollum())."=%s",$lang);                   
               }    
            }            
        }
        
            if( $c = $this->getModel()->isLangAble() )
            {               
               $this->andWhere($this->getAlias($c->getCollum())."=%s",$lang);
            }
                
        return $this;
    }        

    public function setRankOrderByCond($how=null) {

            if( $c = $this->getModel()->isRankAble() )
            {                
               $this->orderBy($this->getAlias($c->getCollum())." ".($how?$how:$c->getSorting()));
            }
                
        return $this;
    }            
    
    public function getName()
    {
        return 'grid_'.$this->getModel()->getRawName();
    }   
    
    public function isTest()
    {
        return $this->isTest;
    }

    public function setIsTest($bool)
    {
        $this->isTest = $bool;
        return $this;
    }
    
    public static function test($query)
    {
        ob_start(); 
        self::getConn()->test($query);
        $sql = ob_get_clean();
        return strip_tags($sql);
    }
    
    public function getData()
    {
        $query []= 'SELECT '.implode(',',$this->getCollums()).' FROM '.$this->getTable().' '.$this->whereStart;
        
        foreach($this->where as $key=>$w)
           if(count($w)==1)
            array_push($query, $w[0]);
           else    
            array_push($query, $w[0],$w[1]);
        
        if($this->groupBy) array_push($query,$this->groupBy);           
           
        if(count($this->having)) 
        {
            array_push($query, $this->havingStart);
            foreach($this->having as $key=>$w)
               if(count($w)==1)
                array_push($query, $w[0]);
               else    
                array_push($query, $w[0],$w[1]);

        }           
        
        if($this->orderBy) array_push($query,$this->orderBy);
        
        if($this->limit)   array_push($query,$this->limit);
        
        if($this->isTest()) return self::test ($query);
        
        $data = array();                
        
        foreach (self::getConn()->fetchAll($query) as $key => $value) {
            $data [$key]= $this->getModel(true);
            $data [$key]->fromdb($value);
        }
        
        return $data;
    }        

    public function getSingle()
    {
        $query []= 'SELECT '.implode(',',$this->getCollums()).' FROM '.$this->getTable().' '.$this->whereStart;
        
        foreach($this->where as $key=>$w)
           if(count($w)==1)
            array_push($query, $w[0]);
           else    
            array_push($query, $w[0],$w[1]);
        
        if($this->groupBy) array_push($query,$this->groupBy);   
           
        if(count($this->having)) 
        {
            array_push($query, $this->havingStart);
            foreach($this->having as $key=>$w)
               if(count($w)==1)
                array_push($query, $w[0]);
               else    
                array_push($query, $w[0],$w[1]);

        }                   
        
        if($this->orderBy) array_push($query,$this->orderBy);
        
        if($this->limit)   array_push($query,$this->limit);
        
         if($this->isTest()) return self::test ($query);   
        
         $data = self::getConn()->fetch($query);   
           
         if($data)
         {
             $bean = $this->getModel(true);
             $bean->fromdb($data);
             
             return $bean;
         }
         else return null;   
        
    }     
    
    public function getByPk($pk,$test=false)
    {
        $query []= 'SELECT '.implode(',',$this->getCollums()).' FROM '.$this->getTable().' '.$this->whereStart;
               
            array_push($query, ' and '.$this->getAlias($this->getPrimaryKeyRaw()).'='.$this->getModel()->getPrimaryKey()->getDibiMod(),$pk);

        if($this->isTest()) return self::test ($query);
            
         $data = self::getConn()->fetch($query);   
         
         if($data)
         {
             $bean = $this->getModel(true);
             $bean->fromdb($data);
             
             return $bean;
         }
         else return null;   
        
    }    
    
    
    public function getCount($selector='*')
    {
                                                       //can be used in having
        //$query []= 'SELECT count('.$selector.'),'.implode(',',$this->getCollums()).' FROM '.$this->getTable().' '.$this->whereStart;
        $query []= 'SELECT count('.$selector.') FROM '.$this->getTable().' '.$this->whereStart;
        foreach($this->where as $key=>$w)
           if(count($w)==1)
            array_push($query, $w[0]);
           else    
            array_push($query, $w[0],$w[1]);
        
        if($this->groupBy) array_push($query,$this->groupBy);   
           
        if(count($this->having)) 
        {
            array_push($query, $this->havingStart);
            foreach($this->having as $key=>$w)
               if(count($w)==1)
                array_push($query, $w[0]);
               else    
                array_push($query, $w[0],$w[1]);

        }                   
        
        if($this->isTest()) return self::test ($query);
        
        return self::getConn()->fetchSingle($query);
    }    
    
    public function clearWhere()
    {
        $this->where = array();
        return $this;
    }
    
    public function andWhere($where,$values=null)
    {
        $test_own_single_collum = str_replace($this->getAlias().'.[', '', str_replace(']', '', $where));
        if(in_array( $test_own_single_collum, array_keys($this->getModel()->getCollumsInArray())))
            return $this->where(' and '.$where.'='.$this->getModel()->get($test_own_single_collum)->getDibiMod(),$values);
        else         
            return $this->where(' and '.$where,$values);
    }

    public function orWhere($where,$values=null)
    {
        $test_own_single_collum = str_replace($this->getAlias().'.[', '', str_replace(']', '', $where));
        if(in_array( $test_own_single_collum, array_keys($this->getModel()->getCollumsInArray())))
            return $this->where(' or '.$where.'='.$this->getModel()->get($test_own_single_collum)->getDibiMod(),$values);
        else
            return $this->where(' or '.$where,$values);
    }    
    
    public function where($where,$values=null)
    {
        if($values===null)
        {
            $this->where []= array(' '.$where.' ');
        }
        else
        $this->where []= array(' '.$where.' ',$values);
        
        return $this;
    }    
    
    public function clearHaving()
    {
        $this->having = array();
        return $this;
    }
    
    public function andHaving($where,$values=null)
    {
        return $this->having(' and '.$where,$values);
    }

    public function orHaving($where,$values=null)
    {
        return $this->having(' or '.$where,$values);
    }    
    
    public function having($where,$values=null)
    {
        if($values===null)
        {
            $this->having []= array($where);
        }
        else
        $this->having []= array($where,$values);
        
        return $this;
    }      
    
    public function clearOrderBy()
    {
        $this->orderBy = null;        
        return $this;
    }
    
    public function orderBy($orderby)
    {
        $this->orderBy = ' ORDER BY '.$this->orderBy.' '.$orderby;        
        return $this;
    }

    public function clearGroupBy()
    {
        $this->groupBy = null;        
        return $this;
    }
    
    public function groupBy($cond)
    {
        $this->groupBy = ' GROUP BY '.$this->groupBy.' '.$cond;        
        return $this;
    }    
    
    public function clearLimit() 
    {        
        $this->limit = null;
        return $this;
    }
    
    public function limit($limit,$perPage=null)
    {
        if($perPage!=null)
            $this->limit = ' LIMIT '.intval($limit).','.intval ($perPage);
        else
            $this->limit = ' LIMIT '.intval($limit);
        
        return $this;
    }    
    
    public function clear()
    {
        $this->clearWhere()->clearHaving()->clearGroupBy()->clearOrderBy()->clearLimit();
        return $this;
    }
        
    public function getCollums($prefix='')
    {
        $collums = array();
        
        foreach($this->getModel()->getModel() as $key=>$child)
        {
            if($child->isModel())
            {
               if( $child->isJoin() )
               {
                   foreach( $child->getGrid()->getCollums($key.'_') as $m=>$coll )
                   {
                       $collums []= $coll;
                   }
               }    
            }
            elseif( $child->isMixed() )
            {
                foreach( $this->getCollumsMixed($child) as $m=>$coll)
                {
                    $collums []= $coll;
                }
            }
            elseif( $child->isInnerSql() )
            {
               $collums []= $child->getValue().' as '.$prefix.$key;  
            }
            else //primitive
              $collums []= $this->getAlias ($child->getCollum()).' as ['.$prefix.$key.']';  
        }
        
        return $collums;
    }
    
    public function getCollumsMixed($mixed)
    {
        $collums = array();
        foreach( $mixed->getModel() as $key => $child )
        {
            if( $child->isMixed() )
            {
                foreach( $this->getCollumsMixed() as $m=>$coll)
                {
                    $collums []= $coll;
                }
            }
            else //primitive
              $collums []= $this->getAlias ($child->getCollum()).' as ['.$child->getCollum().']';  
        }
        
        return $collums;
    }
    
    public function getTable()
    {
        $t = '['.$this->_table.'] as '.$this->getAlias();        
        foreach($this->getModel()->getModel() as $key=>$child)
        {
            if($child->isModel())
            {
               if( $child->isJoin() )
                $t.= ' left join ['.$child->getGrid()->getTableRaw().'] as '.$child->getGrid()->getAlias().' '
                       . 'on '.$child->getGrid()->getAlias($child->getJoinFrom()).'='.$this->getAlias($child->getJoinTo());    
               //else is1N isNN isN1
            }
            
        }
        
        return $t;
    }
    
    public function getTableRaw()
    {
        return $this->_table;
    }    
    
    public function getPrimaryKeyRaw()
    {
        foreach($this->getModel()->getModel() as $key => $coll)
        {
            if($coll->isPrimaryKey())
            {                
                return $key;
            }
        }        
        throw new Exception("{$this->_name} grid has not found PK in {$this->model->getName()}");
    }
    
    public function insert($data)
    {
        if($this->isTest()) return self::test (self::getConn()->insert($this->getTableRaw(), $data));
        self::getConn()->insert($this->getTableRaw(), $data)->execute();        
        
        return self::getConn()->insertId();
    }        
    
    public function updateByPK($data, $pk)
    {                
        $query = array('UPDATE ['.$this->getTableRaw().'] SET ', $data, 'WHERE  ['.$this->getPrimaryKeyRaw().']='.$this->getModel()->getPrimaryKey()->getDibiMod(), $pk);
        if($this->isTest()) return self::test ($query);
        return self::getConn()->query($query);
    }    
  
    public function deleteByPK($pk)
    {
        $query = array('DELETE FROM ['.$this->getTableRaw().'] WHERE ['.$this->getPrimaryKeyRaw().']='.$this->getModel()->getPrimaryKey()->getDibiMod(), $pk);
        if($this->isTest()) return self::test ($query);
        return self::getConn()->query($query);
    }
    
    public function getTitle()
    {
        return $this->_title;
    }
    
    public function getAlias($collum=null)
    {
        if($collum==null)
        return '['.$this->_alias.']';
        else 
         return $this->getAlias ().'.['.$collum.']';
                
    }    
    
    public function setAlias($a)
    {
        $this->_alias = $a;
        return $this;
    }        
    
    public function getModel($fresh=false)
    {
        if($this->model===null||$fresh) $this->model = new $this->_modelClass();
        
        return $this->model;
    }
    
    public function createTable($innoDB=true)
    {
       $row = array(); 
       $indexes = array();
       
       foreach($this->getModel()->getModel() as $key=>$child)
       {
        if( $child->isMixed() )
        {
            foreach( $child->getCollumsRaw() as $key2 => $collum )
            {
                if( $collum->isInnerSql() ) continue;
                
                $query = '`'.$collum->getCollum().'` '.$collum->getSqlType();
                if( $collum->isNotNull() ) $query .= ' NOT NULL ';
                if( $collum->getDefault()!==null ) { $query .= " DEFAULT '{$collum->getDefault()}'"; }
                if( $collum->isPrimaryKey() ) 
                {
                    $query .= " AUTO_INCREMENT ";
                    $indexes []= 'PRIMARY KEY ('.$collum->getCollum().')';
                }
                
                $row []= $query;
                
                if($collum->isKey()) $indexes []= 'INDEX `'.$collum->getCollum().'` ('.$collum->getCollum().')';
                if($collum->isUnique())
                {
                    if($collum->getUniqueWith()==null)
                        $indexes []= 'UNIQUE INDEX `'.$collum->getCollum().'` ('.$collum->getCollum().')';
                    elseif(is_string($collum->getUniqueWith()))
                        $indexes []= 'UNIQUE INDEX `'.$collum->getCollum().'_'.$collum->getUniqueWith().'` ('.$collum->getCollum().','.$collum->getUniqueWith().')';
                    elseif(is_array($collum->getUniqueWith()))
                        $indexes []= 'UNIQUE INDEX `'.$collum->getCollum().'_'.$collum->getUniqueWith().'` ('.$collum->getCollum().','.implode(',',$collum->getUniqueWith()).')';
                }
            }
        }
        elseif( $child->isPrimitive() )
        {
            if( ! $child->isInnerSql() )
             {   
                $collum = $child;
                
                $query = '`'.$collum->getCollum().'` '.$collum->getSqlType();
                if( $collum->isNotNull() ) $query .= ' NOT NULL ';
                if( $collum->getDefault()!=null ) { $query .= " DEFAULT '{$collum->getDefault()}'"; }
                
                if( $collum->isPrimaryKey() ) 
                {
                    $query .= " AUTO_INCREMENT ";
                    $indexes []= 'PRIMARY KEY ('.$collum->getCollum().')';
                }
                
                $row []= $query;
                
                if($collum->isKey()) $indexes []= 'INDEX `key-'.$collum->getCollum().'` ('.$collum->getCollum().')';
                if($collum->isUnique())
                {
                    if($collum->getUniqueWith()==null)
                        $indexes []= 'UNIQUE INDEX `uni-'.$collum->getCollum().'` ('.$collum->getCollum().')';
                    elseif(is_array($collum->getUniqueWith()))
                        $indexes []= 'UNIQUE INDEX `uni-'.$collum->getCollum().'_'.implode('_',$collum->getUniqueWith()).'` ('.$collum->getCollum().','.implode(',',$collum->getUniqueWith()).')';
                }

             }
        }
        
        
    }                
    
    $query = 'CREATE TABLE `'.$this->getTableRaw().'` ( ' .implode(",",$row);
    if( count($indexes) ) $query .= ',' . implode(',',$indexes);
    $query .= ' ) ENGINE=InnoDB ';
    
    return $query;
   }
   
   public function alterTable($dbname)
   {
       $query = '';
       
       $table = str_replace(':db:',  Project::$databasePrefix,$this->getTableRaw());
       $model = $this->getModel();
       
       $dbindexes = self::getConn()->fetchAll('SHOW INDEX FROM '.$table.' FROM '.$dbname);
       $dbschema = self::getConn()->fetchAll("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '{$dbname}' AND TABLE_NAME = '{$table}'");              
       
       $modelCollums = $this->getAlterCollums();
       $foundedDbCollumsInModel = array();
       
       foreach($dbschema as $key=>$dbcollum)
       {
          
           if(in_array($dbcollum['COLUMN_NAME'], $modelCollums) )
           {
               $foundedDbCollumsInModel[]=$dbcollum['COLUMN_NAME'];               
               
               if(strtolower($model->get($dbcollum['COLUMN_NAME'])->getSqlName())!=$dbcollum['DATA_TYPE'])
               {
                   $query .= "\n\n".'alter table ['.$this->getTableRaw().'] modify ['
                                 . $model->get($dbcollum['COLUMN_NAME'])->getCollum()."] ".$model->get($dbcollum['COLUMN_NAME'])->getSqlType();
                            if( $model->get($dbcollum['COLUMN_NAME'])->isNotNull() ) $query .= ' NOT NULL ';
                            if( $model->get($dbcollum['COLUMN_NAME'])->getDefault()!=null ) { $query .= " DEFAULT '{$model->get($dbcollum['COLUMN_NAME'])->getDefault()}'"; }

               }
               
               if($model->get($dbcollum['COLUMN_NAME'])->isPrimaryKey())
               {
                   if($dbcollum['COLUMN_KEY']!='PRI')
                   {
                     if($dbcollum['COLUMN_KEY']=='MUL')  
                     {                       
                       if($exstKeys = $this->getAlterCollumnKeysInfo($dbcollum['COLUMN_NAME'],$dbindexes))
                       {
                           foreach($exstKeys as $pkek=>$pkekey)
                               $query .= "\n\n"."DROP INDEX `{$pkekey['Key_name']}` ON {$this->getTableRaw()};";
                       }
                     }
                     
                     foreach($dbschema as $pkkey=>$pkchild)
                         if($pkchild['COLUMN_KEY']=='PRI'&&$dbcollum['COLUMN_NAME']!=$pkchild['COLUMN_NAME'])
                         {
                             $query .= "\n\n".'ALTER TABLE '.$this->getTableRaw().' MODIFY '.$pkchild['COLUMN_NAME'].' INT NOT NULL;';
                             $query .= "\n".'ALTER TABLE '.$this->getTableRaw().' DROP PRIMARY KEY'; 
                             //DROP INDEX `PRIMARY` ON t;
                         }
                     
                     $query .= "\n\n".'ALTER TABLE '.$this->getTableRaw().' ADD PRIMARY KEY('.$dbcollum['COLUMN_NAME'].");";
                   }
               }                                             
               
               if($model->get($dbcollum['COLUMN_NAME'])->getDefault()!==null)
               {
                   if($dbcollum['COLUMN_DEFAULT']!=$model->get($dbcollum['COLUMN_NAME'])->getDefault())
                   {
                    $query .= "\n\n ALTER TABLE {$this->getTableRaw()} MODIFY "
                        .$model->get($dbcollum['COLUMN_NAME'])->getCollum()." ".$model->get($dbcollum['COLUMN_NAME'])->getSqlType();
                    if( $model->get($dbcollum['COLUMN_NAME'])->isNotNull() ) $query .= ' NOT NULL ';
                    if( $model->get($dbcollum['COLUMN_NAME'])->getDefault()!=null ) { $query .= " DEFAULT '{$model->get($dbcollum['COLUMN_NAME'])->getDefault()}'"; }
                    $query .= ";";                                                                     
                   }
               }               
              else 
              {
                   if($dbcollum['COLUMN_DEFAULT']!='')
                   {
                    $query .= "\n\n ALTER TABLE {$this->getTableRaw()} MODIFY "
                        .$model->get($dbcollum['COLUMN_NAME'])->getCollum()." ".$model->get($dbcollum['COLUMN_NAME'])->getSqlType();
                    if( $model->get($dbcollum['COLUMN_NAME'])->isNotNull() ) $query .= ' NOT NULL ';
                    if( $model->get($dbcollum['COLUMN_NAME'])->getDefault()!=null ) { $query .= " DEFAULT NULL"; }
                    $query .= ";";                                                                     
                   }                  
              }
               
               if($model->get($dbcollum['COLUMN_NAME'])->isNotNull())
               {
                   if($dbcollum['IS_NULLABLE']=='YES')
                   {
                    $query .= "\n\n ALTER TABLE {$this->getTableRaw()} MODIFY "
                        .$model->get($dbcollum['COLUMN_NAME'])->getCollum()." ".$model->get($dbcollum['COLUMN_NAME'])->getSqlType();
                    $query .= ' NOT NULL ';
                    if( $model->get($dbcollum['COLUMN_NAME'])->getDefault()!=null ) { $query .= " DEFAULT '{$model->get($dbcollum['COLUMN_NAME'])->getDefault()}'"; }
                    $query .= ";";                                              
                   }
               }
               else
               {
                   if($dbcollum['IS_NULLABLE']=='NO'&&!$model->get($dbcollum['COLUMN_NAME'])->isPrimaryKey())
                   {
                    $query .= "\n\n ALTER TABLE {$this->getTableRaw()} MODIFY "
                        .$model->get($dbcollum['COLUMN_NAME'])->getCollum()." ".$model->get($dbcollum['COLUMN_NAME'])->getSqlType();
                    $query .= ' NULL ';
                    if( $model->get($dbcollum['COLUMN_NAME'])->getDefault()!=null ) { $query .= " DEFAULT '{$model->get($dbcollum['COLUMN_NAME'])->getDefault()}'"; }
                    $query .= ";";                       
                   }                   
               }
               
               if($model->get($dbcollum['COLUMN_NAME'])->isKey())
               {                   
                   if($dbcollum['COLUMN_KEY']=='MUL')
                   {
                     if(!$exstKey = $this->getAlterCollumnKeyInfo($dbcollum['COLUMN_NAME'],$dbindexes,'Non_unique',1))  
                     {
                       $query .= "\n\n ALTER TABLE `{$this->getTableRaw()}` ADD INDEX `key-{$model->get($dbcollum['COLUMN_NAME'])->getCollum()}` (`{$model->get($dbcollum['COLUMN_NAME'])->getCollum()}`);";                         
                     }                                            
                   }
                   else
                   {
                       $query .= "\n\n ALTER TABLE `{$this->getTableRaw()}` ADD INDEX `key-{$model->get($dbcollum['COLUMN_NAME'])->getCollum()}` (`{$model->get($dbcollum['COLUMN_NAME'])->getCollum()}`);";
                   }

               }
               else 
               {
                   if($dbcollum['COLUMN_KEY']=='MUL')
                   {
                     if($exstKey = $this->getAlterCollumnKeyInfo($dbcollum['COLUMN_NAME'],$dbindexes,'Non_unique',1))  
                     {
                         $query .= "\n\n"."DROP INDEX `{$exstKey['Key_name']}` ON {$this->getTableRaw()};";
                     }                       
                   }
               }
               
               
               if($model->get($dbcollum['COLUMN_NAME'])->isUnique())
               {
                         if($dbcollum['COLUMN_KEY']=='UNI'||$dbcollum['COLUMN_KEY']=='MUL')
                         {
                                               
                                  $passed = true;
                     
                                        if(!$exst = $this->getAlterCollumnKeyInfo($dbcollum['COLUMN_NAME'],$dbindexes,'Non_unique',0))
                                        {
                                            $passed = false;
                                        }
                                        else
                                        {
                                            if($model->get($dbcollum['COLUMN_NAME'])->getUniqueWith())
                                            {                                                
                                                $unique_used = array();
                                                foreach ($model->get($dbcollum['COLUMN_NAME'])->getUniqueWith() as $ukey => $anotherUnique) 
                                                {
                                                    if($anotherExst = $this->getAlterCollumnKeyInfo($anotherUnique,$dbindexes,'Key_name',$exst['Key_name']))  
                                                    {
                                                        
                                                       $unique_used[]=$anotherExst['Column_name'];                                     
                                                    } else $passed = false;
                                                }
                                                
                                                $unique_used []= $dbcollum['COLUMN_NAME'];
                                                foreach ($dbindexes as $ikey => $i)
                                                {
                                                    if($i['Key_name']==$exst['Key_name']&&!in_array($i['Column_name'], $unique_used))
                                                    {
                                                        $passed = false;
                                                    }
                                                }

                                             }
                                             
                                            if(!$passed)
                                            {
                                               $query .= "\n\n"."DROP INDEX `{$exst['Key_name']}` ON {$this->getTableRaw()};";                                                
                                            }
                                        }
                    
                     
                             if(!$passed)
                             {                     
                                if($model->get($dbcollum['COLUMN_NAME'])->getUniqueWith()==null)
                                    $query .= "\n\n ALTER TABLE `{$this->getTableRaw()}` ADD UNIQUE INDEX `uni-{$model->get($dbcollum['COLUMN_NAME'])->getCollum()}` (`{$model->get($dbcollum['COLUMN_NAME'])->getCollum()}`);";
                                elseif(is_array($model->get($dbcollum['COLUMN_NAME'])->getUniqueWith()))
                                    $query .= "\n\n ALTER TABLE `{$this->getTableRaw()}` ADD UNIQUE INDEX `uni-{$model->get($dbcollum['COLUMN_NAME'])->getCollum()}` ({$model->get($dbcollum['COLUMN_NAME'])->getCollum()},".implode(',',$model->get($dbcollum['COLUMN_NAME'])->getUniqueWith()).");";                            
                             }                                           
                        } //end if MUL
                        else
                        {
                            if($model->get($dbcollum['COLUMN_NAME'])->getUniqueWith()==null)
                                $query .= "\n\n ALTER TABLE `{$this->getTableRaw()}` ADD UNIQUE INDEX `uni-{$model->get($dbcollum['COLUMN_NAME'])->getCollum()}` (`{$model->get($dbcollum['COLUMN_NAME'])->getCollum()}`);";
                            elseif(is_array($model->get($dbcollum['COLUMN_NAME'])->getUniqueWith()))
                                $query .= "\n\n ALTER TABLE `{$this->getTableRaw()}` ADD UNIQUE INDEX `uni-{$model->get($dbcollum['COLUMN_NAME'])->getCollum()}` ({$model->get($dbcollum['COLUMN_NAME'])->getCollum()},".implode(',',$model->get($dbcollum['COLUMN_NAME'])->getUniqueWith()).");";                            
                        }
                        
               }
               else 
               {
                                        if( !$model->get($dbcollum['COLUMN_NAME'])->isPrimaryKey() &&  $exst = $this->getAlterCollumnKeyInfo($dbcollum['COLUMN_NAME'],$dbindexes,'Non_unique','0'))
                                        {
                                            if($exst['Seq_in_index']==1)
                                                $query .= "\n\n"."DROP INDEX `{$exst['Key_name']}` ON {$this->getTableRaw()};";
                                        }
                   
               }
               
               
               if($model->get($dbcollum['COLUMN_NAME']) instanceof Model_Primitive_Int
                ||$model->get($dbcollum['COLUMN_NAME']) instanceof Model_Primitive_Decimal
                ||$model->get($dbcollum['COLUMN_NAME']) instanceof Model_Primitive_Varchar)
               {
                  if(strtolower($model->get($dbcollum['COLUMN_NAME'])->getSqlType())!=$dbcollum['COLUMN_TYPE'])
                  {
                    $query .= "\n\n ALTER TABLE {$this->getTableRaw()} MODIFY "
                           . $model->get($dbcollum['COLUMN_NAME'])->getCollum()." ".$model->get($dbcollum['COLUMN_NAME'])->getSqlType();
                    if( $model->get($dbcollum['COLUMN_NAME'])->isNotNull() ) $query .= ' NOT NULL ';
                    if( $model->get($dbcollum['COLUMN_NAME'])->getDefault()!=null ) { $query .= " DEFAULT '{$model->get($dbcollum['COLUMN_NAME'])->getDefault()}'"; }
                    $query .= ";";
                  }
                    
               }
               
               
               
               
               
           } //end if in array get alter collums
           else
           {
               
                //drop keys
               if($exstKeys = $this->getAlterCollumnKeysInfo($dbcollum['COLUMN_NAME'],$dbindexes))
               {
                 foreach($exstKeys as $ekey=>$ek)  
                   $query .= "\n\n"."DROP INDEX `{$ek['Key_name']}` ON {$this->getTableRaw()};";
               }
               
                //drop collum
               $query .= "\n\n".'ALTER TABLE '.$this->getTableRaw().' DROP COLUMN '.$dbcollum['COLUMN_NAME'].";";
           }
       }
       
       foreach ($modelCollums as $key => $modelCollum) 
       {
           if(!in_array($modelCollum, $foundedDbCollumsInModel) )
           {
               //add collum
                            $query .= "\n\n ALTER TABLE {$this->getTableRaw()} ADD "
                                   . $model->get($modelCollum)->getCollum()." ".$model->get($modelCollum)->getSqlType();
                            if( $model->get($modelCollum)->isNotNull() ) $query .= ' NOT NULL ';
                            if( $model->get($modelCollum)->getDefault()!=null ) { $query .= " DEFAULT '{$model->get($modelCollum)->getDefault()}'"; }
                            $query .= ";";               

               if($model->get($modelCollum)->isKey()) 
               {
                   $query .= "\n\n ALTER TABLE `{$this->getTableRaw()}` ADD INDEX `key-{$model->get($modelCollum)->getCollum()}` (`{$model->get($modelCollum)->getCollum()}`);";
               }
               
               if($model->get($modelCollum)->isUnique())
               {
                    if($model->get($modelCollum)->getUniqueWith()==null)
                        $query .= "\n\n ALTER TABLE `{$this->getTableRaw()}` ADD UNIQUE INDEX `uni-{$model->get($modelCollum)->getCollum()}` (`{$model->get($modelCollum)->getCollum()}`);";
                    elseif(is_array($model->get($modelCollum)->getUniqueWith()))
                        $query .= "\n\n ALTER TABLE `{$this->getTableRaw()}` ADD UNIQUE INDEX `uni-{$model->get($modelCollum)->getCollum()}` ({$model->get($modelCollum)->getCollum()},".implode(',',$model->get($modelCollum)->getUniqueWith()).");";
                }

           }
       }
       
       $query .= "\n\n".'# END COMPARING'.";";
       
       return $query;
   }
   
   public function getAlterCollumnKeysInfo($collum,$indexes)
   {
       $ret = array();
       foreach($indexes as $key=>$value)
       {
           if($value['Column_name']==$collum) $ret []= $value;
       }       
       return count($ret>0)?$ret:null;
   }
   
   public function getAlterCollumnKeyInfo($collum,$indexes,$key=null,$keyValue=null)
   {
       foreach($indexes as $ikey=>$value)
       {
           if($key )
           { if($value['Column_name']==$collum && $value[$key]==$keyValue) return $value;}
           else
           { if($value['Column_name']==$collum) return $value; }
       }
       return null;
   }
   
   public function getAlterCollums()
   {
        $collums = array();
        
        foreach($this->getModel()->getModel() as $key=>$child)
        {
            if( $child->isMixed() )
            {
                foreach( $this->getAlterCollumsMixed($child) as $m=>$coll)
                {
                    $collums []= $coll;
                }
            }
            elseif( $child->isInnerSql() )
            {
               
            }
            elseif( $child->isPrimitive() ) //primitive
              $collums []= $child->getCollum();  
        }
        
        return $collums;
    }
    
    public function getAlterCollumsMixed($mixed)
    {
        $collums = array();
        foreach( $mixed->getModel() as $key => $child )
        {
            if( $child->isMixed() )
            {
                foreach( $this->getAlterCollumsMixed() as $m=>$coll)
                {
                    $collums []= $coll;
                }
            }
            elseif( $child->isPrimitive() ) //primitive
              $collums []= $child->getCollum();  
        }
        
        return $collums;
    }
}

