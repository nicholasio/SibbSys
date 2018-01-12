<?php

class Admin_HistoricoController extends AppBaseController{

	
	public function preDispatch(){
	
		parent::preDispatch();
		$auth = Zend_Auth::getInstance();
		if(!$auth->hasIdentity()){
			$this->_redirect('/default');
		}
	}
    
	
	public function indexAction(){
    	
    	$model = new Application_Model_DbTable_Matricula();
    	
    	$this->view->rows = $model->lista();
    	
    	
    }

    public function usuarioAction(){
        
    	$id = $this->_getParam('idUsuario');
    	
    	$model = new Application_Model_DbTable_Matricula();
    	
    	$this->view->rows = $model->turmas_turmas($id);
    	$this->view->row = $model->getTurma($id);
    }
    
    
    public function historicoBaixarAction(){
    
    	$id = $this->_getParam('idUsuario');
    	 
    	$model = new Application_Model_DbTable_Matricula();
    	 
    	$this->view->rows = $model->turmas_turmas($id);
    	$this->view->row = $model->getTurma($id);
    	
    }
}