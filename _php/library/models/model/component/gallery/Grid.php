<?php

class Model_Component_Gallery_Grid extends Model_Grid
{
    
    protected $_title = 'Galerie';
    
    protected $_modelClass = 'Model_Component_Gallery_Model';
    
    protected $_table = ':db:gallery';
    protected $_alias = 'g';
    
    protected $dir = '/docs/gallery';
    

    public function getDir()
    {
        return $this->dir;
    }
    
    public function getMaxRank($ownerid)
    {
        return self::getConn()->fetchSingle('select max(rank) from '.$this->getTableRaw().' where ownerid=%i',$ownerid);
    }
    
    public function setDir($dir)
    {
        $this->dir = $dir;
        return $this;
    }
    
    public function deleteItem($id)
    {
           $img = $this->getByPk($id);
           
           self::getConn()->query("update {$this->getTableRaw()} set rank=rank-1 where ownerid=%i and rank>%i",$img->getOwnerId()->getValue(),$img->getRank()->getValue());
           
           if(file_exists(PUBLIC_PATH.'/'.$this->getDir().'/'.$img->getSrc()->getValue()))
           unlink(PUBLIC_PATH.'/'.$this->getDir().'/'.$img->getSrc()->getValue());
           
           return self::getConn()->query("delete from {$this->getTableRaw()} where id=%i",$id);        
           
    }
    
    public function updateSort( $photo_id, $neib_id = 0 )
    {
            
                 self::getConn()->query("SET AUTOCOMMIT=0");
                 self::getConn()->query("START TRANSACTION");
                 
           $img = $this->getByPk($photo_id);
           $ownerid = $img->getOwnerId()->getValue();
           
           self::getConn()->query("update {$this->getTableRaw()} set rank=rank-1 where ownerid=%i and rank>%i",$ownerid,$img->getRank()->getValue());
           
           
           if( $neib_id > 0 )
           {
               $neib = $this->getByPk($neib_id);
               self::getConn()->query("update {$this->getTableRaw()} set rank=rank+1 where ownerid=%i and rank>%i",$ownerid,$neib->getRank()->getValue());
               
               self::getConn()->query("update {$this->getTableRaw()} set rank=%i where id=%i",($neib->getRank()->getValue() + 1),$photo_id);               
           }
           else {
               //dibi::query("update {$this->getTableRaw()} set rank=rank+1 where ownerid=%i",$ownerid);     
               $maxrank = self::getConn()->fetchSingle('select max(rank) from '.$this->getTableRaw().' where ownerid=%i',$ownerid);
               self::getConn()->query("update {$this->getTableRaw()} set rank=%i where id=%i",($maxrank+1),$photo_id);               
           }
           
                
                 self::getConn()->query("COMMIT");
                 self::getConn()->query("SET AUTOCOMMIT=1");
                 
                 return true;
    }
}
