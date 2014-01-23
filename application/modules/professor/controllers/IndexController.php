<?php

class Professor_IndexController extends Zend_Controller_Action{

	
    public function preDispatch(){
	
		parent::preDispatch();
		$auth = Zend_Auth::getInstance();
		if(!$auth->hasIdentity()){
			$this->_redirect('/default');
		}	
    }

    
    public function indexAction(){
    	
    	
    }
    

    public function alteraSenhaAction(){

    	$auth = Zend_Auth::getInstance();
    	$dados = $auth->getStorage()->read();
    	
    	$id = $dados->idUsuario;
    	
    	$form = new Application_Form_AlteraSenha();
    	$model = new Application_Model_DbTable_Usuario();
    	
    	if($this->_request->isPost()){
    		if($form->isValid($this->_request->getPost())){
    			$data = $form->getValues();
    			if($id){
    				$where = $model->getAdapter()->quoteInto('idUsuario = ?', $id);
    				$model->update($data, $where);
    				$this->_redirect("/professor");
    			}
    		}
    	}
    	
    	$this->view->form = $form;
    }

    
    public function turmasAction(){
        
    	$auth = Zend_Auth::getInstance();
    	$data = $auth->getStorage()->read();
    	$this->view->data = $data;
    	
    	$id = $data->idUsuario;
    	
    	$model = new Application_Model_DbTable_Turma();
    	$this->view->rows = $model->turmas($id);
    	$this->view->row = $model->getTurma($id);
    	
    }
    

    public function encerrarTurmaAction(){
		
    	$model = new Application_Model_DbTable_Turma();
    	
    	$id = $this->_getParam('idTurma');
    	
    	$model->encerrarTurma($id);
    	
    	$this->_redirect("/professor/index/turmas");
    	
    }
}