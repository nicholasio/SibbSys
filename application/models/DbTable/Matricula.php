<?php

class Application_Model_DbTable_Matricula extends Zend_Db_Table_Abstract{

	protected $_name = 'Usuario_has_Turma';
	protected $_primary = 'idUsuario_has_Turma';
	
	protected $_dependentTables = array('Application_Model_DbTable_Nota','Application_Model_DbTable_Presenca');
	
	protected $_referenceMap = array
	(
		'Usuario' => array
		(
			'columns' 		=> array('Usuario_idUsuario'),
			'refTableClass' => 'Application_Model_DbTable_Usuario',
			'refColumns' 	=> array('idUsuario')
		),
		
		'Turma' => array
		(
			'columns' 		=> array('Turma_idTurma'),
			'refTableClass'	=> 'Application_Model_DbTable_Turma',
			'refColumns'	=> array('idTurma')
		)
	);
	
	
	public function insert( Array $data){
		
		parent::insert($data);
	}
	
	
	public function findForSelect($id){
		
		$sql = $this->select()->where('Turma_idTurma = ?', $id);
		
		return $this->fetchAll($sql);
	}
	
	
	public function verificar($idUsuario, $idTurma){
		
		$sql = $this->select()->where('Usuario_idUsuario = ?', $idUsuario)
							  ->where('Turma_idTurma = ?', $idTurma);
		
		return $this->fetchRow($sql);
	}
	
	
	public function deletar($id){
		
		$sql = $this->select()->where('idUsuario_has_Turma = ?', $id);
		
		$row = $this->fetchRow($sql);
		
		$row->delete();
	}
	
	
	public function listar(){

		$where = 'Cursando';
		$sql = $this->select()->where('Status = ?', $where)->order('idUsuario_has_Turma ASC');
		
		$rows = $this->fetchAll($sql);
		
		return $rows;
	}
	
	
	public function turmas($id){
		/*
		 * Lista todas as Turmas em que este usuário está matriculado;
		 */
		$sql = $this->select()->where('Usuario_idUsuario = ?', $id);
		
		$rows = $this->fetchAll($sql);
		
		return $rows;
	}
	
	
	public function getTurma($id){

		$sql = $this->select()->where('Usuario_idUsuario = ?', $id);
		
		$row = $this->fetchRow($sql);
		
		return $row;
	}
	
	
	public function getId($idUser){
		
		$sql = $this->select()->where('idUsuario_has_Turma = ?', $idUser);
		
		$linha = $this->fetchRow($sql);
		
		return $linha;
	}
	
	
	public function statusNota($idStatus){
		
		$linha = array(
			'Status'	=>	'Aprovado'
		);
		
		$where = $this->getAdapter()->quoteInto('idUsuario_has_Turma = ?', $idStatus);
		
		$this->update($linha, $where);
	}
	
	
	public function statusPresenca($idStatus){
	
		$linha = array(
			'Status'	=>	'Reprovado'
		);
		
		$where = $this->getAdapter()->quoteInto('idUsuario_has_Turma = ?', $idStatus);
		
		$this->update($linha, $where);
	}
	
	
	public function lista(){
			
		$sql = $this->select()->from($this, new Zend_Db_Expr("DISTINCT(Usuario_idUsuario)"));
		
		$rows = $this->fetchAll($sql);
		
		return $rows;
	}
}