<?php 

class Admin_FaturasController extends Zend_Controller_Action{
	
	
	public function indexAction(){
		
		$model = new Application_Model_DbTable_Faturas();
		$form = new Application_Form_Faturas();
		
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
	
	
	public function editarAction($id){
		
		$model = new Application_Model_DbTable_Faturas();
		$form = new Application_Form_Faturas();
		
		$id = $this->_getParam('idFatura');
		
		$data = $model->editar($id);
		if(is_array($data)){
			$form->populate($data);
		}
		
		if($this->_request->_isPost()){
			if($form->isValid($this->_request->getPost())){
				$data = $form->getValues();
				if($id){
					$where = $model->getAdapter()->quoteInto('idFatura = ?', $id);
					$model->update($data, $where);
					$this->_redirect("/admin/fatura");
				}
			}
		}
		$this->view->form = $form;
	}
	
	
	public function deleteAction($id){
		
		$model = new Application_Model_DbTable_Fatura();
		
		$id = $this->_getParam('idFatura');
		
		$model->deletar($id);
		
		$this->_redirect("/admin/fatura");
	}
}