<?php

class Model_Component_FilesGrid_Grid extends Model_Grid
{

    protected $_title = 'Soubory';

    protected $_modelClass = 'Model_Component_FilesGrid_Model';

    protected $_table = ':db:docs';
    protected $_alias = 'dc';

    
    protected $dir = '/docs/docs';
    
    protected $allowedExt = array('allfiles');

    public function getDir()
    {
        return $this->dir;
    }

    public function setDir($dir)
    {
        $this->dir = $dir;
        return $this;
    }    
    
    public function isValidFile($filename)
    {
        $allow = $this->getAllowedExt();
        
        if(count($allow)==1&&$allow[0]=='allfiles') return true;
        
        $h = explode('.',$filename);
        $ext = end($h);
        return in_array(strtolower($ext), $allow);
    }
    
    public function getAllowedExt() {
        return $this->allowedExt;
    }
    
    
            /**
             * return max rank from current parent group
             *
             *
             * @param int $ownerId             
             * @return int $maxRank            
             */
            public function getMaxRank($ownerid)
            {
                return self::getConn()->fetchSingle("select max([rank]) from [".$this->getTableRaw()."] where [ownerid]=%i and [deleted]=0", $ownerid);                
            }            

            /**
             * set new ranks 
             * FOR DESCENDING LIST             
             * lastUpdate is actualised                                                                              
             *
             * @param int $id             
             * @param int $neib_id
             * @return \Model_Component_FilesGrid_Grid            
             */                
            public function moveAfterAction( $id, $neib_id = 0 )
            {

               $that = $this->getByPK($id);             

                 $ownerid = $that->getOwnerId()->getValue();

                 self::getConn()->query("update [{$this->getTableRaw()}] set [rank]=[rank]-1 where [ownerid]=%i and [rank]>%i",$ownerid,$that->getRank()->getValue());

                    if( $neib_id > 0 )
                    {
                        $neib = $this->getByPk($neib_id);

                        self::getConn()->query("update [{$this->getTableRaw()}] set [rank]=[rank]+1,[lastupdate]=%t where [ownerid]=%i and [rank]>=%i",date('Y-m-d G:i:s'),$ownerid,$neib->getRank()->getValue());                        

                        self::getConn()->query("update [{$this->getTableRaw()}] set [rank]=%i where [id]=%i",($neib->getRank()->getValue()),$that->getPrimaryKey()->getValue());               
                    }
                    else {
                        $maxrank = self::getConn()->fetchSingle('select max([rank]) from ['.$this->getTableRaw().'] where [ownerid]=%i',$ownerid);
                        self::getConn()->query("update [{$this->getTableRaw()}] set [rank]=%i where [id]=%i",($maxrank+1),$that->getPrimaryKey()->getValue());               
                    }

                        self::getConn()->query("update [{$this->getTableRaw()}] set [lastupdate]=%t where [id]=%i",date('Y-m-d G:i:s'),$id);                              

               return $this;
             }

} //end class
