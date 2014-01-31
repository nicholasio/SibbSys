<?php

class Application_Model_DbTable_Credito extends Zend_Db_Table_Abstract{
	
	protected $_name = 'Credito';
	protected $_primary = 'idCredito';
	
	protected $_dependentTables = array('Application_Model_DbTable_Disciplina');
	
	
	public function insert(array $data){
		
		parent::insert($data);
	}
	
	public function listar(){
		
		$sql = $this->select();
		
		$row = $this->fetchRow($sql);
		
		return $row;
	}
	
	
}