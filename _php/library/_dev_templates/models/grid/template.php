[[

class <?php echo $class ?> <?php if($extends) { ?>extends <?php echo $extends; } ?>

{
    
    protected $_title = '<?php echo $title ?>';
    
    protected $_modelClass = '<?php echo $model ?>';
    
    protected $_table = '<?php echo $table ?>';
    protected $_alias = '<?php echo $alias ?>';
    
<?php        
          
    if(isset($collum_class))
    {
                foreach($collum_class as $ckey => $cClass  )
                {
                    if($cClass)
                    {
?>
    
<?php if($collum_key[$ckey]) { ?>

            /**
             * return grid with key cond <?php echo $collum_name[$ckey]; ?>
             *
             *
             * @param <?php $i=new $collum_class[$ckey]();echo($i instanceof Model_Primitive_Int)?'int':'string'?> $key
             * @return \<?php echo $grid ?>
            
             */            
            public static function set<?php $by = $collum_name[$ckey]; $by[0]=strtoupper($by[0]); echo $by; ?>Cond($key)
            {
                $this->andWhere($model->getGrid()->getAlias('<?php echo $collum_name[$ckey]; ?>').'=<?php $i=new $collum_class[$ckey]();echo($i instanceof Model_Primitive_Int)?'%i':'%s'?>',$key);
                return $this;
            }   
        
<?php } ?>

<?php 

    if(class_exists($collum_class[$ckey]))
    {
        $collum_ins = new $collum_class[$ckey]();
        
        if($collum_ins instanceof Model_Primitive_Enum && !$collum_key[$ckey])
        {
?>

            /**
             * return grid with key cond <?php echo $collum_name[$ckey]; ?>
             *
             *
             * @param <?php $i=new $collum_class[$ckey]();echo($i instanceof Model_Primitive_Int)?'int':'string'?> $key
             * @return \<?php echo $grid ?>
            
             */            
            public static function set<?php $by = $collum_name[$ckey]; $by[0]=strtoupper($by[0]); echo $by; ?>Cond($key)
            {
                $this->andWhere($model->getGrid()->getAlias('<?php echo $collum_name[$ckey]; ?>').'=<?php $i=new $collum_class[$ckey]();echo($i instanceof Model_Primitive_Int)?'%i':'%s'?>',$key);
                return $this;
            }               
            
            
<?php            
        } //end bit
        
        
        if($collum_ins instanceof Model_Primitive_Bit)
        {
?>

            /**
             * return grid with where set to 1 cond for <?php echo $collum_name[$ckey]; ?>
             *
             *
             * @return \<?php echo $grid ?>
            
             */            
            public static function set<?php $by = $collum_name[$ckey]; $by[0]=strtoupper($by[0]); echo $by; ?>OnCond()
            {
                $this->andWhere($model->getGrid()->getAlias('<?php echo $collum_name[$ckey]; ?>').'=1');
                return $this;
            }   
            
            /**
             * return grid with where set to 0 cond for <?php echo $collum_name[$ckey]; ?>
             * 
             *
             * @return \<?php echo $grid ?>
            
             */            
            public static function set<?php $by = $collum_name[$ckey]; $by[0]=strtoupper($by[0]); echo $by; ?>OffCond()
            {
                $this->andWhere($model->getGrid()->getAlias('<?php echo $collum_name[$ckey]; ?>').'=0');
                return $this;
            }   
            
<?php            
        } //end bit
        
    }        
?>
                                                
<?php } } } //end collums ?>            

<?php if(isset($children)) { foreach($children as $key=>$child) { ?>                          
            
<?php                 
 if($child=='rank' && in_array('parentId',$children) )
      {
?>            
            /**
             * return max rank from current parent group
             *
             *
             * @param int $parentId
             * @return int $maxRank
            
             */
            public function getMaxRank($parentid)
            {
              return self::getConn()->fetchSingle("select max([rank]) from [".$this->getTableRaw()."] 
                where [parentid]=%i<?php if(in_array('deleted',$children)){ ?> and deleted=0<?php } ?>", $parentid );                
            }            

            /**
             * set parentId and rank 
             * FOR ASCENDING LISTS             
             * <?php if(in_array('lastupdate',$children)){ ?>lastUpdate is actualised <?php } ?>  
             * 
             * @param int $id             
             * @param int $parentId
             * @param int|'none' $prevItemId
             * @param int|'none' $nextItemId
             * @return \<?php echo $class ?>
            
             */                
            public function moveToParentAction($id,$parentId,$prevItemId='none',$nextItemId='none')
            {
                            
                        if($prevItemId!='none') {
                                    $prev = <?php echo $model ?>::loadById($prevItemId);
                                    $prev_rank = $prev->getRank()->getValue();
                                    $prev_parentid = $prev->getParentid()->getValue();
                        } elseif( $nextItemId != 'none' ) {
                                    $next = <?php echo $model ?>::loadById( $nextItemId );
                                    $prev = true;
                                    $prev_rank = 0;
                                    $prev_parentid = $next->getParentid()->getValue();
                          }

                                if(isset($prev) )
                                {
                                 <?php if(in_array('lastupdate',$children)) {  ?>          
                                    self::getConn()->query("update [".$this->getTableRaw()."] set [rank]=[rank]+1,[lastupdate]=%t where [rank] > %i and [parentid]=%i",
                                        date('Y-m-d G:i:s'),$prev_rank,$prev_parentid
                                             );
                                  <?php } else { ?>
                                    self::getConn()->query("update [".$this->getTableRaw()."] set [rank]=[rank]+1 where [rank] > %i and [parentid]=%i",
                                        $prev_rank,$prev_parentid
                                             );                                             
                                  <?php } ?>                
                                             
                                    self::getConn()->query("update [".$this->getTableRaw()."] set [rank]=%i,[parentid]=%i where [id]=%i",
                                        $prev_rank+1,$prev_parentid,$id
                                             );
                                }
                                else {

                                    self::getConn()->query("update [".$this->getTableRaw()."] set [rank]=%i,[parentid]=%i where [id]=%i",
                                        1,$parentId,$id
                                            );
                                }    
                        
                            <?php 
                                  if(in_array('lastupdate',$children))
                                  {
                            ?>          
                        self::getConn()->query("update [{$this->getTableRaw()}] set [lastupdate]=%t where [id]=%i or [id]=%i",date('Y-m-d G:i:s'),$id,$parentId);                              
                            <?php           
                                  } 
                             ?>                                 
                            
                    return $this;    
                } 
                
                
<?php 
       } //end
?>            
            
<?php                 
 if($child=='rank' && !(in_array('parentId',$children) || in_array('ownerId',$children)) )
      {
?>            
            /**
             * return max rank
             *
             * @return int $maxRank            
             */            
            public function getMaxRank()
            {
              return self::getConn()->fetchSingle("select max([rank]) from [".$this->getTableRaw()."]<?php if(in_array('deleted',$children)){ ?> where [deleted]=0<?php } ?>");
            }            

            /**
             * set new ranks
             * FOR DESCENDING LIST             
             * <?php if(in_array('lastupdate',$children)){ ?>lastUpdate is actualised <?php } ?>                                                   
             *
             * @param int $id             
             * @return \<?php echo $class ?>
            
             */                        
            public function moveDownAction($id)
            {
                $that = $this->getByPK($id);
            
                    $mrank = $that->getRank()->getValue();

                    $downneib = $this->clear()
                 <?php 
                       if(in_array('deleted',$children))
                       {
                       ?>->setDeletedCond()<?php } ?>

                            ->where('and '.$this->getAlias('rank').'<%i',$mrank)
                            ->orderBy($this->getAlias('rank').' DESC ')
                            ->limit(1)
                            ->getSingle();

                    $this->clear();        
                            
                    if($downneib instanceof <?php echo $model ?>)
                    {        
                        $that->set('rank',$downneib->getRank()->getValue());
                        $downneib->set('rank',$mrank);
            
                        $that->update();
                        $downneib->update();
                    }
                    
              return $this;          
           }             
           
            /**
             * set new ranks  
             * FOR DESCENDING LIST             
             * <?php if(in_array('lastupdate',$children)){ ?>lastUpdate is actualised <?php } ?>                                      
             *
             * @param int $id             
             * @return \<?php echo $class ?>
            
             */            
           public function moveUpAction($id)
           {
             $that = $this->getByPK($id);   
           
                $mrank = $that->getRank()->getValue();

                $upneib = $this->clear()
                 <?php 
                       if(in_array('deleted',$children))
                       {
                       ?>->setDeletedCond()<?php } ?>
                 
                        ->where('and '.$this->getAlias('rank').'>%i',$mrank)
                        ->orderBy($this->getAlias('rank').' ASC ')
                        ->limit(1)
                        ->getSingle();

                $this->clear();

                if($upneib instanceof <?php echo $model ?>)
                {        
                    $that->set('rank',$upneib->getRank()->getValue());
                    $upneib->set('rank',$mrank);

                    $that->update();
                    $upneib->update();            
                  }
                  
              return $this;      
           }

            /**
             * set new ranks
             * FOR DESCENDING LIST             
             * <?php if(in_array('lastupdate',$children)){ ?>lastUpdate is actualised <?php } ?>                                                                
             *
             * @param int $id
             * @param int $neib_id 0 for last place
             * @return \<?php echo $class ?>
            
             */                       
           public function moveAfterAction( $id, $neib_id = 0 )
           {
            
               $that = $this->getByPK($id); 
           
           
                 self::getConn()->query("update [{$this->getTableRaw()}] set [rank]=[rank]-1 where [rank]>%i",$that->getRank()->getValue());
           
           
                    if( $neib_id > 0 )
                    {
                        $neib = $this->getGrid()->getByPK($neib_id);
                        
                            <?php 
                                  if(in_array('lastupdate',$children))
                                  {
                            ?>          
                        self::getConn()->query("update [{$this->getTableRaw()}] set [rank]=[rank]+1,[lastupdate]=%t where [rank]>=%i",date('Y-m-d G:i:s'),$neib->getRank()->getValue());                              
                            <?php           
                                  } else { 
                             ?>                            
                        self::getConn()->query("update [{$this->getTableRaw()}] set [rank]=[rank]+1 where [rank]>=%i",$neib->getRank()->getValue());                              
                             <?php } ?>          
                        
                        self::getConn()->query("update [{$this->getTableRaw()}] set [rank]=%i where [id]=%i",($neib->getRank()->getValue()),$id); 
                    }
                    else {                        
                        $maxrank = self::getConn()->fetchSingle('select max([rank]) from ['.$this->getTableRaw()."]");
                        self::getConn()->query("update [{$this->getTableRaw()}] set [rank]=%i where [id]=%i",($maxrank+1),$id);               
                    }

                            <?php 
                                  if(in_array('lastupdate',$children))
                                  {
                            ?>          
                        self::getConn()->query("update [{$this->getTableRaw()}] set [lastupdate]=%t where [id]=%i",date('Y-m-d G:i:s'),$id);                              
                            <?php           
                                  } 
                             ?>                                                

                 
                 return $this;
            }
        
<?php 
       } //end rank
?>            

<?php                 
 if($child=='rank' && in_array('ownerId',$children) )
      {
?>            
            /**
             * return max rank from current parent group
             *
             *
             * @param int $ownerId             
             * @return int $maxRank            
             */
            public function getMaxRank($ownerid)
            {
                return self::getConn()->fetchSingle("select max([rank]) from [".$this->getTableRaw()."] where [ownerid]=%i<?php if(in_array('deleted',$children)){ ?> and [deleted]=0<?php } ?>", $ownerid);                
            }            

            /**
             * set new ranks 
             * FOR DESCENDING LIST             
             * <?php if(in_array('lastupdate',$children)){ ?>lastUpdate is actualised <?php } ?>                                                                             
             *
             * @param int $id             
             * @param int $neib_id
             * @return \<?php echo $class ?>
            
             */                
            public function moveAfterAction( $id, $neib_id = 0 )
            {
            
               $that = $this->getByPK($id);             
                 
           
                 $ownerid = $that->getOwnerId()->getValue();
           
                 self::getConn()->query("update [{$this->getTableRaw()}] set [rank]=[rank]-1 where [ownerid]=%i and [rank]>%i",$ownerid,$that->getRank()->getValue());
           
           
                    if( $neib_id > 0 )
                    {
                        $neib = $this->getByPk($neib_id);
                            <?php 
                                  if(in_array('lastupdate',$children))
                                  {
                            ?>    
                        self::getConn()->query("update [{$this->getTableRaw()}] set [rank]=[rank]+1,[lastupdate]=%t where [ownerid]=%i and [rank]>=%i",date('Y-m-d G:i:s'),$ownerid,$neib->getRank()->getValue());                        
                            <?php } else { ?>
                        self::getConn()->query("update [{$this->getTableRaw()}] set [rank]=[rank]+1 where [ownerid]=%i and [rank]>=%i",$ownerid,$neib->getRank()->getValue());
                            <?php } ?>
                        
                        self::getConn()->query("update [{$this->getTableRaw()}] set [rank]=%i where [id]=%i",($neib->getRank()->getValue()),$that->getPrimaryKey()->getValue());               
                    }
                    else {
                        $maxrank = self::getConn()->fetchSingle('select max([rank]) from ['.$this->getTableRaw().'] where [ownerid]=%i',$ownerid);
                        self::getConn()->query("update [{$this->getTableRaw()}] set [rank]=%i where [id]=%i",($maxrank+1),$that->getPrimaryKey()->getValue());               
                    }
           
                            <?php 
                                  if(in_array('lastupdate',$children))
                                  {
                            ?>          
                        self::getConn()->query("update [{$this->getTableRaw()}] set [lastupdate]=%t where [id]=%i",date('Y-m-d G:i:s'),$id);                              
                            <?php           
                                  } 
                             ?>                       
                
                 
               return $this;
             }
                
                
<?php 
       } //end ownerid
?>            
                   
            
            
<?php 
    } //end foreach children 
 }
?>                
            
} //end class
