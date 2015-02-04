<?php

class Application_Model_DbTable_Igreja extends Zend_Db_Table_Abstract{
	
	protected $_name = 'Igreja';
	protected $_primary = 'idIgreja';
	
	protected $_dependentTables = array('Application_Model_DbTable_Usuario');
	
	
	public function insert( Array $data){
		
		parent::insert($data);
		
	}
	
	
	public function findForSelect(){
		
		$select = $this->select()->order(array(new Zend_Db_Expr('Igreja ASC')));;
		
		return $this->fetchAll($select);
	}
	
	
	public function editar($id){
		$sql = $this->select()->where('idIgreja = ?', $id);
		$row = $this->fetchRow($sql);
		
		return $row->toArray();
	}
	
	
	public function deletar($id){
		
		$sql = $this->select()->where('idIgreja = ?', $id);
		
		$row = $this->fetchRow($sql);
		
		$linha = array(
			'Status'=>'inativo'
		);
		
		$where = $this->getAdapter()->quoteInto('idIgreja = ?', $id);
		
		$this->update($linha, $where);
	}
	
	
	public function ativar($id){
		
		$sql = $this->select()->where('idIgreja = ?', $id);
		
		$row = $this->fetchRow($sql);
		
		$linha = array(
				'Status'=>'ativo'
		);
		
		$where = $this->getAdapter()->quoteInto('idIgreja = ?', $id);
		
		$this->update($linha, $where);
	}
	
	public function listar(){
		
		$sql = $this->select()
					->where('Status = ?', $where)
					->order(array(new Zend_Db_Expr('Igreja ASC')));
		
		$rows = $this->fetchAll($sql);
		
		return $rows;
	}
}