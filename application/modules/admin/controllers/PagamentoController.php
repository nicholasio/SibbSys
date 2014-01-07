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
	}
	
}