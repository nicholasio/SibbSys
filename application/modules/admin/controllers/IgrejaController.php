<?php

class Admin_IgrejaController extends Zend_Controller_Action
{

    public function indexAction()
    {
    	
    	$model = new Application_Model_DbTable_Igreja();
        $form = new Application_Form_Igreja();
        $busca = new Application_Form_Pesquisar();
        
        
        /*if($this->_request->isPost()){
        	if($busca->isValid($this->_request->getPost())){
        		$data = $busca->getValues();
        		$keyword = $data['Usuario'];
        		$this->view->query = $model->buscar($keyword);
        	}
        }
        $this->view->busca = $busca;*/
        
       	
    	/*if($this->getRequest()->getPost('Voltar')){
    		
    		$this->_redirect("/admin");
    	}*/
       	
		$this->view->rows = $model->listar();
    }

    public function novoAction() {
        $model = new Application_Model_DbTable_Igreja();
        $form = new Application_Form_Igreja();
        $busca = new Application_Form_Pesquisar();

        if($this->_request->isPost()){
            if($form->isValid($this->_request->getPost())){
                    $data = $form->getValues();
                    $model->insert($data);
                    $this->_redirect("/admin/igreja");
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

    
    public function deleteAction(){
        
    	$model = new Application_Model_DbTable_Igreja();

        $id = $this->_getParam('idIgreja');
        
        $model->deletar($id);
        	
        $this->_redirect("/admin/igreja");
    }
}