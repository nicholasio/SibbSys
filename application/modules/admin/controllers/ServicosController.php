<?php 

class Admin_ServicosController extends Zend_Controller_Action{

	
	public function indexAction(){

		$model = new Application_Model_DbTable_Servicos();
		$form = new Application_Form_Servicos();
		
		
		if($this->_request->isPost()){
			if($form->isValid($this->_request->getPost())){
				$data = $form->getValues();
				$model->insert($data);
				$this->_redirect("/admin/servicos");
			}
		}
		
		$this->view->form = $form;
	}
	
}