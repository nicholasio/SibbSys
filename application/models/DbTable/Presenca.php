<?php

class Application_Model_DbTable_Presenca extends Zend_Db_Table_Abstract{

	protected $_name = 'Presenca';
	protected $_primary = 'idPresenca';
	
	protected $_referenceMap = array(
		'Matricula' => array(
			'columns'		=>	array('idUsuario_has_Turma'),
			'refTableClass'	=>	'Application_Model_DbTable_Matricula',
			'refColumns'	=>	array('idUsuario_has_Turma')
		)
	);
	
	
	public function insert( Array $data){
		
		parent::insert($data);
	}
	
	
	public function findForSelect($id){
		
		$sql = $this->select()->where('idUsuario_has_Turma = ?', $id)->order('idPresenca DESC');
		
		$result = $this->fetchAll($sql);
		
		return $result;
	}
	
	
	public function contaPresenca($id){
		
		$sql = $this->select()->from($this, new Zend_Db_Expr("SUM(Faltas)"))->where('idUsuario_has_Turma = ?', $id);
		
		$query = $this->fetchRow($sql);
		
		return $query;
	}
	
	
	public function deletar($id){
	
		$sql = $this->select()->where('idPresenca = ?', $id);
		
		$row = $this->fetchRow($sql);
		
		$row->delete();
		
	}
	
}