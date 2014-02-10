<?php

class Admin_TurmaController extends Zend_Controller_Action{

	
	public function preDispatch(){
	
		parent::preDispatch();
		$auth = Zend_Auth::getInstance();
		if(!$auth->hasIdentity()){
			$this->_redirect('/default');
		}
	}
	
	
    public function indexAction(){
    
    	$model = new Application_Model_DbTable_Turma();
    	
    	$this->view->rows = $model->listar();	
    	
    }

    public function novoAction() {
    	
        $model = new Application_Model_DbTable_Turma();
        $DiscTable = new Application_Model_DbTable_Disciplina();
        $form = new Application_Form_Turma();
    
        if($this->_request->isPost()){
            if($form->isValid($this->_request->getPost())){
                $data = $form->getValues();
                $model->insert($data);
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
    				$this->_redirect('/admin/turma');
    			}
    		}
    	}
    	$this->view->form = $form;
    }

    public function deleteAction(){
        	
    	$model = new Application_Model_DbTable_Turma();
    	
    	$id = $this->_getParam('idTurma');
    	
    	$model->deletar($id);
    	
    	$this->_redirect('/admin/turma');
    	
    }
    
}