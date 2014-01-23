<?php

class Application_Model_DbTable_Nota extends Zend_Db_Table_Abstract
{

    protected $_name = 'Nota';
    protected $_primary = 'idNota';
    
    protected $_referenceMap = array(
    	'Maticula' => array(
    		'columns'		=>	array('idUsuario_has_Turma'),
    		'refTableClass'	=>	'Application_Model_DbTable_Maticula',
    		'refColumns'	=>	array('idUsuario_has_Turma')
    	)
    );
	
    
    public function insert( Array $data){
    	
    	parent::insert($data);
    }
    
    
     public function findForSelect($id){
    	
    	$sql = $this->select()->where('Turma_idTurma = ?', $id);

    	$result = $this->fetchAll($sql);
    	
		return $result;
    }
    
    
    public function getNota($id){
    	
    	$sql = $this->select()->where('idUsuario_has_Turma = ?', $id);

    	$rows = $this->fetchAll($sql);
    	
    	return $rows->toArray();
    }
    
    
    public function somaNota($id){
    
    	$sql = $this->select()->from($this, new Zend_Db_Expr("SUM(Nota)"))
    				->where('idUsuario_has_Turma = ?', $id);
    	
    	$query = $this->fetchRow($sql);
    	
    	return $query;
    }
    
    
    public function findUnit($idUser){
    
    	$sql = $this->select()->where('idUsuario_has_Turma = ?', $idUser);
    	
    	$row = $this->fetchAll($sql);
    	
    	return $row;
    }
    
    
    public function deletar($id){
    
    	$sql = $this->select()->where('idNota = ?', $id);
    	
    	$row = $this->fetchRow($sql);
    	
    	$row->delete();
    }
}