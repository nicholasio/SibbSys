<?php

class Admin_IndexController extends Zend_Controller_Action{

	
	public function preDispatch(){
	
		parent::preDispatch();
		
		$auth = Zend_Auth::getInstance();

		if(!$auth->hasIdentity()){
			$this->_redirect('/default');	
		}
	}
	
	
    public function indexAction(){

        if ($this->_helper->FlashMessenger->hasMessages()) {
            $this->view->messages = $this->_helper->FlashMessenger->getMessages();
        }

    	$this->tarefasAgendadas();
  
    }

    public function tarefasAgendadas() {
        $mesAtual       = (int) date('n');
        $diaAtual       = (int) date('j');
        $anoAtual       = (int) date('Y');


        //Os Débitos são processados a partir do dia 18 até o dia 28
        if ( $diaAtual < 28) {
            $this->processarDebitos( $mesAtual, $anoAtual );
        } else if ( $diaAtual >= 28 ) {
            $this->gerarFaturas( $diaAtual, $mesAtual, $anoAtual );
        }

    }

    public function gerarFaturas( $diaAtual, $mesAtual, $anoAtual ) {

    }

    /**
     * Invoca o método processarDebitos do DbTable Debitos.
     * @param $mesAtual
     * @param $anoAtual
     */
    public function processarDebitos( $mesAtual, $anoAtual ) {
        $debitos = new Application_Model_DbTable_Debitos();

        $debitos->processarDebitos($mesAtual, $anoAtual);
    }
    
    
    public function boletimAction(){
    
    	$auth = Zend_Auth::getInstance();
    	$data = $auth->getStorage()->read();
    	
    	$id = $data->idUsuario;
    	
    	$model = new Application_Model_DbTable_Matricula();
    	
    	$this->view->rows = $model->turmas($id);
    	$this->view->row = $model->getTurma($id);
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
    			$data['Senha'] = sha1($data['Senha']);
    			$data['ConfirmaSenha'] = sha1($data['ConfirmaSenha']);
    			if($id){
    				$where = $model->getAdapter()->quoteInto('idUsuario = ?', $id);
                    $this->_helper->flashMessenger->addMessage("Senha alterada com sucesso.");
    				$model->update($data, $where);
    				$this->_redirect("/admin");	
    			}
    		}
    	}
    	$this->view->form = $form;
    }
}