<?php

class Admin_TurmaController extends Zend_Controller_Action
{

    public function indexAction(){
    
    	$model = new Application_Model_DbTable_Turma();
    	$form = new Application_Form_Turma();
    	$busca = new Application_Form_Pesquisar();
    	
    	
    	if($this->_request->isPost()){
    		if($busca->isValid($this->_request->getPost())){
    			$data = $busca->getValues();
    			$keyword = $data['Usuario'];
    			$this->view->query = $model->buscar($keyword);
    		}
    	}
    	$this->view->busca = $busca;
    	
    	
    	if($this->_request->isPost()){
    		if($form->isValid($this->_request->getPost())){
    			$data = $form->getValues();
    			$model->insert($data);
    			$this->_redirect('/admin/turma');
    		}
    	}
    	$this->view->form = $form;
    	

    	if($this->getRequest()->getPost('Voltar')){
    		$this->_redirect("/admin");
    	}
    	
    	$this->view->rows = $model->listar();	
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