<?php

class Application_Model_DbTable_Configs extends Zend_Db_Table_Abstract{
	
	protected $_name = 'Configs';
	protected $_primary = 'idConfigs';
	
	
	public function insert(array $data){
		
		parent::insert($data);
	}
	
}