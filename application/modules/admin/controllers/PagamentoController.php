<?php 

class Admin_PagamentoController extends AppBaseController{
	
	
	public function preDispatch(){
	
		parent::preDispatch();
		$auth = Zend_Auth::getInstance();
		if(!$auth->hasIdentity()){
			$this->_redirect('/default');
		}
	}

	public function deleteAction(){
		
		$model = new Application_Model_DbTable_Pagamento();
		
		$id = $this->_getParam('idPagamento');
		$user_id = $this->_getParam('idUsuario');
		
		$model->deletar($id);

		$this->_helper->flashMessenger->addMessage("Pagamento removido da Fatura #{$id}");

		$this->_redirect('/admin/faturas?aluno=' . $user_id);
	}

	public function addpagamentoAction() {

		$pagamento_model = new Application_Model_DbTable_Pagamento();
		
		$pegaData = ($_POST['data']);
		$ano = substr($pegaData,0,4);
		$mes = substr($pegaData,5,2);
		$dia = substr($pegaData,8,10);
		
		$array_data = $ano. '/' . $mes . '/' . $dia;
		

		if ( $this->_request->isPost() ) {
			$idFatura = $_POST['idFatura'];
			//$dataValor     = $_POST['data'];
			$valor    = $_POST['valor'];
			$user_id  = $_POST['user_id'];
			$descricao = $_POST['descricao'];

			$data = array( 'Faturas_idFatura' => $idFatura, 'dataPagamento' => $array_data, 'valorPagamento' => $valor, 'Descricao' => $descricao );
			$pagamento_model->insert($data);

			$this->_helper->flashMessenger->addMessage("Pagamento adicionado na Fatura #{$idFatura}");

			$this->_redirect('/admin/faturas?aluno=' . $user_id);
		}
	}
	
}