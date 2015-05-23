<?php
class Application_Model_DbTable_Disciplina extends Zend_Db_Table_Abstract{
	
	protected $_name = 'Disciplina';
	protected $_primary = 'idDisciplina';
	
	protected $_dependentTables = array('Application_Model_DbTable_Turma');
	
	
	
	public function insert( Array $data){
				
		parent::insert($data);
		
	}
	
	
	public function findForSelect(){
		
		$sql = $this->select();
		$sql->order(array(new Zend_Db_Expr('Disciplina ASC')));
		
		$rows = $this->fetchAll($sql);
		
		return $rows;
	}
	
	
	public function editar($id){
		
		$sql = $this->select()->where('idDisciplina = ?', $id);
		$row = $this->fetchRow($sql);
		
		return $row->toArray();
		
	}
	
	public function deletar($id){
		
		$sql = $this->select()->where('idDisciplina = ?', $id);
		$row = $this->fetchRow($sql);
		
		$linha = array(
			'Status' =>	'inativo'
		);
		
		$where = $this->getAdapter()->quoteInto('idDisciplina = ?', $id);
		$this->update($linha, $where);

	}
	
	public function ativar($id){
	
		$sql = $this->select()->where('idDisciplina = ?', $id);
		$row = $this->fetchRow($sql);
	
		$linha = array(
				'Status' =>	'ativo'
		);
	
		$where = $this->getAdapter()->quoteInto('idDisciplina = ?', $id);
		$this->update($linha, $where);
	
	}
	
	
	public function listar(){
	
		$where = 'ativo';
		$sql = $this->select()
					->where('Status = ?', $where)
					->order(array(new Zend_Db_Expr('Disciplina ASC')));
		
		$rows = $this->fetchAll($sql);
		
		return $rows;
	}
	
}