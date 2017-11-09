<?php
class dataBeanException extends Exception {}
class Model_Component_Datatable_dataBean 
{
	private $data = array();
	
	public static $safeMethodCallbackFunction   = 'htmlspecialchars';
	
	public function __construct( $data = null )
	{
		if( $data !== null && $data instanceof ArrayAccess):
			foreach( $data as $key => $value ):
				$this->data [ $key ]= $value;
			endforeach;
		endif;
	}
	
	public function __get( $index ) 
	{
		if( isset( $this->data[ $index ] ) ) 
			return $this->data[ $index ];
		else {
		//	throw new dataBeanException( "Index $index not found" );
		
                return null;
                }
	}
	
	public function __call( $name, $arg )
	{
		//test if we call getter function
		$index    = preg_replace( '/^get/', '', $name );
		if( isset( $this->data[ $index ] ) )
		{
			if( count( $arg ) > 0 )
			{
				if( $arg[0] === true ) return $this->data[ $index ];
				elseif( is_string($arg[0]) )
				{  
					if( function_exists( $arg[0] ) ) 
					{ return call_user_func( $arg[0], $this->data[ $index ] );}
					else	
					{ throw new dataBeanException( "Getter $name called with wrong function name" ); }		
				}	  
				else
				{
					throw new dataBeanException( "Getter $name called with wrong arg" );
				}
			}
			 else {
			 	return call_user_func( self::$safeMethodCallbackFunction, $this->data[ $index ]	);
			 }	
			
		}
		else
		{	$index[0] = strtolower( $index[0] );
			if( isset( $this->data[ $index ] ) )  		
			{						
				if( count( $arg ) > 0 )
				{
					if( $arg[0] === true ) return $this->data[ $index ];
					elseif( is_string($arg[0]) )
					{  
						if( function_exists( $arg[0] ) ) 
						{ return call_user_func( $arg[0], $this->data[ $index ] ); }
						else	
						{ throw new dataBeanException( "Getter $name called with wrong function name" ); }		
					}	  
					else
					{
						throw new dataBeanException( "Getter $name called with wrong arg" );
					}
				}
				 else {
				 	return call_user_func( self::$safeMethodCallbackFunction,  $this->data[ $index ]);
				 }	
			}	
			else {
				throw new dataBeanException( "Getter $name not match any index" );
			}		
		}
	}
	
}

