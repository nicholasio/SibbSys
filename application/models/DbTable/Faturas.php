<?php

class Application_Model_DbTable_Faturas extends Zend_Db_Table_Abstract{
	
	protected $_name = 'Faturas';
	protected $_primary = 'idFatura';
	
	protected $_dependentTables = array('Application_Model_DbTable_Pagamento');
	
	protected $_referenceMap = array(
		
		'Usuario' => array(
		
			'columns'		=> array('Usuario_idUsuario'),
			'refTableClass'	=> 'Application_Model_DbTable_Usuario',
			'refColumns'	=> array('idUsuario')	
		),
	);
	
	public function insert(array $data){
		
		parent::insert($data);
	}
	
	
	public function editar($id){
		
		$sql = $this->select()->where('idFatura = ?', $id);
		$row = $this->fetchRow($sql);
		
		if(null !== $row)
			return $row->toArray();
	}
	

	public function deletar($id){
		$faturas_debitos_model = new Application_Model_DbTable_FaturasDebitos();
		$where = $faturas_debitos_model->getAdapter()->quoteInto('Faturas_idFatura = ?', $id);
		$faturas_debitos_model->delete( $where);

		$where = $faturas_debitos_model->getAdapter()->quoteInto('idFatura = ?', $id);
		return $this->delete($where);
	}
	
	
	public function listar($user_id = NULL){

		$faturas_debitos_model = new Application_Model_DbTable_FaturasDebitos();
		$debitos_model 		   = new Application_Model_DbTable_Debitos();

		$sql = $this->select();

		if ( ! is_null($user_id) )
			$sql->where('Usuario_idUsuario = ?', $user_id);

		$sql->order(array(new Zend_Db_Expr('idFatura ASC')));
		
		$rows = $this->fetchAll($sql);

		if ( $rows )
			$rows = $rows->toArray();
		else
			return array();

		$data = array();

		foreach($rows as $row) {
			$debitos_id		 = $faturas_debitos_model->getDebitos($row['idFatura']);
			$debitos_faturas = $debitos_model->listar(null,null,null,$debitos_id);

			$data[] = array_merge($row, array('debitos' => $debitos_faturas) );
		}

		return $data;
	}

	public function gerarFatura($debitos_id, $user_id) {
		$faturas_debitos_model = new Application_Model_DbTable_FaturasDebitos();
		$debitos_model 		   = new Application_Model_DbTable_Debitos();

		$debitos_data = $debitos_model->listar(null,null,null,$debitos_id);
		$valor_total = 0;

		foreach($debitos_data as $debito) {
			$valor_total += $debito[$debito['type']]['valor_final'];
		}


		$this->insert( array('Usuario_idUsuario' => $user_id, 'mes' => date('n'), 'ano' => date('Y'), 'valorFatura' => $valor_total ) );
		$fatura_id =  $this->getAdapter()->lastInsertId();

		foreach( $debitos_id as $debito_id ) {
			$faturas_debitos_model->insert(array('Faturas_idFatura' => $fatura_id, 'Debitos_idDebitos' => $debito_id) );
		}

	}
	
	
	public function listagem($idFatura){
		
		$faturas_debitos_model = new Application_Model_DbTable_FaturasDebitos();
		$debitos_model 		   = new Application_Model_DbTable_Debitos();
		$usuario_model		   = new Application_Model_DbTable_Usuario();
		
		$sql = $this->select()->where('idFatura = ?', $idFatura);
		
		$rows = $this->fetchAll($sql);
		
		if ( $rows )
			$rows = $rows->toArray();
		else
			return array();
		
		$data = array();
		
		foreach($rows as $row) {
			$id	= $row['Usuario_idUsuario'];
			$debitos_id		 = $faturas_debitos_model->getDebitos($row['idFatura']);
			$debitos_faturas = $debitos_model->listar(null,null,null,$debitos_id);
			$getUsuario		 = $usuario_model->getUser($id);
		
			$data[] = array_merge($row, array('debitos' => $debitos_faturas, 'usuario'	=>	$getUsuario) );
		}
		
		return $data;
		
	}
	
	
}