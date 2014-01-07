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
	}
}