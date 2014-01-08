<?php

class Application_Model_DbTable_Faturas extends Zend_Db_Table_Abstract{
	
	protected $_name = 'Faturas';
	protected $_primary = 'idFatura';
	
	protected $_dependentTables = array('Application_Model_DbTable_Pagamento');
	
	protected $_referenceMap = array(
		
		'Usuario' => array(
		
			'columns'		=> array('Usuario_idUsuario'),
			'refTableClass'	=> 'Application_Model_DbTable_Usuario',
			'refColumns'	=> array('idUsuario')	
		),
	);
	
	public function insert(array $data){
		
		parent::insert($data);
	}
	
	
	public function editar($id){
		
		$sql = $this->select()->where('idFatura = ?', $id);
		$row = $this->fetchRow($sql);
		
		if(null !== $row)
			return $row->toArray();
	}
	
	
	public function deletar($id){
		
		$sql = $this->select()->where('idFatura = ?', $id);
		$row = $this->fetchRow($sql);
		
		$row->delete();
	}
	
	
	public function listar(){
		
		$sql = $this->select()->order('idFatura ASC');
		$rows = $this->fetchAll($sql);
		
		return $rows;
	}
	
}