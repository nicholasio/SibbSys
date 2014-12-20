<?php

class Professor_IndexController extends Zend_Controller_Action{

	
    public function preDispatch(){
	
		parent::preDispatch();
		$auth = Zend_Auth::getInstance();
		if(!$auth->hasIdentity()){
			$this->_redirect('/default');
		}	
    }

    
    public function indexAction(){
    	
    	
    }
    

    public function alteraSenhaAction(){

    	$auth = Zend_Auth::getInstance();
    	$dados = $auth->getStorage()->read();
    	
    	$id = $dados->idUsuario;
    	
    	$form = new Application_Form_AlteraSenha();
    	$model = new Application_Model_DbTable_Usuario();
    	
    	if($this->_request->isPost()){
    		if($form->isValid($this->_request->getPost())){
    			$data = $form->getValues();
    			if($id){
    				$where = $model->getAdapter()->quoteInto('idUsuario = ?', $id);
    				$model->update($data, $where);
    				$this->_redirect("/professor");
    			}
    		}
    	}
    	
    	$this->view->form = $form;
    }

    
    public function turmasAction(){
        
    	$auth = Zend_Auth::getInstance();
    	$data = $auth->getStorage()->read();
    	$this->view->data = $data;
    	
    	$id = $data->idUsuario;
    	
    	$model = new Application_Model_DbTable_Turma();
    	$this->view->rows = $model->turmas($id);
    	$this->view->row = $model->getTurma($id);
    	
    }
    

    public function encerrarTurmaAction(){
		
    	$model = new Application_Model_DbTable_Turma();
    	$nota = new Application_Model_DbTable_Nota();
    	
    	$id = $this->_getParam('idTurma');
    	
    	$result = $nota->temNota($id);
    		if($result['Unit1'] == ""){
    			echo 'Turma não pode ser fechada, pois ainda falta algumas notas de aluno';
    		}
    		if($result['Unit2'] == ""){
    			echo 'Turma não pode ser fechada, pois ainda falta algumas notas de aluno';
    		}
    		if($result['Unit3'] == ""){
    			echo 'Turma não pode ser fechada, pois ainda falta algumas notas de aluno';
    		}
    		else{
    			echo 'nada';
    		}
    	
    		
    		
    		die;
    	/*
    	foreach ($result as $rows){
    		if($rows->Unit1 == ""){
    			alert('Turma não pode ser fechada, pois ainda falta algumas notas de aluno');
    		}
    		if($rows->Unit2 == ""){
    			alert('Turma não pode ser fechada, pois ainda falta algumas notas de aluno');
    		}
    		if($rows->Unit3 == ""){
    			alert('Turma não pode ser fechada, pois ainda falta algumas notas de aluno');
    		}
    		else{
    			echo 'nada';
    		}
    		*/
    		
    		
    		
    		//echo 'Unit1 ' . $rows->Unit1 . '/';
    		//echo 'Unit2 ' . $rows->Unit2 . '/';
    		//echo 'Unit3 ' . $rows->Unit3 . '/';
    	/*
    	foreach($result as $r){
    		echo ' Unit1 ' . $r->Unit1;
    		echo ' Unit2 ' . $r->Unit2;
    		echo ' Unit3 ' . $r->Unit3 . '/';
    	}
    	*/
    	
    	//print_r($result);
    	
    	if($result == null){
    		alert('Turma não pode ser fechada, pois ainda falta algumas notas de aluno');
    	}
    	else{
    		die;
    		$model->encerrarTurma($id);
    	
    		$this->_redirect("/professor/index/turmas");
    	}
    	
    
    	
    }
}