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
		
		$model = new Application_Model_DbTable_Usuario();
    	
    	$this->view->rows = $model->listar();
    	
    }

    public function novoAction() {
    
        $form = new Application_Form_Usuario();
        $model = new Application_Model_DbTable_Usuario();

        $this->view->form = $form;

         //Cadastrar Usuario
        if($this->_request->isPost()){
            if($form->isValid($this->_request->getPost())){
                $data = $form->getValues();
                $model->insert($data);
                $this->_redirect("/admin/usuario/novo");
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
    				$this->_redirect("/admin/usuario");
    			}	
    		}
    	}
    	$this->view->form = $form; 
    	
    	if($this->getRequest()->getPost('Voltar')){
    		$this->_redirect("/admin/usuario");
    	}
    }

    
    public function detalhesAction(){
    	
    	$model = new Application_Model_DbTable_Usuario();
    	$id = $this->_getParam('idUsuario');
    	
    	$this->view->rows = $model->getUser($id);
    }
    
    
    public function deleteAction(){
        
        $model = new Application_Model_DbTable_Usuario();    	
    	$id = $this->_getParam('idUsuario');
    	
    	$auth = Zend_Auth::getInstance();
    	$data = $auth->getStorage()->read();
    	
    	if($data->idUsuario == $id){
    		
    		$this->_redirect("/admin/usuario");
    		
    	} else{
    		
    		$model->deletar($id);
    		 
    		$this->_redirect("/admin/usuario");
    	}
    }
}