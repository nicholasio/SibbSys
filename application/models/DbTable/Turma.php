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
    		'columns'		=>	array('idUsuario'),
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
	
    
    public function _find($idUsuario){
    	
    	$sql = $this->select()->where('idUsuario = ?', $idUsuario);
    	
    	return $this->fetchRow($sql);
    	
    }
    
    
    public function editar($id){
	
		$sql = $this->select()->where('idTurma = ?', $id);
		$row = $this->fetchRow($sql);
		
		if(null !== $row)
			return $row->toArray();
		
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
	
	
	public function lista(){
			
		$sql = $this->select()->from($this, new Zend_Db_Expr("DISTINCT(idUsuario)"));
	
		$rows = $this->fetchAll($sql);
	
		return $rows;
	}
	
	public function turmas($id){
		
		$where = 'ativo';
		$sql = $this->select()->where('idUsuario = ?', $id)
							  ->where('Status = ?', $where);
		
		$rows = $this->fetchAll($sql);
		
		return $rows;
	}
	
	
	public function getTurma($id){

		$sql = $this->select()->where('idUsuario = ?', $id);
		
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
	
	
	public function _findAno($id){
	
		$sql = $this->select()
				   ->from(array('t' => 'Turma'), array())
				   ->joinInner(array('u' => 'Usuario_has_Turma'), 't.idTurma = u.Turma_idTurma', array('t.Ano'))
				   ->distinct('t.Ano')
				   ->order('t.Ano DESC')
				   ->where('Usuario_idUsuario = ?', $id);
		
		$rows = $this->fetchAll($sql);
	
		return $rows;
	}
	
	
	public function _findSemestre($id){
		
		$sql = $this->select()
		->from(array('t' => 'Turma'), array())
		->joinInner(array('u' => 'Usuario_has_Turma'), 't.idTurma = u.Turma_idTurma', array('t.Semestre'))
		->distinct('t.Semestre')
		->where('Usuario_idUsuario = ?', $id);
		
		$rows = $this->fetchAll($sql);
		
		return $rows;
	}
	
	
	public function getPeriodo($idUser){
		
		$sql = $this->select()
					->from(array('t' => 'Turma'), array())
					->joinInner(array('u' => 'Usuario_has_Turma'), 't.idTurma = u.Turma_idTurma', array('t.Ano','t.Semestre'))
					->order("t.Ano DESC")
					->order("t.Semestre DESC")
					->where('Usuario_idUsuario = ?', $idUser);
		
		$rows = $this->fetchRow($sql);
		
		return $rows;
		
	}
	
}