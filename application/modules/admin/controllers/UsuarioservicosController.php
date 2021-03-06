<?php

class Admin_UsuarioServicosController extends AppBaseController{
	
	
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

				if ( empty($data['valor']) ) unset($data['valor']);

				$data['Usuario_idUsuario'] = $id;
				$model->insert($data);
				//$this->_redirect("/admin/usuarioservicos");
			}
		}
		$this->view->row = $user->editar($id);	
		
		$this->view->form = $form;
		
		$this->view->rows = $model->listar($id);
		
	}
	
	
	public function deleteAction(){
		
		$model = new Application_Model_DbTable_Usuarioservicos(); 
		$id = $this->_getParam('idUsuario_has_Servicos');
		$userId = $this->_getParam('idUsuario');
		$this->view->userId = $userId;
		
		$resultado = $model->deletar($id);	
		
		if($resultado != 'igual'){
			$this->_redirect("/admin/usuarioservicos/index/idUsuario/" . $userId);
			
		}
	}
}