<?php
class Application_Model_DbTable_Disciplina extends Zend_Db_Table_Abstract{
	
	protected $_name = 'Disciplina';
	protected $_primary = 'idDisciplina';
	
	protected $_dependentTables = array('Application_Model_DbTable_Turma','Application_Model_DbTable_Arquivos');
	
	protected $_refereTables = array(
		
		'Credito'	=>	array(
			'columns'		=>	array('Credito_idCredito'),
			'refTableClass'	=>	'Application_Model_DbTable_Credito',
			'refColumns'	=>	array('idCredito')
		)
	);

	
	public function insert( Array $data){
				
		parent::insert($data);
		
	}
	
	
	public function findForSelect(){
		$select = $this->select();
		return $this->fetchAll($select);
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
	
	public function listar(){
	
		$where = 'ativo';
		$sql = $this->select();
		$sql->where('Status = ?', $where)->order('Disciplina ASC');
		
		$rows = $this->fetchAll($sql);
		
		return $rows;
	}
	
	
	public function autoComplete($query){
		
		$sql = $this->select()->where('Disciplina LIKE = ?', $query.'%');
		
		$rows = $this->fetchAll($sql);
		
		return $rows;
	}
	
	
	
}