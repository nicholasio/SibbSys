<?php

class Application_Model_DbTable_Usuario extends Zend_Db_Table_Abstract{

	protected $_name = 'Usuario';
	protected $_primary = 'idUsuario';
	
	protected $_dependentTables = array('Application_Model_DbTable_Matricula','Application_Model_DbTable_Turma', 
										'Application_Model_DbTable_Usuarioservicos','Application_Model_DbTable_Faturas');
	
	protected $_referenceMap = array(
		
		'Igreja' => array(
			'columns'		=> array('Igreja_idIgreja'),
			'refTableClass'	=> 'Application_Model_DbTable_Igreja',
			'refColumns'	=> array('idIgreja')
		),
		
		'Curso'	=>	array(
			'columns'		=>	array('Curso_idCurso'),
			'refTableClass'	=>	'Application_Model_DbTable_Curso',
			'refColumns'	=>	array('idCurso')
		)
	);
	
	public function insert(Array $data){
		
		$data['Senha'] = sha1($data['Senha']);
		$data['ConfirmaSenha'] = sha1($data['ConfirmaSenha']);
	
		parent::insert($data);
	}
	
	
	public function selectPadrao(){
		
		$sql = $this->select();
		$rows = $this->fetchAll($sql);
		
		return $rows;
	}
	
	
	public function selecionar(){
		
		$sql = $this->select()->where('Status = ?', 'ativo');
		
		$row = $this->fetchRow($sql);
		
		return $row;
	}
	
	
	public function findForSelect(){
		
		$sql = $this->select()
					->where('Tipo != ?', 3)
					->where('Status = ?', 'ativo')
					->order(array(new Zend_Db_Expr('Nome ASC')));
		
		$rows = $this->fetchAll($sql);
		
		return $rows;
	}
	
	
	public function editar($id){
		
		$sql = $this->select()->where('idUsuario = ?', $id);
		
		$row = $this->fetchRow($sql);
			
		if(null !== $row)
			return $row->toArray();
	}
	
	
	public function deletar($id){
		
		$sql = $this->select()->where('idUsuario = ?', $id);
		$row = $this->fetchRow($sql);

		$linha = array(
			'Status'=>'inativo'
		);
		
		$where = $this->getAdapter()->quoteInto('idUsuario = ?', $id);
		$this->update($linha, $where);

	}
	
	public function ativa($id){
	
		$sql = $this->select()->where('idUsuario = ?', $id);
		$row = $this->fetchRow($sql);
	
		$linha = array(
				'Status'=>'ativo'
		);
	
		$where = $this->getAdapter()->quoteInto('idUsuario = ?', $id);
		$this->update($linha, $where);
	
	}
	
	
	public function listar(){

		$where = 'ativo';
		$sql = $this->select()
					->where('Status = ?', $where)
					->order(array(new Zend_Db_Expr('Nome ASC')));
    	
		$rows = $this->fetchAll($sql);
		
		return $rows;
	}
	
	
	public function getUsuario($email){
		
		$sql = $this->select()->where('Email = ?', $email)->where('Status = ?', 'ativo');
		
		$row = $this->fetchRow($sql);
		
		if(null !== $row)
			return $row->toArray();
	}
	
	
	public function getUser($id){
		
		$sql = $this->select()->where('idUsuario = ?', $id);
		
		$rows = $this->fetchAll($sql);
		
		return $rows;
	}

	public function getAniversariantes($mes) {

		$sql = $this->select()->where('SUBSTRING(DataNascimento,4,2)  = ?', $mes)
							  ->order(array(new Zend_Db_Expr('DataNascimento ASC')));

		return $this->fetchAll($sql);
	}
	
	public function listaUsuario(){
	
		//$sql->order(array(new Zend_Db_Expr('idUsuario_has_Turma ASC')));
		//$sql->order(array(new Zend_Db_Expr('idPagamento ASC')));
	
		$sql = $this->select()->where('Status = ?', 'ativo')
					->order(array(new Zend_Db_Expr('Nome ASC')));
					
		$query = $this->fetchAll($sql);
	
		return $query;
	}
	
	public function verificaEmail($email){
		
		$sql = $this->select()->where('Email = ?', $email);
		
		$query = $this->fetchRow($sql);
		
		return $query;
	}

	public function versiculo(){

		$file = getcwd() . '/scripts/versículos.txt';
		$input = file($file);
		$texto = array_rand($input, 2);
		
		$verso = $input[$texto[0]];

		return $verso;

	}
	
}