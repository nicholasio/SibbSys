<?php

class Application_Model_DbTable_Turma extends Zend_Db_Table_Abstract{

    protected $_name = 'Turma';
    protected $_primary = 'idTurma';
    
    protected $_dependentTables = array('Application_Model_DbTable_Matricula');
    
    protected $_referenceMap = array(
    
    	'Disciplina' => array(
    		'columns'		=>	array('Disciplina_idDisciplina'),
    		'refTableClass'	=>	'Application_Model_DbTable_Disciplina',
    		'refColumns'	=>	array('idDisciplina')
    	),
    	
    	'Usuario'	=> array(
    		'columns'		=>	array('Usuario_idUsuario'),
    		'refTableClass'	=>	'Application_Model_DbTable_Usuario',
    		'refColumns'	=>	array('idUsuario')
    	)
    );
    
    public function insert(Array $data){
    	
    	parent::insert($data);
    }
    
    
    public function findForSelect($id){
    	
    	$sql = $this->select()->where('idTurma = ?', $id);
    	$linha = $this->fetchAll($sql);
    	
    	return $linha;
    }
	
    
    public function find($idUsuario){
    	
    	$sql = $this->select()->where('Usuario_idUsuario = ?', $idUsuario);
    	
    	return $this->fetchRow($sql);
    	
    }
    
    
    public function editar($id){
	
		$sql = $this->select()->where('idTurma = ?', $id);
		$row = $this->fetchRow($sql);
		
		return $row;
		
	}
	
	
	public function deletar($id){
	
		$sql = $this->select()->where('idTurma = ?', $id);
		$row = $this->fetchRow($sql);
		
		$linha = array(
			'Status'=>'inativo'
		);
		
		$where = $this->getAdapter()->quoteInto('idTurma = ?', $id);
		$this->update($linha, $where);
	}
	
	
	public function listar(){
	
		$where = 'ativo';
		$sql = $this->select()->where('Status = ?', $where)->order('Nome ASC');
		
		$rows = $this->fetchAll($sql);
		
		return $rows;		
	}
	
	
	public function turmas($id){
		
		$where = 'ativo';
		$sql = $this->select()->where('Usuario_idUsuario = ?', $id)
							  ->where('Status = ?', $where);
		
		$rows = $this->fetchAll($sql);
		
		return $rows;
	}
	
	
	public function getTurma($id){

		$sql = $this->select()->where('Usuario_idUsuario = ?', $id);
		
		$row = $this->fetchRow($sql);
		
		return $row;
	}

	
	public function hasTurma($id){
		
		$sql = $this->select()->where('idTurma = ?', $id);
		
		$row = $this->fetchRow($sql);
		
		return $row;
	}
	
	
	public function encerrarTurma($id){
	
		$sql = $this->select()->where('idTurma = ?', $id);
		$row = $this->fetchRow($sql);
		
		$linha = array(
			'Status'=>'Encerrada'
		);
		
		$where = $this->getAdapter()->quoteInto('idTurma = ?', $id);
		$this->update($linha, $where);
	}
	
	
	public function buscar($keyword){
	
		$sql = $this->select()->where('Nome LIKE ?', "%$keyword%");
		
		$query = $this->fetchAll($sql);
		
		return $query;
	}
}