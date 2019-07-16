<?php 

class Admin_FaturasController extends AppBaseController{
	
	
	public function preDispatch(){
	
		parent::preDispatch();
		$auth = Zend_Auth::getInstance();
		if(!$auth->hasIdentity()){
			$this->_redirect('/default');
		}
	}

	/**
	 * Cria um registro de fatura e associa os débitos selecionados
     */
	public function novoAction() {

		$fatura_model = new Application_Model_DbTable_Faturas();

		if ( $this->_request->isPost() ) {
			$user_id = $_POST['user_id'];
			$debitos_id = $_POST['debitos'];

			$fatura_model->gerarFatura($debitos_id, $user_id);
		}

		$this->_redirect("/admin/faturas");
	}


	public function indexAction(){

		if ($this->_helper->FlashMessenger->hasMessages()) {
			$this->view->messages = $this->_helper->FlashMessenger->getMessages();
		}

		$faturas_model = new Application_Model_DbTable_Faturas();
		$user_id = null;

		if ( isset($_GET['aluno']) ) {
			$user_id = $_GET['aluno'];
			$this->view->user_id = $user_id;
		}

		$start    = isset( $_GET['start'] ) ? (int) $_GET['start'] : 1;
		$length   = isset( $_GET['length'] ) ? (int) $_GET['length'] : 50;
		$pagina   = isset( $_GET['pagina'] ) ? (int) $_GET['pagina'] : 1;

		if ( $user_id == -1 ) $user_id = null;

		$this->view->rows = $faturas_model->listar($user_id, $start, $length, $pagina);
		$this->view->total = $faturas_model->numeroFaturas($user_id);
		$this->view->per_page = $length;
		$this->view->page = $start > 0 ? ceil( $this->view->total / ($start * $length) ) : 1;
		$this->view->pagina = $pagina;
	}
	
	
	public function editarAction(){
		
		$model = new Application_Model_DbTable_Faturas();
		$form = new Application_Form_Faturas();
		
		$id = $this->_getParam('idFaturas');
		
		$data = $model->editar($id);
		if(is_array($data)){
			$form->populate($data);
		}
		
		if($this->_request->isPost()){
			if($form->isValid($this->_request->getPost())){
				$data = $form->getValues();
				if($id){
					$where = $model->getAdapter()->quoteInto('idFatura = ?', $id);
					$model->update($data, $where);
					$this->_redirect("/admin/faturas");
				}
			}
		}
		$this->view->form = $form;
	}
	
	
	public function deleteAction(){
		
		$model = new Application_Model_DbTable_Faturas();
		
		$id = $this->_getParam('idFaturas');

		$model->deletar($id);

		$this->_helper->flashMessenger->addMessage("Fatura #{$id} removida");

		$this->_redirect("/admin/faturas");
	}
	
	
	public function downloadAction(){
		
		$idFatura = $this->_getParam('idFatura');
		
		$faturas_model = new Application_Model_DbTable_Faturas();
		$pagamento_model = new Application_Model_DbTable_Pagamento();
		
		$this->view->rows = $faturas_model->listagem($idFatura);

	}
	
	
	public function pendenteAction(){
		
		$idFatura = $this->_getParam('idFatura');
		
		$faturas_model = new Application_Model_DbTable_Faturas();
		$pagamento_model = new Application_Model_DbTable_Pagamento();
		
		$this->view->rows = $faturas_model->listagem($idFatura);
	}
	
	public function relatorioAction(){
		
		$faturas_model = new Application_Model_DbTable_Faturas();
		
		$this->view->rows = $faturas_model->listar();
		
	}
	
	public function relatorioDownloadAction(){
		
		$faturas_model = new Application_Model_DbTable_Faturas();
		
		$this->view->rows = $faturas_model->listar();
		
	}
	
}