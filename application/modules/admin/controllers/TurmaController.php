<?php

class Admin_TurmaController extends AppBaseController{

	
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
    
    	$model = new Application_Model_DbTable_Turma();
    	$model_matricula = new Application_Model_DbTable_Matricula();
   
    	
    	$this->view->rows = $model->listar();	
    	
    }

    public function novoAction() {
    	
    	if ($this->_helper->FlashMessenger->hasMessages()) {
    		$this->view->messages = $this->_helper->FlashMessenger->getMessages();
    	}
    	
    	$model = new Application_Model_DbTable_Turma();
        $DiscTable = new Application_Model_DbTable_Disciplina();
        $form = new Application_Form_Turma();
    
        if($this->_request->isPost()){
            if($form->isValid($this->_request->getPost())){
                $data = $form->getValues();
                $model->insert($data);
                $this->_helper->flashMessenger->addMessage("Turma cadastrada com sucesso!");
                $this->_redirect('/admin/turma/novo');
            }
        }
        $this->view->form = $form;
        
    }
    
    
    public function editarAction(){

    	$model = new Application_Model_DbTable_Turma();
    	$form = new Application_Form_Turma();
    	
    	$id = $this->_getParam('idTurma');
    	
    	$data = $model->editar($id);
    	if(is_array($data)){
    		$form->populate($data);
    	}
    	
    	if($this->_request->isPost()){
    		if($form->isValid($this->_request->getPost())){
    			$data = $form->getValues();
    			if($id){
    				$where = $model->getAdapter()->quoteInto('idTurma = ?', $id);
    				$model->update($data, $where);
    				$this->_helper->flashMessenger->addMessage("Dados atualizados com sucesso!");
    				$this->_redirect('/admin/turma');
    			}
    		}
    	}
    	$this->view->form = $form;
    }

    public function ativarAction(){
        	
    	$model = new Application_Model_DbTable_Turma();
    	
    	$id = $this->_getParam('idTurma');
    	
    	$turma_ativada = $model->ativar($id);
    	
    	$this->_helper->FlashMessenger->addMessage(" Turma ativada com sucesso! ");
    	
    	$this->_redirect('/admin/turma');
    	
    }
    
}