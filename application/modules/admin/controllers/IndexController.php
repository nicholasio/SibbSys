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

	    $date = new DateTime($anoAtual . '-' . $mesAtual . '-' . $diaAtual);
	    $ultimo_dia_mes = $date->format('t');

	    $configs = new Application_Model_DbTable_Configs();

	    $dia_fatura  = (int) $configs->findKey('dia_fatura');

	    $this->processarDebitos( $mesAtual, $anoAtual );

        if ( $diaAtual >= ($ultimo_dia_mes - $dia_fatura) ) {
	        $this->gerarFaturas();
        }

    }

    public function gerarFaturas() {
		$debitos_model = new Application_Model_DbTable_Debitos();
	    $faturas_model = new Application_Model_DbTable_Faturas();

	    $debitos_nao_faturados = $debitos_model->listar();

	    /**
	     * Agrupando Débitos por Usuário
	     */
	    $debitos_id_by_user = array();
	    foreach($debitos_nao_faturados as $debito) {
			$debitos_id_by_user[$debito['user']['idUsuario']][] = $debito['idDebitos'];
	    }

	    /**
	     * Gerando Faturas pelos débitos pendentes de cada usuário
	     */
	    foreach($debitos_id_by_user as $user_id => $debitos_id) {
			$faturas_model->gerarFatura($debitos_id, $user_id);
	    }
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