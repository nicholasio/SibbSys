<?php 

class Professor_PresencaController extends AppBaseController{
	
	
	public function init(){
		
	}
	
	
	public function preDispatch(){
	
		parent::preDispatch();
		$auth = Zend_Auth::getInstance();
		if(!$auth->hasIdentity()){
			$this->_redirect('/default');
		}
	}
	
	
	public function indexAction(){
		
		if ($this->_helper->FlashMessenger->hasMessages()) {
			$this->view->messages = $this->_helper->FlashMessenger->getMessages();
		}
		
		$id = $this->_getParam('idTurma');
		 
		$user = new Application_Model_DbTable_Usuario();
		$model = new Application_Model_DbTable_Presenca();
		 
		$this->view->result = $model->findForSelect($id);
		 
		$turma = new Application_Model_DbTable_Turma();
		$this->view->linha = $turma->findForSelect($id);
		$this->view->row = $turma->hasTurma($id);
		
		$matric = new Application_Model_DbTable_Matricula();
		$this->view->rows = $matric->findForSelect($id);
		$this->view->find = $matric->_findId($id);
		
	}
	
	
	public function postPresencaAction(){
		
		$model = new Application_Model_DbTable_Presenca();

		if ( $this->_request->isPost() ) {
			$count = count($_POST['faltas']);
			
			for($i = 0; $i < $count; $i++) {
				$data['Data'] = $_POST['data'][$i];
				$data['Faltas'] = $_POST['faltas'][$i];
				$data['idUsuario_has_Turma'] = $_POST['idMatricula'][$i];
				$data['Turma_idTurma'] = $_POST['idTurma'][$i];
				$idTurma = $_POST['idTurma'][$i];
				if(! empty($data['Faltas'])){
					$model->insert($data);
				}
			}	
		}
		$this->_helper->flashMessenger->addMessage("Faltas Inseridas com sucesso!");
		$this->_redirect("/professor/index/turmas");
	}
	
	
	public function listarAction(){

		$id = $this->_getParam('idTurma');
			
		$user = new Application_Model_DbTable_Usuario();
		$model = new Application_Model_DbTable_Presenca();
			
		$this->view->result = $model->findForSelect($id);
			
		$turma = new Application_Model_DbTable_Turma();
		$this->view->linha = $turma->findForSelect($id);
		$this->view->row = $turma->hasTurma($id);
		
		$matric = new Application_Model_DbTable_Matricula();
		$this->view->rows = $matric->findForSelect($id);
		$this->view->find = $matric->_findId($id);
		
	}
	
	
	public function deleteAction(){
		
		$id = $this->_getParam('idPresenca');
		$idTurma = $this->_getParam('idTurma');
			 
		$model = new Application_Model_DbTable_Presenca();
		$model->deletar($id);
		$this->_redirect("/professor/presenca/listar/idTurma/$idTurma");
	}
}