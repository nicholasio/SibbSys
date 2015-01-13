<?php

class Professor_IndexController extends AppBaseController{

	
    public function preDispatch(){
	
		parent::preDispatch();
		$auth = Zend_Auth::getInstance();
		if(!$auth->hasIdentity()){
			$this->_redirect('/default');
		}	
    }

    
    public function indexAction(){
    	
    	if ($this->_helper->FlashMessenger->hasMessages()) {
    		$this->view->messages = $this->_helper->FlashMessenger->getMessages();
    	}
    	
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
    			$data['Senha'] = sha1($data['Senha']);
    			$data['ConfirmaSenha'] = sha1($data['ConfirmaSenha']);
    			if($id){
    				$where = $model->getAdapter()->quoteInto('idUsuario = ?', $id);
                    $this->_helper->flashMessenger->addMessage("Senha alterada com sucesso.");
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

        if ($this->_helper->FlashMessenger->hasMessages()) {
            $this->view->messages = $this->_helper->FlashMessenger->getMessages();
        }

    	
    }

	public function encerrarTurmaAction() {
		$turma = new Application_Model_DbTable_Turma();
		$id = $this->_getParam('idTurma');

		if ( $turma->encerrarTurma($id) ) {
			$this->_helper->FlashMessenger->addMessage("Turma encerrada");
		} else {
			$this->_helper->FlashMessenger->addMessage("Turma não pode ser encerrada, existem pendências associadas a essa turma.");
		}

		$this->_redirect("/professor/index/turmas");
	}
}