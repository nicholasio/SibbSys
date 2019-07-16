<?php

class Admin_IndexController extends AppBaseController{

	
	public function preDispatch(){
	
		parent::preDispatch();
		
		$auth = Zend_Auth::getInstance();

		if(!$auth->hasIdentity()){
			$this->_redirect('/default');	
		}
	}
	
	
    public function indexAction(){
    	
    	$auth = Zend_Auth::getInstance();
    	$data = $auth->getStorage()->read();
    	
    	$id = $data->idUsuario;
    	$nomeArquivo = $data->Foto;

        if ($this->_helper->FlashMessenger->hasMessages()) {
            $this->view->messages = $this->_helper->FlashMessenger->getMessages();
        }
        
	    $mesAtual   = (int) date('m');

		$usuario_model = new Application_Model_DbTable_Usuario();
	    $this->view->aniversariantes = $usuario_model->getAniversariantes( $mesAtual );
	    $this->view->usuario = $usuario_model->getUser($id);

	    $this->view->db = $usuario_model->getAdapter();
	    $this->view->verso = $usuario_model->versiculo();
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
    
    
    public function alterarFotoAction(){
    	
    	$auth = Zend_Auth::getInstance();
    	$dados = $auth->getStorage()->read();
    	 
    	$id = $dados->idUsuario;
    	$nomeArquivo = $dados->Foto;
    	$path = "../public/files/" . $nomeArquivo;
    	
    	
    	$form = new Application_Form_Foto();
    	$model = new Application_Model_DbTable_Usuario();
    	
    	if($this->_request->isPost()){
    		if($form->isValid($this->_request->getPost())){
    			unlink($path);
    			$data = $form->getValues();
    			if($id){
    				$where = $model->getAdapter()->quoteInto('idUsuario = ?', $id);
    				$this->_helper->flashMessenger->addMessage("Foto alterada com sucesso! Por favor 
    							conecte-se novamente para que as alterações sejam concluídas.");
    				$model->update($data, $where);
    				$this->_redirect("/admin");
    			}
    		}
    	}
    	
    	$this->view->form = $form;
    }
    
    
    public function sobreAction(){
    	
    	
    }
    
    
}