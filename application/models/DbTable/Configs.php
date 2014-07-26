<?php

class Application_Model_DbTable_Configs extends Zend_Db_Table_Abstract{
	
	protected $_name = 'Configs';
	protected $_primary = 'idConfigs';
	
	
	public function insert(array $data){
		
		parent::insert($data);
	}

	   public function listar(){
    
    	$sql = $this->select();
    	
    	$rows = $this->fetchAll($sql);
    	
    	return $rows;
    	
    }

    public function findKey($key) {

    	$sql = $this->select(array('Meta_Value'))->where('Meta_Key = ?', $key);

    	$row = $this->fetchRow($sql);
    	
    	return $row->Meta_Value;

    }
	
}