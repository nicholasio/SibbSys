<?php

class Application_Model_DbTable_Arquivos extends Zend_Db_Table_Abstract{

	protected $_name = 'Arquivos';
	protected $_primary = 'idArquivos';
	
	protected $_referenceMap = array(
	
		'Disciplina' => array(
			'columns'		=>	array('Disciplina_idDisciplina'),
			'refTableClass'	=>	'Application_Model_DbTable_Disciplina',
			'refColumns'	=>	array('idDisciplina')
		)
	);
	
	public function insert( Array $data){
	
		parent::insert($data);
	}
	
	
	public function findForSelect(){
	
		$sql = $this->select()->from($this, new Zend_Db_Expr("DISTINCT(Disciplina_idDisciplina)"));
		
		$rows =  $this->fetchAll($sql);
		
		return $rows;
	}
	
	
	public function seleciona($id){
	
		$sql = $this->select()->where('Disciplina_idDisciplina =?', $id);
		
		$row =  $this->fetchRow($sql);
		
		return $row;
	
	}
	
	
	public function listar($idDisc){
	
		$sql = $this->select()->where('Disciplina_idDisciplina = ?', $idDisc);
		
		$rows = $this->fetchAll($sql);
		
		return $rows;
	}
	
	
	public function download($id){
		
		$status = 'ativo';
		
		$select = $this->select()->where('Disciplina_idDisciplina = ?', $id)
								 ->where('Status = ?', $status);
		
		return $this->fetchAll($select);
		
	}
	
	public function editar($id){
	
		$sql = $this->select()->where('idArquivos = ?', $id);
		$row = $this->fetchRow($sql);
		
		if(null !== $row){
			return $row->toArray();
		}
	}
	
	
	public function deletar($id){
	
		$sql = $this->select()->where('idArquivos = ?', $id);
		
		$row = $this->fetchRow($sql);
		
		$row->delete();
	}

}