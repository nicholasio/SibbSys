<?php

class Admin_DisciplinaController extends Zend_Controller_Action
{

    public function indexAction()
    {
        $model = new Application_Model_DbTable_Disciplina();

    	$this->view->rows = $model->listar();
    }

    public function novoAction() {
        $model = new Application_Model_DbTable_Disciplina();
        $form = new Application_Form_Disciplina();

        if($this->_request->isPost()){
            if($form->isValid($this->_request->getPost())){
                $data = $form->getValues();
                $model->insert($data);
                $this->_redirect("/admin/disciplina");
            }
        }

        $this->view->form = $form;
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