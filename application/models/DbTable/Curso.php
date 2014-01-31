<?php

class Application_Model_DbTable_Curso extends Zend_Db_Table_Abstract{

    protected $_name = 'Curso';
    protected $_primary = 'idCurso';

    protected $_dependentTables = array('Application_Model_DbTable_Usuario');
    
    
    public function insert( Array $data){
    
    	parent::insert($data);
    	
    }
    
    
    public function editar($id){
    	
    	$sql = $this->select()->where('idCurso = ?', $id);
    	$row = $this->fetchRow($sql);
    	
    	if(null !== $row)
    	return $row->toArray();
    	
    }
    
    public function deletar($id){
    	
    	$sql = $this->select()->where('idCurso = ?', $id);
    	$row = $this->fetchRow($sql);
    	
    	$linha = array(
    		'Status' => 'inativo'
    	);
    	
    	$where = $this->getAdapter()->quoteInto('idCurso = ?', $id);
    	$this->update($linha, $where);
    	
    }
    
    public function listar(){
    
    	$where = 'ativo';
    	$sql = $this->select()->where('Status = ?', $where)->order('Nome ASC');
    	
    	$rows = $this->fetchAll($sql);
    	
    	return $rows;
    	
    }
    
}