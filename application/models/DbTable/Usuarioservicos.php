<?php 

class Application_Model_DbTable_Usuarioservicos extends Zend_Db_Table_Abstract{
	
	protected $_name = 'Usuario_has_Servicos';
	protected $_primary = 'idUsuario_has_Servicos';
	
	protected $_dependentTables = array('Application_Model_DbTable_Debitos');
	
	protected $_referenceMap = array
	(
		'Usuario' => array
		(
			'columns'		=> array('Usuario_idUsuario'),
			'refTableClass'	=> 'Application_Model_DbTable_Usuario',
			'refColumns'	=> array('idUsuario')
		),
		
		'Servicos' => array
		(
			'columns'		=> array('Servicos_idServicos'),
			'refTableClass'	=> 'Application_Model_DbTable_Servicos',
			'refColumns'	=> array('idServicos')
		)
	);
	
	
	public function insert( Array $data){
		
		parent::insert($data);
	}
	
	
	public function listar($id){
		
		$sql = $this->select()->where('Usuario_idUsuario = ?', $id);
		
		$rows = $this->fetchAll($sql);
		
		return $rows;
	}
	
	public function deletar($id){
		
		
	}
}