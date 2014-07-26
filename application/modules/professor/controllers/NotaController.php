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
			
		$user = new Application_Model_DbTable_Usuario();
		$turma = new Application_Model_DbTable_Turma();
		$model = new Application_Model_DbTable_Nota();
		$matric = new Application_Model_DbTable_Matricula();
		
		$this->view->nota = $model->findForSelect($id);
		$this->view->rows = $matric->findForSelect($id);
		$this->view->linha = $turma->findForSelect($id);
		$this->view->row = $turma->hasTurma($id);
		
	}
	
	
	public function postNotaAction(){
		
		$data['Unit1'] = $_POST['unit1'];
		$data['Unit2'] = $_POST['unit2'];
		$data['Unit3'] = $_POST['unit3'];
		$data['idUsuario_has_Turma'] = $_POST['idMatricula'];
		$data['Turma_idTurma'] = $_POST['idTurma'];
		$id = $_POST['idNota'];
		$idTurma = $_POST['idTurma'];
		
		$model = new Application_Model_DbTable_Nota();
		
		if($this->_request->isPost()){
			if(! empty($data['Unit1'])){
				if($id){
					$where = $model->getAdapter()->quoteInto('idNota = ?', $id);
					$model->update($data, $where);
					$this->_redirect("/professor/nota/index/idTurma/$idTurma");
				}
				else{
					$model->insert($data);
					$this->_redirect("/professor/nota/index/idTurma/$idTurma");
				}
			}
			else{
				$this->_redirect("/professor/nota/index/idTurma/$idTurma");
			}
		}
	}
	
	
	public function listarAction(){
		
		$id = $this->_getParam('idTurma');
			
		$model = new Application_Model_DbTable_Nota();
		$turma = new Application_Model_DbTable_Turma();
		
		$this->view->result = $model->findForSelect($id);
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