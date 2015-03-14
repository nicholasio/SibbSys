<?php 

class Application_Model_DbTable_Usuarioservicos extends Zend_Db_Table_Abstract{
	
	protected $_name = 'Usuario_has_Servicos';
	protected $_primary = 'idUsuario_has_Servicos';
	
	//protected $_dependentTables = array('Application_Model_DbTable_Debitos');
	
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
		$data['mes'] = date('n');
		$data['ano'] = date('Y');

		parent::insert($data);
	}
	
	
	public function getServicosNaoProcessados($mesAtual , $anoAtual ) {
		$sql = $this->select()->where("mes = ?", $mesAtual)->where('ano = ?', $anoAtual)
		->where('idUsuario_has_Servicos NOT IN (SELECT idUsuario_has_Servicos from Debitos WHERE idUsuario_has_Servicos IS NOT NULL)');
		$rows = $this->fetchAll($sql);
		
		return $rows;
	}
	public function listar($id){
		
		$sql = $this->select()->where('Usuario_idUsuario = ?', $id);
		$sql->order(array(new Zend_Db_Expr('idUsuario_has_Servicos DESC')));
		
		$rows = $this->fetchAll($sql);
		
		return $rows;
	}

	
	public function deletar($id){
		
		$debito_model = new Application_Model_DbTable_Debitos();
		$faturas_debitos_model = new Application_Model_DbTable_FaturasDebitos();

		$debito = $debito_model->findForSelect($id);
		$debito_fatura = $faturas_debitos_model->findDebito($debito->idDebitos);

		$sql = $this->select()->where('idUsuario_has_Servicos = ?', $id);
		$row = $this->fetchRow($sql);
		
		if( is_null($debito_fatura) ){
			$debito_model->deletar($debito->idDebitos);
			$row->delete();
		}
		else{
			return 'igual';
		}
	}

	
}