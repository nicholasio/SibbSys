<?php

class Admin_UsuarioServicosController extends Zend_Controller_Action{
	
	
	public function preDispatch(){
	
		parent::preDispatch();
		$auth = Zend_Auth::getInstance();
		if(!$auth->hasIdentity()){
			$this->_redirect('/default');
		}
	}
	
	
	public function indexAction(){
		
		$model = new Application_Model_DbTable_Usuarioservicos();
		$form = new Application_Form_UsuarioServico();
		$user = new Application_Model_DbTable_Usuario();
		
		$id = $this->_getParam('idUsuario');
		
		if($this->_request->isPost()){
			if($form->isValid($this->_request->getPost())){
				$data = $form->getValues();
				$data['Usuario_idUsuario'] = $id;
				$model->insert($data);
				$this->_redirect("/admin/usuarioservicos");
			}
		}
		$this->view->row = $user->editar($id);
		
		$this->view->form = $form;
		
		$this->view->rows = $model->listar($id);
	}
	
	
	public function deleteAction(){
		
		$model = new Application_Model_DbTable_Usuarioservicos(); 
		$id = $this->_getParam('Servicos_idServicos');
		
		$model->deletar($id);
		
		$this->_redirect("/admin/usuarioservicos");
		
	}
}