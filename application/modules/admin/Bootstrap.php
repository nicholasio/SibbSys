<?php
class Admin_Bootstrap extends Zend_Application_Module_Bootstrap{

}

class AppBaseController extends Zend_Controller_Action {

	public function preDispatch(){
		parent::preDispatch();

		$this->tarefasAgendadas();

	}

	public function tarefasAgendadas() {
		$mesAtual       = (int) date('n');
		$diaAtual       = (int) date('j');
		$anoAtual       = (int) date('Y');

		$date = new DateTime($anoAtual . '-' . $mesAtual . '-' . $diaAtual);
		$ultimo_dia_mes = $date->format('t');

		$configs = new Application_Model_DbTable_Configs();

		$dia_fatura  = (int) $configs->findKey('dia_fatura');

		$this->processarDebitos( $mesAtual, $anoAtual );

		if ( $diaAtual >= ($ultimo_dia_mes - $dia_fatura) ) {
			$this->gerarFaturas();
		}

	}

	public function gerarFaturas() {
		$debitos_model = new Application_Model_DbTable_Debitos();
		$faturas_model = new Application_Model_DbTable_Faturas();

		$debitos_nao_faturados = $debitos_model->listar();

		/**
		 * Agrupando Débitos por Usuário
		 */
		$debitos_id_by_user = array();
		foreach($debitos_nao_faturados as $debito) {
			$debitos_id_by_user[$debito['user']['idUsuario']][] = $debito['idDebitos'];
		}

		/**
		 * Gerando Faturas pelos débitos pendentes de cada usuário
		 */
		foreach($debitos_id_by_user as $user_id => $debitos_id) {
			$faturas_model->gerarFatura($debitos_id, $user_id);
		}
	}

	/**
	 * Invoca o método processarDebitos do DbTable Debitos.
	 * @param $mesAtual
	 * @param $anoAtual
	 */
	public function processarDebitos( $mesAtual, $anoAtual ) {
		$debitos = new Application_Model_DbTable_Debitos();

		$debitos->processarDebitos($mesAtual, $anoAtual);
	}
}