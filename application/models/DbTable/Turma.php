<?php

class Application_Model_DbTable_Turma extends Zend_Db_Table_Abstract{

    protected $_name = 'Turma';
    protected $_primary = 'idTurma';
    
    protected $_dependentTables = array('Application_Model_DbTable_Matricula', 'Application_Model_DbTable_Arquivos');
    
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
    
    public function _find($idUsuario, $idTurma){
    	
    	$sql = $this->select()->where('idUsuario = ?', $idUsuario)->where('idTurma = ?', $idTurma);
    	
    	return $this->fetchRow($sql);
    	
    }
    
    
    public function editar($id){
	
		$sql = $this->select()->where('idTurma = ?', $id);
		$row = $this->fetchRow($sql);
		
		if(null !== $row)
			return $row->toArray();
		
	}
	
	
	public function ativar($id){
	
		$sql = $this->select()->where('idTurma = ?', $id);
		$row = $this->fetchRow($sql);
		
		$linha = array(
			'Status'=>'ativo'
		);
		
		$where = $this->getAdapter()->quoteInto('idTurma = ?', $id);
		$this->update($linha, $where);
		
		return $row;
	}
	
	
	public function listar($ano = false, $semestre = false){
	
		$sql = $this->select();

		if ( $ano !== false && $semestre !== false){
			$sql->where('Ano = ?' , $ano)->where('Semestre = ?', $semestre);
		}

		$sql->order(array(new Zend_Db_Expr('Nome ASC')));
		
		$rows = $this->fetchAll($sql);
		
		return $rows;
	}
	
	
	public function lista(){
			
		$sql = $this->select()->from($this, new Zend_Db_Expr("DISTINCT(idUsuario)"));
		
		$sql->order(array(new Zend_Db_Expr('Nome ASC')));
	
		$rows = $this->fetchAll($sql);
	
		return $rows;
	}
	
	public function turmas($id){
		
		$where = 'ativo';
		$sql = $this->select()->where('idUsuario = ?', $id)
							  ->where('Status = ?', $where)
							  ->order('Semestre ASC')
							  ->order('Ano ASC');
		
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
		
		$matricula_model = new Application_Model_DbTable_Matricula();
		$turma_model = new Application_Model_DbTable_Turma();
		$notas_model = new Application_Model_DbTable_Nota();

		$alunos = $matricula_model->findForSelect($id)->toArray();
		$notas  = $notas_model->findForSelect($id)->toArray();

		$podeEncerrar = true;

		if ( count($alunos) != count($notas) ) {
			$podeEncerrar = false;
		}

		if ( $podeEncerrar ) {
			foreach($notas as $nota) {
				if($nota['Unit1'] == '0' || $nota['Unit2'] == '0' || $nota['Unit3'] == '0'){
				//if ( is_null($nota['Unit1']) || is_null($nota['Unit2']) || is_null($nota['Unit3']) ) {
					$podeEncerrar = false;
					break;
				}

			}
		}

		if ( $podeEncerrar ) {

			for($i = 0; $i< count($notas) ; $i++) {
				$nota = $notas[$i];
				$aluno = $alunos[$i];
				$media = $nota['Unit1'] + $nota['Unit2'] + $nota['Unit3'];
				$media = $media/3;

				if ( $media >= 7.0 ) {
					$matricula_model->statusAprovado($aluno['idUsuario_has_Turma']);
				} else {
					$matricula_model->statusReprovado($aluno['idUsuario_has_Turma']);
				}
			}

			$linha = array(
				'Status'=>'Encerrada'
			);

			$where = $this->getAdapter()->quoteInto('idTurma = ?', $id);
			$this->update($linha, $where);

			return true;
		} else {
			return false;
		}
	}
	
	
	public function _findAno($id){
	
		$sql = $this->select()
				   ->from(array('t' => 'Turma'), array())
				   ->joinInner(array('u' => 'Usuario_has_Turma'), 't.idTurma = u.Turma_idTurma', array('t.Ano'))
				   ->distinct('t.Ano')
				   ->order('t.Ano DESC');
		if ( $id !== false )
			$sql->where('Usuario_idUsuario = ?', $id);
		
		$rows = $this->fetchAll($sql);
	
		return $rows;
	}
	
	
	public function _findSemestre($id){
		
		$sql = $this->select()
		->from(array('t' => 'Turma'), array())
		->joinInner(array('u' => 'Usuario_has_Turma'), 't.idTurma = u.Turma_idTurma', array('t.Semestre'))
		->distinct('t.Semestre');

		if ( $id !== false )
			$sql->where('Usuario_idUsuario = ?', $id);
		
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
	
	public function listaData($idUsuario){
		
		/*$sql = $this->select()->where('idTurma = ?', $idTurma)
					->order(array(new Zend_Db_Expr('Ano, Semestre ASC')));
		
		$query = $this->fetchAll($sql);
		
		return $query;
		*/
		
		$sql = $this->select()->from(array('m' => 'Usuario_has_Turma'), array())
					->joinInner(array('t' => 'Turma'), 'm.Turma_idTurma = t.idTurma', array())
					->distinct('m.idUsuario_has_Turma')
					->distinct('t.idTurma')
					->where('m.Usuario_idUsuario = ?', $idUsuario)
					//->order(array(new Zend_Db_Expr('t.Semestre ASC')))
					->order(array(new Zend_Db_Expr('t.Ano ASC')));
		$query = $this->fetchAll($sql);
		
		return $query;
		
		//order(array(new Zend_Db_Expr('Nome ASC')));
		
		
	}
	
}