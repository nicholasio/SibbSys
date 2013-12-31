<?php

class Admin_HistoricoController extends Zend_Controller_Action{

    public function indexAction(){
    	
        
    	//$id = $this->_getParam('idUsuario');
    	
    	$model = new Application_Model_DbTable_Matricula();
    	
    	
    	//$result = $model->lista();
    	
    	//print_r($result); die;
    	
    	$this->view->rows = $model->lista();
    	
    	
    }

    public function usuarioAction(){
        
    	$id = $this->_getParam('idUsuario');
    	
    	$model = new Application_Model_DbTable_Matricula();
    	
    	$this->view->rows = $model->turmas($id);
    	
    	
    }
}
