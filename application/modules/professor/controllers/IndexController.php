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

        if ($this->_helper->FlashMessenger->hasMessages()) {
            $this->view->messages = $this->_helper->FlashMessenger->getMessages();
        }

    	
    }
    

    public function encerrarTurmaAction(){
		
    	$turma = new Application_Model_DbTable_Turma();
        $matricula = new Application_Model_DbTable_Matricula();
    	$notas = new Application_Model_DbTable_Nota();

    	$id = $this->_getParam('idTurma');

        $alunos = $matricula->findForSelect($id)->toArray();
        $notas  = $notas->findForSelect($id)->toArray();

        $podeEncerrar = true;

        if ( count($alunos) != count($notas) ) {
            $podeEncerrar = false;
        }

        if ( $podeEncerrar ) {
            foreach($notas as $nota) {

                if ( is_null($nota['Unit1']) || is_null($nota['Unit2']) || is_null($nota['Unit3']) ) {
                    $podeEncerrar = false;
                    break;
                }

            }
        }

    	if ( $podeEncerrar ) {
            $turma->encerrarTurma($id);
            $this->_helper->FlashMessenger->addMessage("Turma encerrada");
        } else {
            $this->_helper->FlashMessenger->addMessage("Turma não pode ser encerrada, falta adicionar notas.");
        }
    	
        $this->_redirect("/professor/index/turmas");
    	
    	
    }
}