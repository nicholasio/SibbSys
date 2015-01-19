<?php

class Admin_IgrejaController extends AppBaseController{

	
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
    	
    	
    	$model = new Application_Model_DbTable_Igreja();
       	
		$this->view->rows = $model->findForSelect();
    }

    
    public function novoAction() {
    	
        $model = new Application_Model_DbTable_Igreja();
        $form = new Application_Form_Igreja();

        if($this->_request->isPost()){
            if($form->isValid($this->_request->getPost())){
                    $data = $form->getValues();
                    $model->insert($data);
                    $this->_redirect("/admin/igreja/novo");
            }
        }
        $this->view->form = $form;

    }

    
    public function editarAction(){
    	
    	$model = new Application_Model_DbTable_Igreja();
        $form = new Application_Form_Igreja();
    	
        $id = $this->_getParam('idIgreja');
		
    	$data = $model->editar($id);
        if(is_array($data)){
        	$form->populate($data);
        }
        
        if($this->_request->isPost()){
        	if($form->isValid($this->_request->getPost())){
        		$data = $form->getValues();
        		if($id){
        			$where = $model->getAdapter()->quoteInto('idIgreja = ?', $id);
        			$model->update($data, $where);
        			$this->_redirect("/admin/igreja");
        		}
        	}
        }
        $this->view->form = $form;
    }

    
    public function detalhesAction(){
    	
    	$model = new Application_Model_DbTable_Igreja();
    	
    	$id = $this->_getParam('idIgreja');
    	
    	$this->view->row = $model->editar($id);
    }
    
    
    public function desativaAction(){
        
    	$model = new Application_Model_DbTable_Igreja();

        $id = $this->_getParam('idIgreja');
        
        $model->deletar($id);
        
        $this->_helper->flashMessenger->addMessage("A Igreja foi desativada com sucesso!");
        	
        $this->_redirect("/admin/igreja");
    }
    
    
    public function ativaAction(){
    	
    	$model = new Application_Model_DbTable_Igreja();
    	
    	$id = $this->_getParam('idIgreja');
    	
    	$igreja = $model->ativar($id);
    	
    	$this->_helper->flashMessenger->addMessage("A Igreja foi ativada com sucesso!");
    	
    	$this->_redirect("/admin/igreja");
    }
}