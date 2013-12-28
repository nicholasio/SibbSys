<?php

class Professor_MinhasTurmasController extends Zend_Controller_Action{

    public function init(){
        /* Initialize action controller here */
    }

    public function indexAction(){

    	
    }
    
    public function historicoAction(){
    
    	$auth = Zend_Auth::getInstance();
    	$dados = $auth->getStorage()->read();
    	
    	$id = $dados->idUsuario;
    	
    	$model = new Application_Model_DbTable_Matricula();
    	$this->view->rows = $model->turmas($id);
    }
    
    public function turmaAction(){
    
    	$auth = Zend_Auth::getInstance();
    	$data = $auth->getStorage()->read();
    	
    	$id = $data->idUsuario;
    	
    	$model = new Application_Model_DbTable_Matricula();
    	$this->view->rows = $model->turmas($id);
    }
    
    
    public function materialAction(){
    
    	$id = $this->_getParam('idDisciplina');
    	
    	$model = new Application_Model_DbTable_Arquivos();
    	$this->view->rows = $model->download($id);
    	
    	
    	$this->view->row = $model->seleciona($id);
    	
    }
    
    public function boletimAction(){
    
    	$auth = Zend_Auth::getInstance();
    	$data = $auth->getStorage()->read();
    	$this->view->data = $data;
    	
    	$id = $data->idUsuario;
    	
    	$model = new Application_Model_DbTable_Matricula();
    	$this->view->rows = $model->turmas($id);
    	$this->view->row = $model->getTurma($id);
    }


}

