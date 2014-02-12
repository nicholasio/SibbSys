<?php

class Application_Model_DbTable_Debitos extends Zend_Db_Table_Abstract
{
	protected $_name = 'Debitos';
	protected $_primary = 'idDebitos';
	
	protected $_referenceMap = array(
		
		'Matricula' => array(
		
			'columns'		=>	array('idUsuario_has_Turma'),
			'refTableClass'	=>	'Application_Model_DbTable_Matricula',
			'refColumns'	=>	array('idUsuario_has_Turma')
		)
	);
	
	
	public function insert( array $data){
		
		parent::insert($data);
	}
	
	
	
	public function listar(){
		
		$sql = $this->select()
					->order(array(new Zend_Db_Expr('idDebitos ASC')));

		$rows = $this->fetchAll($sql);
		
		return $rows;
	}
	
}