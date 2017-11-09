<?php

/**
 *  @author: Martin Königsmark
 */
class Model_Component_Datatable_dataContainer implements Iterator, Countable, ArrayAccess
{
   
   /**
    *  @var array $strage contains storaged data 
    *  @access protected    
    */          
   protected $storage = array();
 
   /**
    *  @var int $index
    *  @access protected     
    */
   protected $index = 0;       
 
    
  public function __construct( $array = null ) {
     if( $array !== null ) $this->storage = $array;  
  }
  
  public function attach( $obj ) 
  {
     $this->storage []= $obj;    
  }  
  
  public function random() {
    $random_index = rand(0, count( $this->storage ) ); 
    return $this->offsetGet( $random_index );
  }
  
  public function offsetExists ($offset) {
    return isset( $this->storage[ $offset ] );
  }
  
  public function offsetGet ($offset) {
   if( $this->offsetExists( $offset ) ) {
    return $this->storage[ $offset ];
   }
  }
  
  public function offsetSet ($offset, $value) {
       $this->storage[ $offset ] = $value;
  }
  
  public function offsetUnset ($offset) {
   if( $this->offsetExists( $offset ) ) {
     unset($this->storage[ $offset ]);
   }  	  	
  }

  /**
   *  set records array empty and allows re-use for new query
   *  @access public   
   *  @return void   
   */          
  public  function reset() {
      $this->storage = array();
  }
      
  
  /**
   *  This method moves the internal index forward one entry
   *  @access public   
   *  @return bool if current record is valid   
   */          
  public  function next() {
    $this->index++;
    return $this->valid();
  }

  /**
   *  This method should reset the internal index to the first element
   *  @access public   
   *  @return bool if array $storage is empty   
   */ 
  public  function rewind() {
    $this->index = 0;
    return $this->valid();         
  } 

  /**
   *  This method return number of records
   *  @access public   
   *  @return bool if array $storage is empty   
   */ 
  public  function count() {
    return count( $this->storage );
  }

  /**
   *  This method returns the current index’s value
   *  @access public   
   *  @return mixed 
   */ 
  public  function current() {       
    return $this->storage[ $this->index ];
  }

  /**
   *  This method should return true or false if there is a current element.
   *  It is called after rewind or next
   *  @access public   
   *  @return bool 
   */ 
  public  function valid() {
    return isset( $this->storage[ $this->index ] );
  }


  /**
   *  This method returns the value of the current index’s key
   *  @access public   
   *  @return int $index 
   */ 
  public  function key() {
    return $this->index; 
  }

  public function getStorage() {
     return $this->storage;
  }
}
