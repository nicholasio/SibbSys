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
    	
    	$this->tarefasAgendadas();
  
    }

    public function tarefasAgendadas() {
        $mesAtual       = (int) date('n');
        $diaAtual       = (int) date('j');
        $anoAtual       = (int) date('Y');


        if ( $diaAtual >= 18 && $diaAtual < 28) {
            $this->processarDebitos( $diaAtual, $mesAtual, $anoAtual );
        } else if ( $diaAtual >= 28 ) {
            $this->gerarFaturas( $diaAtual, $mesAtual, $anoAtual );
        }

    }

    public function gerarFaturas( $diaAtual, $mesAtual, $anoAtual ) {

    }
    
    public function processarDebitos( $diaAtual, $mesAtual, $anoAtual ) {
        $anoLetivo      = "2014";
        $semestreAtual  = "2";

        $usuarios_servicos   = new Application_Model_DbTable_Usuarioservicos();
        $matriculas          = new Application_Model_DbTable_Matricula();
        $debitos             = new Application_Model_DbTable_Debitos();

        $matriculasCorrentes = $matriculas->getMatriculasNaoProcessadas( $anoLetivo, $semestreAtual, $mesAtual );

        if ( count($matriculasCorrentes) > 0 ) {
            foreach ($matriculasCorrentes as $mat) {
                $debitos->insert(
                    array(
                        'mesPagamento' => $mesAtual,
                        'anoPagamento' => $anoAtual,
                        'idUsuario_has_Turma' => $mat->idUsuario_has_Turma,
                    )
                );
            }
        }

        $servicos_correntes = $usuarios_servicos->getServicosNaoProcessados( $mesAtual );

        if ( count($servicos_correntes) > 0 ) {
            foreach($servicos_correntes as $sc ) {
                $debitos->insert(
                    array(
                        'mesPagamento' => $mesAtual,
                        'anoPagamento' => $anoAtual,
                        'idUsuario_has_Servicos' => $sc->idUsuario_has_Servicos
                    )
                );
            }
        }
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
    				$model->update($data, $where);
    				$this->_redirect("/admin");	
    			}
    		}
    	}
    	$this->view->form = $form;
    }
}