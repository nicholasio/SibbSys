<?php

class Application_Model_DbTable_Arquivos extends Zend_Db_Table_Abstract{

	protected $_name = 'Arquivos';
	protected $_primary = 'idArquivos';
	
	protected $_referenceMap = array(
	
		'Turma' => array(
			'columns'		=>	array('Turma_idTurma'),
			'refTableClass'	=>	'Application_Model_DbTable_Turma',
			'refColumns'	=>	array('idTurma')
		)
	);
	
	public function insert( Array $data){
	
		parent::insert($data);
	}
	
	
	public function findForSelect(){
	
		$sql = $this->select()->from($this, new Zend_Db_Expr("DISTINCT(Turma_idTurma)"));
		
		$rows =  $this->fetchAll($sql);
		
		return $rows;
	}
	
	
	public function seleciona($id){
	
		$sql = $this->select()->where('Turma_idTurma = ?', $id);
		
		$row =  $this->fetchRow($sql);
		
		return $row;
	
	}
	
	
	public function listar($idTurma){
	
		$sql = $this->select()->where('Turma_idTurma = ?', $idDisc);
		
		$rows = $this->fetchAll($sql);
		
		return $rows;
	}
	
	
	public function download($id){
		
		$status = 'ativo';
		
		$select = $this->select()->where('Turma_idTurma = ?', $id)
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