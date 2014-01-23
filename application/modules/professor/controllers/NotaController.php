<?php

class Professor_NotaController extends Zend_Controller_Action{
	
	
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
		 
		$matric = new Application_Model_DbTable_Matricula();
			$this->view->rows = $matric->findForSelect($id);
		 
		$user = new Application_Model_DbTable_Usuario();
		$turma = new Application_Model_DbTable_Turma();
		 
		$this->view->linha = $turma->findForSelect($id);
		$this->view->row = $turma->hasTurma($id);
		
	}
	
	
	public function postNotaAction(){
		
		$data['Nota'] = $_POST['nota'];
		$data['Unidade'] = $_POST['unidade'];
		$data['idUsuario_has_Turma'] = $_POST['idMatricula'];
		$data['Turma_idTurma'] = $_POST['idTurma'];
		$idTurma = $_POST['idTurma'];
		
		$model = new Application_Model_DbTable_Nota();
		 
		
		if($this->_request->isPost()){
			if(! empty($data['Nota']))
		
				$model->insert($data);
			$this->_redirect("/professor/index/nota/idTurma/$idTurma");
		}
	}
	
	
	public function listarAction(){
		
		$id = $this->_getParam('idTurma');
			
		$matric = new Application_Model_DbTable_Matricula();
		$this->view->rows = $matric->findForSelect($id);
			
		$model = new Application_Model_DbTable_Nota();
		$this->view->result = $model->findForSelect($id);
			
		$user = new Application_Model_DbTable_Usuario();
		$turma = new Application_Model_DbTable_Turma();
			
		$this->view->linha = $turma->findForSelect($id);
		$this->view->row = $turma->hasTurma($id);
		
	}
	
	
	public function deleteAction(){
		
		$id = $this->_getParam('idNota');
		$idTurma = $this->_getParam('idTurma');
		
		$model = new Application_Model_DbTable_Nota();
		$model->deletar($id);
		$this->_redirect("/professor/nota/listar/idTurma/$idTurma");
		
	}
}