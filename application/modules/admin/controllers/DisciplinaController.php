<?php

class Admin_DisciplinaController extends Zend_Controller_Action
{

    public function indexAction()
    {
        $model = new Application_Model_DbTable_Disciplina();
        $form = new Application_Form_Disciplina();
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
        		$this->_redirect("/admin/disciplina");
        	}
        }
        $this->view->form = $form;
        
    	if($this->getRequest()->getPost('Voltar')){
    		$this->_redirect("/admin");
    	}
    	
    	$this->view->rows = $model->listar();
    }

    
    public function editarAction(){
    	
        $model = new Application_Model_DbTable_Disciplina();
        $form = new Application_Form_Disciplina();
        
        $id = $this->_getParam('idDisciplina');
        
        $data = $model->editar($id);
        
        if(is_array($data)){
        	$form->populate($data);
        }
        
        if($this->_request->isPost()){
        	if($form->isValid($this->_request->getPost())){
        		$data = $form->getValues();
        		if($id){
        			$where = $model->getAdapter()->quoteInto('idDisciplina = ?', $id);
        			$model->update($data, $where);
        			$this->_redirect("/admin/disciplina");
        		}
        	}
        }
        $this->view->form = $form;
    }

    
    public function deleteAction(){
    	
        $model = new Application_Model_DbTable_Disciplina();
        
        $id = $this->_getParam('idDisciplina');
        
        $model->deletar($id);
        
        $this->_redirect("/admin/disciplina");
    }
    
}