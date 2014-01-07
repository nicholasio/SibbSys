<?php 

class Application_Model_DbTable_Servicos extends Zend_Db_Table_Abstract{
	
	protected $_name = 'Servicos';
	protected $_primary = 'idServicos';
	
	protected $_dependentTables = array('Application_Model_DbTable_Usuario_has_Servicos');
	
	
	public function insert( array $data){
		
		parent::insert($data);
	}
}