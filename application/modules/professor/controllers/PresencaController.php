<?php 

class Professor_PresencaController extends Zend_Controller_Action{
	
	
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
		
		$id = $this->_getParam('idTurma');
		 
		$user = new Application_Model_DbTable_Usuario();
		$model = new Application_Model_DbTable_Presenca();
		 
		$this->view->result = $model->findForSelect($id);
		 
		$turma = new Application_Model_DbTable_Turma();
		$this->view->linha = $turma->findForSelect($id);
		$this->view->row = $turma->hasTurma($id);
		
		$matric = new Application_Model_DbTable_Matricula();
		$this->view->rows = $matric->findForSelect($id);
		
	}
	
	
	public function postPresencaAction(){
		
		$data['Data'] = $_POST['data'];
		$data['Faltas'] = $_POST['faltas'];
		$data['idUsuario_has_Turma'] = $_POST['idMatricula'];
		$data['Turma_idTurma'] = $_POST['idTurma'];
		$idTurma = $_POST['idTurma'];
		 
		$model = new Application_Model_DbTable_Presenca();
		 
		if($this->_request->isPost()){
			if(! empty($data['Faltas']))
				$model->insert($data);
			$this->_redirect("/professor/index/presenca/idTurma/$idTurma");
		}
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
		
	}
	
	
	public function deleteAction(){
		
		$id = $this->_getParam('idPresenca');
		$idTurma = $this->_getParam('idTurma');
			 
		$model = new Application_Model_DbTable_Presenca();
		$model->deletar($id);
		$this->_redirect("/professor/presenca/listar/idTurma/$idTurma");
	}
}