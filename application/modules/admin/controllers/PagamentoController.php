<?php 

class Admin_PagamentoController extends Zend_Controller_Action{
	
	public function indexAction(){
		
		$model = new Application_Model_DbTable_Pagamento();
		$form = new Application_Form_Pagamento();
		
		if($this->_request->isPost()){
			if($form->isValid($this->_request->getPost())){
				$data = $form->getValues();
				$model->insert($data);
				$this->_redirect("/admin/pagamento");
			}
		}
		$this->view->form = $form;
		
		$this->view->rows = $model->listar();
	}
	
	
	public function editarAction(){
		
		$model = new Application_Model_DbTable_Pagamento();
		$form = new Application_Form_Pagamento();
		
		$id = $this->_getParam('idPagamento');
		
		$data = $model->editar($id);
		if(is_array($data)){
			$form->populate($data);
		}
		
		if($this->_request->isPost()){
			if($form->isValid($this->_request->getPost())){
				$data = $form->getValues();
				if($id){
					$where = $model->getAdapter()->quoteInto('idPagamento = ?', $id);
					$model->update($data, $where);
					$this->_redirect("/admin/pagamento");
				}
			}
		}
		$this->view->form = $form;
	}
	
	public function deleteAction(){
		
		$model = new Application_Model_DbTable_Pagamento();
		
		$id = $this->_getParam('idPagamento');
		
		$model->deletar($id);
		
		$this->_redirect("/admin/pagamento");
	}
	
}