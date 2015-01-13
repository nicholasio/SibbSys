<?php

class Admin_CreditoController extends AppBaseController{
	
	
	public function preDispatch(){
	
		parent::preDispatch();
		$auth = Zend_Auth::getInstance();
		if(!$auth->hasIdentity()){
			$this->_redirect('/default');
		}
	}
	
	
	public function indexAction(){
		
		$model = new Application_Model_DbTable_Credito();
		$form = new Application_Form_AlterarCredito();
		
		
		$getid = $model->listar();
		
		$id = $getid['idCredito'];
		
		
		if($this->_request->isPost()){
			if($form->isValid($this->_request->getPost())){
				$data = $form->getValues();
				$data['idCredito'] = $id;
				if($id){
					$where = $model->getAdapter()->quoteInto('idCredito = ?', $id);
					$model->update($data, $where);
					$this->_redirect("/admin/credito/");
				}
				else{
					$model->insert($data);
					$this->_redirect("/admin/credito/");
				}
			}
		}
		$this->view->form = $form;
		$this->view->row = $model->listar();
	}
	
	
}