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
	}
}