[[

class <?php echo $class ?> <?php if($extends!='') { ?>extends <?php echo $extends; } ?>

{
    protected $_rawname = '<?php echo $rawname ?>';
    protected $_title = '<?php echo $title ?>';
    
    protected $_gridClass = '<?php echo $grid ?>';

    public function __construct()
    {        
<?php foreach($children as $key=>$child) { 
                
                if($child=='id')
                {
?>
    
        $this->modeladdPkId(); 
                     
<?php
                }
                elseif($child=='deleted')
                {
?>
          
        $this->modeladdDeleted(); 
                    
<?php
                }      
      
                elseif($child=='lang')
                {
?>
        
        $this->modeladdLang();
        
<?php
                }                     
                elseif($child=='active')
                {
 ?>
        
        $this->modeladdActive();
                
<?php
                }            
                elseif($child=='parentId')
                {
?>
        
        $this->modeladdParentId();
        
<?php
                }      
                elseif($child=='nestedindexes')
                {
?>
        
        $this->modeladdNestedIndexes();
        
<?php
                }                                      
                elseif($child=='h1')
                {
?>
        
        $this->modeladdH1();
        
<?php
                }            
                elseif($child=='uri')
                {
?>
        
        $this->modeladdUri(); 
        
<?php
                }            
                elseif($child=='transh1')
                {
?>
        
        $this->modeladdTransH1();
        
<?php
                }            
                elseif($child=='transuri')
                {
?>
        
        $this->modeladdTransUri(); 
        
<?php
                }                
                
                
                elseif($child=='foto')
                {
?>
        
        $this->modeladdPhoto();
        
<?php
                }            
                elseif($child=='pfoto')
                {
?>
        
        $this->modeladdPrivatephoto();
        
<?php
                }                 
                elseif($child=='rank')
                {
                
                if(in_array('parentId',$children)||in_array('nestedindexes',$children))
                {
?>
        
        $this->modeladdRank()->getRank()->setSorting('ASC');
        
<?php
                }  
                else
                {    
?>
        
        $this->modeladdRank();
        
<?php            }
                }           
                elseif($child=='created')
                {
?>
        
        $this->modeladdCreated();
        
<?php
                }           
                elseif($child=='lastupdate')
                {
?>
        
        $this->modeladdLastupdate();
        
<?php
                }           
                elseif($child=='perex')
                {
?>
        
        $this->modeladdPerex();
        
<?php
                }                     
                elseif($child=='content')
                {
?>
        
        $this->modeladdContent();
        
<?php
                }  
                elseif($child=='date')
                {
?>
        
        $this->modeladdDate();
        
<?php
                }
                elseif($child=='file')
                {
?>
        
        $this->modeladdFile();
        
<?php
                }                
                
        } ////endforeach children   
        
?>     
                        
<?php        
                    
                foreach($collum_class as $ckey => $cClass  )
                {
                    if($cClass)
                    {
?>
        
        $<?php echo $collum_name[$ckey] ?> = new <?php echo $cClass ?>();
        $<?php echo $collum_name[$ckey] ?><?php if($collum_title[$ckey]) { ?>->setTitle('<?php echo $collum_title[$ckey] ?>')<?php } ?><?php if($collum_default[$ckey]) { ?>->setDefault('<?php echo $collum_default[$ckey] ?>')<?php } ?>
        <?php echo "\n"; ?>                            <?php if($collum_notnull[$ckey]) { ?>->setNotNull(true)<?php } ?><?php if($collum_key[$ckey]) { ?>->setKey(true)<?php } ?><?php if($collum_unique[$ckey]) { ?>->setUnique(true<?php if($collum_unique_with[$ckey]) { ?>,array('<?php echo implode("','",  explode(',',$collum_unique_with[$ckey])) ?>')<?php } ?>)<?php } ?>;
    $this->modeladd("<?php echo $collum_name[$ckey] ?>",$<?php echo $collum_name[$ckey] ?>);
                                                                     
<?php
                     }
                } //endforeach collums

                
                
 if(isset($add_gallery))
      {
?>                
        $gallery = new <?php echo $gallery_model; ?>();
        $gallery->setN1('ownerid','id');
        $this->relationsadd('gallery',$gallery);
                
                        ;        
<?php } //end add gallery          
                
                
 if(isset($add_docs))
      {
?>                
        $docs = new <?php echo $docs_model; ?>();
        $docs->setN1('ownerid','id');
        $this->relationsadd('docs',$docs);
                
                        ;        
<?php } //end add gallery  





                foreach($rel_class as $rkey => $rClass)
                {
                    if($rClass)
                    {
?>
                                    
<?php if($rel_rel[$rkey]=='join') { ?>            
        $<?php echo $rel_name[$rkey] ?> = new <?php echo $rClass ?>();
        $<?php echo $rel_name[$rkey] ?><?php if($rel_title[$rkey]) { ?>->setTitle('<?php echo $rel_title[$rkey] ?>')<?php } ?>
        <?php echo "\n"; ?>                     ->setJoin('<?php echo $rel_from[$rkey] ?>','<?php echo $rel_to[$rkey] ?>');         
        $this->modeladd('<?php echo $rel_name[$rkey] ?>',$<?php echo $rel_name[$rkey] ?>);
<?php } else { ?> 
        
        $<?php echo $rel_name[$rkey] ?> = new <?php echo $rClass ?>();
        $<?php echo $rel_name[$rkey] ?><?php if($rel_title[$rkey]) { ?>->setTitle('<?php echo $rel_title[$rkey] ?>')<?php } ?>
        <?php echo "\n"; ?>                     <?php if($rel_rel[$rkey]=='11') { ?>->set11('<?php echo $rel_from[$rkey] ?>','<?php echo $rel_to[$rkey] ?>')<?php } elseif($rel_rel[$rkey]=='N1') { ?>->setN1('<?php echo $rel_from[$rkey] ?>','<?php echo $rel_to[$rkey] ?>')<?php } elseif($rel_rel[$rkey]=='NN') { ?>->setNN('<?php echo $rel_from[$rkey] ?>','<?php echo $rel_to[$rkey] ?>',$this->getGrid()->getTableRaw())<?php } ?>;            
        $this->relationsadd('<?php echo $rel_name[$rkey] ?>',$<?php echo $rel_name[$rkey] ?>);
        
<?php } ?>      
                                                                            
                        
          <?php
                    }
                } //endforeach
          ?>                       
                                        
    } //end __constructor

    
<?php        
                    
                foreach($collum_class as $ckey => $cClass  )
                {
                    if($cClass)
                    {
?>

            
<?php if($collum_unique[$ckey]) { ?>
<?php if($collum_unique_with[$ckey]) { ?>

            /**
             *  load model by unique keys <?php echo $collum_name[$ckey];foreach(explode(',',$collum_unique_with[$ckey])as$uniwith) echo ', '.$uniwith ?>
             *
             * @param <?php $i=new $collum_class[$ckey]();echo($i instanceof Model_Primitive_Int)?'int':'string'?> $<?php echo $collum_name[$ckey]; ?>
             
<?php foreach(explode(',',$collum_unique_with[$ckey])as$uniwith) { ?>
             * @param type $<?php echo $uniwith ?>
             
<?php } ?>             * 
             *
             * @return \<?php echo $class ?>
             
             */            
            public static function loadBy<?php $by = $collum_name[$ckey]; $by[0]=strtoupper($by[0]); echo $by; ?>With<?php foreach(explode(',',$collum_unique_with[$ckey])as$uniwith) {$by = $uniwith; $by[0]=strtoupper($by[0]); echo $by;} ?>(<?php echo '$'.$collum_name[$ckey];foreach(explode(',',$collum_unique_with[$ckey])as$uniwith) echo ', $'.$uniwith ?>)
            {
                $model = new <?php echo $class ?>();
                return $model->getGrid()
                    ->andWhere($model->getGrid()->getAlias('<?php echo $collum_name[$ckey]; ?>').'=<?php $i=new $collum_class[$ckey]();echo($i instanceof Model_Primitive_Int)?'%i':'%s'?>',$<?php echo $collum_name[$ckey] ?>)
                    <?php foreach(explode(',',$collum_unique_with[$ckey])as$uniwith) { ?>
                    ->andWhere($model->getGrid()->getAlias('<?php echo $uniwith; ?>').'=%s', $<?php echo $uniwith ?>)
                    <?php } ?>->getSingle();
            }   

<?php } else {  ?>

            /**
             *  load model by unique key <?php echo $collum_name[$ckey]; ?>
             *
             * @param mixed $key
             * @return \<?php echo $class ?>
            
             */            
            public static function loadBy<?php $by = $collum_name[$ckey]; $by[0]=strtoupper($by[0]); echo $by; ?>($key)
            {
                $model = new <?php echo $class ?>();
                return $model->getGrid()->andWhere($model->getGrid()->getAlias('<?php echo $collum_name[$ckey]; ?>').'=<?php $i=new $collum_class[$ckey]();echo($i instanceof Model_Primitive_Int)?'%i':'%s'?>',$key)->getSingle();
            }   
            

<?php } } //end unique ?>
                                                                     
<?php
                     }
                } //endforeach collums
?>                  
    
<?php foreach($children as $key=>$child) { ?>

<?php
     if($child=='lastupdate')
     {
?>
    
    /**
     * update database record by primary key for all model defined collums
     * lastUpdate is geting current timestamp
     * 
     * @return \<?php echo $class; ?> $this
     */
    public function update()
    {
        $this->set('lastupdate',date('Y-m-d G:i:s'));
        $this->getGrid()->updateByPK( $this->getCollumsInArray(), $this->getPrimaryKey()->getValue() );
        return $this;
    }
                     
<?php
     }    
?>    
            
            
<?php
     if($child=='id')
     {
?>
    
            /**
             *  load model by primary key from db table
             *
             * @param int $id
             * @return \<?php echo $class ?>
            
             */            
            public static function loadByPK($id)
            {
                $model = new <?php echo $class ?>();
                return $model->getGrid()->getByPk($id);
            }   
                     
<?php
     }    
?>    
    
<?php                 
 if($child=='parentId' && in_array('id',$children))
      {
?>
        
            /**
             *  return prepared grid instance with set parentid=this.id
             *
             * @return \<?php echo $grid ?>
            
             */             
            public function getChildren()
            {
                $coll = $this->isParentAble();
                return $this->getGrid(true)->where(' and '.$this->getGrid()->getAlias($coll->getCollum()).'=%i',$this->getPrimaryKey()->getValue());
            }

            
            
            /**
             *  return parent model instance with id=this.parentid
             *
             * @param bool $fresh
             * @return \<?php echo $class ?>
            
             */                         
            public function getParent($freshgrid=false)
            {
                if($this->getParentid()->getValue()==0) return null;
                return $this->getGrid($freshgrid)->where(' and '.$this->getGrid()->getAlias($this->getPrimaryKey()->getCollum()).'=%i',$this->getParentid()->getValue())->getSingle();
            }
                
<?php } ?>   

<?php                 
 if($child=='uri')
      {
?>            
            /**
             *  load model by uri from db table
             *
             * @param string $uri
             * @return \<?php echo $class ?>
            
             */            
            public static function loadByUri($uri)
            {
                $model = new <?php echo $class ?>();
                $uriable = $model->isUriAble();
                return $model->getGrid()->where(' and '.$model->getGrid()->getAlias($uriable->getCollum()).'=%s',$uri)->getSingle();
            }            
            
<?php 
       } //end
?>
            
            
            
<?php                 
 if($child=='rank' && in_array('parentId',$children) )
      {
?>            
            /**
             *   set rank to max+1 from current parent group
             *
             * @return \<?php echo $class ?>
            
             */
            public function setRank()
            {
                $this->set('rank',$this->getGrid()->getMaxRank($this->getParentId()->getValue())+1);                
                return $this;
            }            

            /**
             * set parentId and rank 
             * FOR ASCENDING LISTS
             *
             * @param int $parentId
             * @param int|'none' $prevItemId
             * @param int|'none' $nextItemId
             * @return \<?php echo $class ?>
            
             */                
            public function moveToParentAction($parentId,$prevItemId='none',$nextItemId='none')
            {
               $this->getGrid()->moveToParentAction($this->getPrimaryKey()->getValue(),$parentId,$prevItemId,$nextItemId);
               return $this;    
            } 
                
                
<?php 
       } //end
?>            
            
<?php                 
 if($child=='rank' && !(in_array('parentId',$children)||in_array('ownerId',$children)) )
      {
?>            
            /**
             *   set rank to max+1 
             *
             * @return \<?php echo $class ?>
            
             */            
            public function setRank()
            {  
              $this->set('rank',$this->getGrid()->getMaxRank()+1);
              return $this;
            }            

            /**
             * set new ranks
             * FOR DESCENDING LIST
             * <?php if(in_array('lastupdate',$children)){ ?>lastUpdate is actualised <?php } ?>                                      
             *
             * @return \<?php echo $class ?>
            
             */                        
            public function moveDownAction()
            {
              $this->getGrid()->moveDownAction($this->getPrimaryKey()->getValue());  
              return $this;          
           }             
           
            /**
             * set new ranks
             * FOR DESCENDING LIST             
             * <?php if(in_array('lastupdate',$children)){ ?>lastUpdate is actualised <?php } ?>                                      
             *
             * @return \<?php echo $class ?>
            
             */            
           public function moveUpAction()
           {
              $this->getGrid()->moveUpAction($this->getPrimaryKey()->getValue());  
              return $this;          
           }

            /**
             * set new ranks
             * FOR DESCENDING LIST             
             * <?php if(in_array('lastupdate',$children)){ ?>lastUpdate is actualised <?php } ?>                                                   
             *
             * @param int $neib_id
             * @return \<?php echo $class ?>
            
             */                       
           public function moveAfterAction( $neib_id = 0 )
           {
              $this->getGrid()->moveAfterAction($this->getPrimaryKey()->getValue(),$neib_id);  
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
             * set rank to max+1 from current parent group
             *
             * @return \<?php echo $class ?>
            
             */
            public function setRank()
            {
                $this->set('rank',$this->getGrid()->getMaxRank($this->getOwnerid()->getValue())+1);                
                return $this;
            }            

            /**
             * set new ranks 
             * FOR DESCENDING LIST             
             * <?php if(in_array('lastupdate',$children)){ ?>lastUpdate is actualised <?php } ?> 
             *
             * @param int $neib_id
             * @return \<?php echo $class ?>
            
             */                
            public function moveAfterAction( $neib_id = 0 )
            {
                $this->getGrid()->moveAfterAction($this->getPrimaryKey()->getValue(),$neib_id);
                return $this;
             }
                
                
<?php 
       } //end ownerid
?>            
                   
            
            
<?php 
    } //end foreach children
?>    
                
} //end class 
 

