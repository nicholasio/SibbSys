<?php 

class Admin_ServicosController extends Zend_Controller_Action{

	
	public function preDispatch(){
	
		parent::preDispatch();
		$auth = Zend_Auth::getInstance();
		if(!$auth->hasIdentity()){
			$this->_redirect('/default');
		}
	}
	
	
	public function indexAction(){

		$model = new Application_Model_DbTable_Servicos();
		
		$this->view->rows = $model->listar();
	}
	
	
	public function novoAction(){
		
		$model = new Application_Model_DbTable_Servicos();
		$form = new Application_Form_Servicos();
		
		
		if($this->_request->isPost()){
			if($form->isValid($this->_request->getPost())){
				$data = $form->getValues();
				$model->insert($data);
				$this->_redirect("/admin/servicos/novo");
			}
		}
		
		$this->view->form = $form;
		
	}
	
	
	public function editarAction(){
		
		$model = new Application_Model_DbTable_Servicos();
		$form = new Application_Form_Servicos();
		
		$id = $this->_getParam('idServicos');
		
		$data = $model->editar($id);
		if(is_array($data)){
			$form->populate($data);
		}
		
		if($this->_request->isPost()){
			if($form->isValid($this->_request->getPost())){
				$data = $form->getValues();
				if($id){
					$where = $model->getAdapter()->quoteInto('idServicos = ?', $id);
					$model->update($data, $where);
					$this->_redirect("/admin/servicos");
				}
			}
		}
		$this->view->form = $form;
	}
	
	
	public function deleteAction(){
		
		$model = new Application_Model_DbTable_Servicos();
		
		$id = $this->_getParam('idServicos');
		
		$model->deletar($id);
		
		$this->_redirect("/admin/servicos");
	}
	
}