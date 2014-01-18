<?php

class Admin_DebitosController extends Zend_Controller_Action{
	
	
	public function indexAction(){

		$model = new Application_Model_DbTable_Debitos();
		$form = new Application_Form_Debitos();

		if($this->_request->isPost()){
			if($form->isValid($this->_request->getPost())){
				$data = $form->getValues();
				$model->insert($data);
				$this->_redirect("/admin/faturas");
			}
		}
		
		$this->view->form = $form;
		
		$this->view->rows = $model->listar();
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