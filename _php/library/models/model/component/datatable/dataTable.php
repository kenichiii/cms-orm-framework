<?php

class Model_Component_Datatable_dataTable extends Model_Component_Datatable_dataContainer
{
	
	protected $table    = '';
        protected $tableRaw    = '';
	protected $primaryKey = 'id';
	//set null to get array
	protected $rowClass = 'Model_Component_Datatable_dataBean';		
	protected $collums  = array('*');
        
	protected $where    = ' WHERE 1=1 ';
	protected $orderBy	= '';
	protected $limit	= '';	

        protected $groupBy = '';

            public static function getConn()
            {
                return App::getConn();
            }
        
        public function getPrimaryKeyRaw() {
            $key = str_replace('[', '', $this->primaryKey);
            $key = str_replace(']', '', $key);
            
            if( strpos($key, ".") )
             {
                 $pies = explode('.',$key);
                 return //preg_replace('/^(\w+).(.*)/','${2}',$key);
                   $pies[1];
             }
            else return $key;
        }

        public function getTableRaw() {
            return $this->tableRaw;
        }

        public function getTable() {
            return $this->table;
        }

	public function __construct( $setup = null ) {
		 
                 if( is_array( $setup ) )
                            foreach( $setup as $key => $value ):
                                    if( isset( $this->$key ) ) {$this->$key = $value;}
                            endforeach;
	}
	
            
	public function getSelect() {

            $sql = "select ". implode( ', ', $this->collums ) . ' from ' . $this->table 
						.' '. $this->where.' '. $this->groupBy
                                                .' '. $this->orderBy .
                                                $this->limit;

		return $sql;
	}
	
	public function count( $allRecords = false ) {
		if( ! $allRecords ) return parent::count();
		else
			{
				$sql = "select count(*) from ". $this->table .' '. $this->where.' '. $this->groupBy;
				return self::getConn()->fetchSingle( $sql );
			}	
	}
	
	public function load() {
            
		if( $this->rowClass )
			{
                            foreach(  self::getConn()->fetchAll( $this->getSelect() ) as $value )
                            parent::attach( new $this->rowClass($value) );
                        }
			
		else {
                            foreach(  self::getConn()->fetchAll( $this->getSelect() ) as $value )
				parent::attach( $value );
		}
		$this->count  = $this->count();
	}

        public function find( $id )
        {
           $sql = "select ". implode( ', ', $this->collums ) . ' from ' . $this->table . ' where '. $this->primaryKey .'=%i';
           return $this->rowClass ? new $this->rowClass(dibi::fetch( $sql, $id )) : dibi::fetch( $sql, $id );
        }
	
}
