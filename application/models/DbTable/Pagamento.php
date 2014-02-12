<?php

class Application_Model_DbTable_Pagamento extends Zend_Db_Table_Abstract{
	
	protected $_name = 'Pagamento';
	protected $_primary = 'idPagamento';
	
	protected $_referenceMap = array(
		
		'Faturas' => array(
		
			'columns'		=> array('Faturas_idFaturas'),
			'refTableClass'	=> 'Application_Model_DbTable_Faturas',
			'refColumns'	=> array('idFaturas')
		)
	);
	
	public function insert(array $data){
		
		parent::insert($data);
		
	}
	
	
	public function editar($id){
		
		$sql = $this->select()->where('idPagamento = ?', $id);
		$row = $this->fetchRow($sql);
		
		if(null !== $row)
			return $row->toArray();
		
	}
	
	
	public function deletar($id){
		
		$sql = $this->select()->where('idPagamento = ?', $id);
		$row = $this->fetchRow($sql);
		
		$row->delete();
	}
	
	
	public function listar(){

		$sql = $this->select()
					->order(array(new Zend_Db_Expr('idPagamento ASC')));
		
		$rows = $this->fetchAll($sql);
		
		return $rows;
		
	}
}