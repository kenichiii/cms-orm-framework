<?php

class HPZnacky_Grid extends Model_Grid
{

    protected $_title = 'HP značky';

    protected $_modelClass = 'HPZnacky_Model';

    protected $_table = ':db:hpznacky';
    protected $_alias = 'hpz';

            /**
             * return max rank
             *
             * @return int $maxRank            
             */            
            public function getMaxRank()
            {
              return self::getConn()->fetchSingle("select max(rank) from ".$this->getTableRaw()." where deleted=0");
            }            

            /**
             * set new ranks
             * FOR DESCENDING LIST             
             *                                                    
             *
             * @param int $id             
             * @return \HPZnacky_Grid            
             */                        
            public function moveUpAction($id)
            {
                $that = $this->getByPK($id);

                    $mrank = $that->getRank()->getValue();

                    $downneib = $this->clear()
                 ->setDeletedCond()
                            ->where('and '.$this->getAlias('rank').'<%i',$mrank)
                            ->orderBy($this->getAlias('rank').' DESC ')
                            ->limit(1)
                            ->getSingle();

                    $this->clear();        

                    if($downneib instanceof HPZnacky_Model)
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
             *                                       
             *
             * @param int $id             
             * @return \HPZnacky_Grid            
             */            
           public function moveDownAction($id)
           {
             $that = $this->getByPK($id);   

                $mrank = $that->getRank()->getValue();

                $upneib = $this->clear()
                 ->setDeletedCond()                 
                        ->where('and '.$this->getAlias('rank').'>%i',$mrank)
                        ->orderBy($this->getAlias('rank').' ASC ')
                        ->limit(1)
                        ->getSingle();

                $this->clear();

                if($upneib instanceof HPZnacky_Model)
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
             *                                                                 
             *
             * @param int $id
             * @param int $neib_id 0 for last place
             * @return \HPZnacky_Grid            
             */                       
           public function moveAfterAction( $id, $neib_id = 0 )
           {

               $that = $this->getByPK($id); 

                 self::getConn()->query("SET AUTOCOMMIT=0");
                 self::getConn()->query("START TRANSACTION");

                 self::getConn()->query("update {$this->getTableRaw()} set rank=rank-1 where rank>%i",$that->getRank()->getValue());

                    if( $neib_id > 0 )
                    {
                        $neib = $this->getGrid()->getByPK($neib_id);

                        self::getConn()->query("update {$this->getTableRaw()} set rank=rank+1 where rank>%i",$neib->getRank()->getValue());                              

                        self::getConn()->query("update {$this->getTableRaw()} set rank=%i where id=%i",($neib->getRank()->getValue() + 1),$id); 
                    }
                    else {                        
                        $maxrank = self::getConn()->fetchSingle('select max(rank) from '.$this->getGrid()->getTableRaw());
                        self::getConn()->query("update {$this->getTableRaw()} set rank=%i where id=%i",($maxrank+1),$id);               
                    }

                 self::getConn()->query("COMMIT");
                 self::getConn()->query("SET AUTOCOMMIT=1");

                 return $this;
            }

} //end class
