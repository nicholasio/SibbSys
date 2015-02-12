<?php

class Admin_UsuarioController extends AppBaseController{

	
	public function preDispatch(){
	
		parent::preDispatch();
		$auth = Zend_Auth::getInstance();
		if(!$auth->hasIdentity()){
			$this->_redirect('/default');
		}
	}
    
	
	public function indexAction() {
		
		if ($this->_helper->FlashMessenger->hasMessages()) {
			$this->view->messages = $this->_helper->FlashMessenger->getMessages();
		}
		
		$model = new Application_Model_DbTable_Usuario();
    	
    	$this->view->rows = $model->selectPadrao();
    	
    }

    public function novoAction() {
    	
    	if ($this->_helper->FlashMessenger->hasMessages()) {
    		$this->view->messages = $this->_helper->FlashMessenger->getMessages();
    	}
    
        $form = new Application_Form_Usuario();
        $model = new Application_Model_DbTable_Usuario();

        $this->view->form = $form;

         //Cadastrar Usuario
        if($this->_request->isPost()){
            if($form->isValid($this->_request->getPost())){
                $data = $form->getValues();
                $email = $data['Email'];
                $verifica_email = $model->verificaEmail($email);
                if( ! is_null($verifica_email['Email'])){
                	$this->_helper->flashMessenger->addMessage("Cadastro não realizado pois o endereço de Email já está cadastrado no sistema!");
					//$this->_redirect("/admin/usuario/novo");
                }else{
                	$model->insert($data);
                	$this->_helper->flashMessenger->addMessage("Usuário cadastrado com sucesso!");
                	$this->_redirect("/admin/usuario/novo");
                }
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
    			if($id){
    				$where = $model->getAdapter()->quoteInto('idUsuario = ?', $id);
    				$model->update($data, $where);
    				$this->_helper->flashMessenger->addMessage("Dados atualizados com sucesso!");
    				$this->_redirect("/admin/usuario");
    			}	
    		}
    	}
    	$this->view->form = $form; 
    	
    }
    
    public function desativaAction(){
        
        $model = new Application_Model_DbTable_Usuario();    	
    	$id = $this->_getParam('idUsuario');
    	
    	$auth = Zend_Auth::getInstance();
    	$data = $auth->getStorage()->read();
    	
    	if($data->idUsuario == $id){
    		
    		$this->_helper->flashMessenger->addMessage("Você não pode desativar você mesmo!");
    		
    		$this->_redirect("/admin/usuario");
    		
    	} else{
    		
    		$model->deletar($id);
    		
    		$this->_helper->flashMessenger->addMessage("O Usuário foi desativado com sucesso!");
    		
    		$this->_redirect("/admin/usuario");
    	}
    }
    
    public function ativaAction(){
    
    	$model = new Application_Model_DbTable_Usuario();
    	$id = $this->_getParam('idUsuario');
    
   		$model->ativa($id);
    
   		$this->_helper->flashMessenger->addMessage("O Usuário foi ativado com sucesso!");
    
    	$this->_redirect("/admin/usuario");
    	
    }
    
}