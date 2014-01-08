<?php 

class Application_Model_DbTable_Servicos extends Zend_Db_Table_Abstract{
	
	protected $_name = 'Servicos';
	protected $_primary = 'idServicos';
	
	protected $_dependentTables = array('Application_Model_DbTable_Usuario_has_Servicos');
	
	
	public function insert( array $data){
		
		parent::insert($data);
	}
	
	
	public function editar($id){
		
		$sql = $this->select()->where('idServicos = ?', $id);
		$row = $this->fetchRow($sql);
		
		if(null !== $row)
		return $row->toArray();
	}
	
	
	public function deletar($id){
		
		$sql = $this->select()->where('idServicos = ?', $id);
		
		$row = $this->fetchRow($sql);
		
		$row->delete();
		
	}
	
	public function listar(){
		
		$sql = $this->select()->order('nome ASC');
		
		$rows = $this->fetchAll($sql);
		
		return $rows;
	}
}