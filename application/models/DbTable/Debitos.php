<?php

class Application_Model_DbTable_Debitos extends Zend_Db_Table_Abstract
{
	protected $_name = 'Debitos';
	protected $_primary = 'idDebitos';
	
	/*protected $_referenceMap = array(
		
		'Matricula' => array(
		
			'columns'		=>	array('idUsuario_has_Turma'),
			'refTableClass'	=>	'Application_Model_DbTable_Matricula',
			'refColumns'	=>	array('idUsuario_has_Turma')
		)
	);*/
	
	
	public function insert( array $data ){
		
		parent::insert($data);
	}
	
	
	public function getAllDebitos() {
		$sql = $this->select()
			->order(array(new Zend_Db_Expr('idDebitos ASC')));

		$rows = $this->fetchAll($sql);

		return $rows;
	}

	public function getDebitos( $mes, $ano ) {
		$sql = $this->select();

		if ( ! is_null($mes) ) {
			$sql->where('mes = ?', $mes);
		}
		if ( ! is_null($ano) )  {
			$sql->where('ano = ?', $ano);
		}

		$sql->order(array(new Zend_Db_Expr('idDebitos ASC')));

		$rows = $this->fetchAll($sql);

		return $rows;
	}

	public function listar( $mes = null, $ano = null, $user_id = null ){

		if ( is_null( $mes ) && is_null($ano) )
			$rows = $this->getAllDebitos();
		else
			$rows = $this->getDebitos($mes, $ano);

		if ( empty($rows) ) return array();

		$usuarios_servicos = new Application_Model_DbTable_Usuarioservicos();
		$servico_model     = new Application_Model_DbTable_Servicos();
		$turma_model	   = new Application_Model_DbTable_Turma();

		$data = array();
		echo '<pre>';
		foreach($rows as $row) {
			$rowData = array(
							'idDebitos' 		=> $row->idDebitos,
							'mesPagamento'	 	=> $row->mesPagamento,
							'descontoMes' 		=> $row->descontoMes,
							'anoPagamento' 		=> $row->anoPagamento
				       );

			if ( ! is_null($row->idUsuario_has_Servicos) ) { //O Débito é referente a um serviço
				//$servico_user = $usuarios_servicos->find($row->idUsuario_has_Servicos)->toArray();

				$sql = $usuarios_servicos->select()->where('idUsuario_has_Servicos = ?', $row->idUsuario_has_Servicos);
				if ( ! is_null( $user_id) ) $sql->where('Usuario_idUsuario = ?', $user_id);
				$servico_user = $usuarios_servicos->fetchAll($sql)->toArray();

				if ( ! empty( $servico_user) ) {
					$servico_user = $servico_user[0];

					$rowData['type'] = 'servico';
					$rowData['valor_cobrado_servico'] = $servico_user['valor'];

					$servico_data = $servico_model->find($servico_user['Servicos_idServicos'])->toArray()[0];
					$rowData['nome_servico'] = $servico_data['nome'];
					$rowData['descricao_servico'] = $servico_data['descricao'];
					$rowData['valor_unitario_servico'] = $servico_data['valor'];

					$data[] = $rowData;
				}


			} else if ( ! is_null( $row->idUsuario_has_Turma) ) { //O débito é referente a matrícula em uma turma

				$sql = $turma_model->select()->where('idTurma = ?', $row->idUsuario_has_Turma);

				if ( ! is_null( $user_id ) ) $sql->where('idUsuario = ?', $user_id);

				$turma = $turma_model->fetchAll($sql)->toArray();

				$rowData['type'] = 'turma';
				$rowData['nome_turma'] = $turma['Nome'];
				$rowData['descricao_turma'] = $turma['Descricao'];
				$rowData['ano_turma'] = $turma['Ano'];
				$rowData['semestre_turma'] = $turma['Semestre'];



			}
		}
		var_dump($data);
		echo '</pre>';

		return $rowData;
	}
	
	public function findForSelect($id){
		
		$sql = $this->select()->where('idUsuario_has_Servicos = ?', $id);
		$row = $this->fetchRow($sql);
		
		return $row;
	}
	
	public function editar($id){
		
		$sql = $this->select()->where('idDebitos = ?', $id);
		
		$row = $this->fetchRow($sql);
		
		return $row->toArray();
	}
	
	public function deletar($id){
		
		$sql = $this->select()->where('idDebitos = ?', $id);
		
		$row = $this->fetchRow($sql);
		
		$row->delete();
		
	}

	/**
	 * Processa os débitos (matriculas e serviços ainda não preocessados para o mês)
	 * @param $mesAtual
	 * @param $anoAtual
	 */
	public function processarDebitos($mesAtual, $anoAtual) {
		$anoLetivo      = "2014";
		$semestreAtual  = "2";

		$usuarios_servicos   = new Application_Model_DbTable_Usuarioservicos();
		$matriculas          = new Application_Model_DbTable_Matricula();

		$matriculasCorrentes = $matriculas->getMatriculasNaoProcessadas( $anoLetivo, $semestreAtual, $mesAtual );

		if ( count($matriculasCorrentes) > 0 ) {
			foreach ($matriculasCorrentes as $mat) {
				$this->insert(
					array(
						'mesPagamento' => $mesAtual,
						'anoPagamento' => $anoAtual,
						'idUsuario_has_Turma' => $mat->idUsuario_has_Turma,
					)
				);
			}
		}

		$servicos_correntes = $usuarios_servicos->getServicosNaoProcessados( $mesAtual );

		if ( count($servicos_correntes) > 0 ) {
			foreach($servicos_correntes as $sc ) {
				$this->insert(
					array(
						'mesPagamento' => $mesAtual,
						'anoPagamento' => $anoAtual,
						'idUsuario_has_Servicos' => $sc->idUsuario_has_Servicos
					)
				);
			}
		}
	}
	
}