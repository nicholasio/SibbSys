<?php 

class Application_Model_DbTable_Servicos extends Zend_Db_Table_Abstract{
	
	protected $_name = 'Servicos';
	protected $_primary = 'idServicos';
	
	protected $_dependentTables = array('Application_Model_DbTable_Usuarioservicos');
	
	
	public function insert( array $data){
		
		parent::insert($data);
	}
	
	
	public function findForSelect(){
		
		$sql = $this->select();
		
		$rows = $this->fetchAll($sql);
		
		return $rows;
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
		
		$where = $this->getAdapter()->quoteInto('idServicos = ?', $id);
		$this->delete($$where);
		
	}
	
	public function listar(){
		
		$sql = $this->select()->order(array(new Zend_Db_Expr('nome ASC')));
		
		$rows = $this->fetchAll($sql);
		
		return $rows;
	}
	
}