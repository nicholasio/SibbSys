<?php

class Application_Model_DbTable_Pagamento extends Zend_Db_Table_Abstract{
	
	protected $_name = 'Pagamento';
	protected $_primary = 'idPagamento';
	
	protected $_referenceMap = array(
		
		'Faturas' => array(
		
			'columns'		=> array('Faturas_idFaturas'),
			'refTableClass'	=> 'Application_Model_DbTable_Faturas',
			'refColumns'	=> array('idFaturas')
		)
	);
	
	public function insert(array $data){
		
		parent::insert($data);
	}
	
}