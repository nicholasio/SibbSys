<?php

class Admin_UsuarioController extends Zend_Controller_Action{

<<<<<<< HEAD
    public function indexAction(){
	
    	//$busca = new Application_Form_Pesquisar();
    	$model = new Application_Model_DbTable_Usuario();
    	//$form = new Application_Form_Usuario();
    	
    	//Buscar
    	if($this->_request->isPost()){
    		if($busca->isValid($this->_request->getPost())){
    			$data = $busca->getValues();
    			$keyword = $data['Usuario'];
    			$this->view->query = $model->buscar($keyword);
    		}
    	}
    	//$this->view->busca = $busca;
    	
    	
    	//Cadastrar Usuario
    	if($this->_request->isPost()){
    		if($form_isValid($this->_request->getPost())){
    			$data = $form->getValues();
    			$model->insert($data);
    			$this->_redirect("/admin/usuario");
    		}
    	}
    	//$this->view->form = $form;
    	
    	//Botão Voltar
    	if($this->getRequest()->getPost('Voltar')){
    		$this->_redirect("/admin");
    	}
=======
    public function indexAction() {
	   $model = new Application_Model_DbTable_Usuario();
>>>>>>> 1b4287bf10c966bfed3564da1b4761a3b7b74120
    	
    	$this->view->rows = $model->listar();
    	
    }

    public function novoAction() {
<<<<<<< HEAD
        
    	$form = new Application_Form_Usuario();
        
=======
        $form = new Application_Form_Usuario();
        $model = new Application_Model_DbTable_Usuario();

>>>>>>> 1b4287bf10c966bfed3564da1b4761a3b7b74120
        $this->view->form = $form;

         //Cadastrar Usuario
        if($this->_request->isPost()){
            if($form->isValid($this->_request->getPost())){
                $data = $form->getValues();
                $model->insert($data);
                $this->_redirect("/admin/usuario");
            }
        }
    }
    
    public function editarAction(){

    	$model = new Application_Model_DbTable_Usuario();
    	$form = new Application_Form_UsuarioEdit();
    	
    	$id = $this->_getParam('idUsuario');
    	
    	$data = $model->editar($id);
    	if(is_array($data)){
    		$form->populate($data);
    	}
    	
    	if($this->_request->isPost()){
    		if($form->isValid($this->_request->getPost())){
    			$data = $form->getValues();
    			//$data['Senha'] = sha1($data['Senha']);
				//$data['ConfirmaSenha'] = sha1($data['ConfirmaSenha']);
    			if($id){
    				$where = $model->getAdapter()->quoteInto('idUsuario = ?', $id);
    				$model->update($data, $where);
    				$this->_redirect("/admin/usuario");
    			}	
    		}
    	}
    	$this->view->form = $form; 
    	
    	if($this->getRequest()->getPost('Voltar')){
    		$this->_redirect("/admin/usuario");
    	}
    }

    public function deleteAction(){
        
        $model = new Application_Model_DbTable_Usuario();
    	
    	$id = $this->_getParam('idUsuario');
    	
    	$model->deletar($id);
    	
    	$this->_redirect("/admin/usuario");
    }
}