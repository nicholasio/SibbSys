<?php

class Admin_DebitosController extends Zend_Controller_Action{
	
	
	public function preDispatch(){
	
		parent::preDispatch();
		$auth = Zend_Auth::getInstance();
		if(!$auth->hasIdentity()){
			$this->_redirect('/default');
		}
	}
	
	
	public function indexAction(){

		$model = new Application_Model_DbTable_Debitos();
		$usuarios = new Application_Model_DbTable_Usuario();

		$user_id = null;
		if ( isset($_GET['aluno']) ) {
			$user_id = $_GET['aluno'];
			$this->view->user_id = $user_id;
		}

		if ( $user_id == -1 ) $user_id = null;


		$this->view->rows = $model->listar(null,null,$user_id);
		$this->view->users = $usuarios->listar();
	}
	
	
	public function novoAction(){
		
		$model = new Application_Model_DbTable_Debitos();
		$form = new Application_Form_Debitos();
		
		if($this->_request->isPost()){
			if($form->isValid($this->_request->getPost())){
				$data = $form->getValues();
				$model->insert($data);
				$this->_redirect("/admin/debitos");
			}
		}
		
		$this->view->form = $form;
	}
	
	
	public function editarAction(){
		
		$model = new Application_Model_DbTable_Debitos();
		$form = new Application_Form_Debitos();
		
		$id = $this->_getParam('idDebitos');
		
		$data = $model->editar($id);
		if(is_array($data)){
			$form->populate($data);
		}
		
		if($this->_request->isPost()){
			if($form->isValid($this->_request->getPost())){
				$data = $form->getValues();
				if($id){
					$where = $model->getAdapter()->quoteInto('idDebitos = ?', $id);
					$model->update($data, $where);
					$this->_redirect("/admin/debitos");
				}
			}
		}
		$this->view->form = $form;
	}
	
	
	public function deleteAction(){
		
		$model = new Application_Model_DbTable_Debitos();
		
		$id = $this->_getParam('idDebitos');
		
		$model->deletar($id);
		
		$this->_redirect("/admin/debitos");
	}
}