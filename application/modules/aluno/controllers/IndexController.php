<?php	

class Aluno_IndexController extends AppBaseController{

	
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
    	
    	$auth = Zend_Auth::getInstance();
    	$data = $auth->getStorage()->read();
    	$id = $data->idUsuario;
    	
    	
    	$usuario_model = new Application_Model_DbTable_Usuario();
    	$model = new Application_Model_DbTable_Matricula();
    	$fileTable = new Application_Model_DbTable_Arquivos();
    	 
    	$this->view->rows = $model->turmas($id);
    	$this->view->file = $fileTable->findForSelect();
    	 
    	$this->view->usuario = $usuario_model->getUser($id);
    }

    public function boletimAction(){
		
    	$auth = Zend_Auth::getInstance();
    	$result = $auth->getStorage()->read();
    	
    	$id = $result->idUsuario;
    	
    	$model = new Application_Model_DbTable_Matricula();
    	$turma = new Application_Model_DbTable_Turma();
	    $configs = new Application_Model_DbTable_Configs();

	    $data = array();

    	if($this->_request->isPost()) {
    		
    		$data['semestre'] = $_POST['semestre'];
    		$data['ano'] = $_POST['ano'];

    	} else {
		    $data['semestre'] = $configs->findKey('semestre_atual');
		    $data['ano'] = $configs->findKey('ano_atual');
	    }

	    $this->view->data = $data;

		$this->view->rows = $model->turmas($id);
		$this->view->row = $model->getTurma($id);
		$this->view->ano = $turma->_findAno($id);
		$this->view->semes = $turma->_findSemestre($id);
    	
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
    				$this->_redirect("/aluno");	
    			}
    		}
    	}
    	$this->view->form = $form;
    	
    }

    
    public function historicoAction(){

    	$auth = Zend_Auth::getInstance();
    	$dados = $auth->getStorage()->read();
    	
    	$id = $dados->idUsuario;
    	$idUsuario = $dados->idUsuario;
    	
    	$this->view->idusuario = $idUsuario;
    	
    	$model = new Application_Model_DbTable_Matricula();
    	$turma_model = new Application_Model_DbTable_Turma();
    	$this->view->usuario = $turma_model->listaData($idUsuario);
    	$this->view->rows = $model->turmas_turmas($id);
    	$this->view->row = $model->getTurma($id);
    	
    }

    
    public function turmaAction(){
    	
    	$auth = Zend_Auth::getInstance();
    	$data = $auth->getStorage()->read();
    	
    	$id = $data->idUsuario;
    	
    	$model = new Application_Model_DbTable_Matricula();
    	$fileTable = new Application_Model_DbTable_Arquivos();
    	
    	$this->view->rows = $model->turmas($id);
    	$this->view->file = $fileTable->findForSelect();
		
    }

    
    public function materialAction(){
        
    	$id = $this->_getParam('idTurma');
    	
    	$model = new Application_Model_DbTable_Arquivos();
    	$this->view->rows = $model->download($id);
    	
    	$this->view->row = $model->seleciona($id);
    }

    
    public function downloadAction(){
       
    	$id = $this->_getParam('idArquivo');
    	
    	$model = new Application_Model_DbTable_Arquivos();
    	$row = $model->editar($id);
    	
    	$file = $row['Arquivo'];
    	$nome = $row['Nome'];
    	
    	$location = APPLICATION_PATH . "/../public/arquivos/$file";
    	
    	$path_parts = pathinfo($location);
   	 	$ext = strtolower($path_parts["extension"]);
   	 	
    	// Determine Content Type
    	switch ($ext) {
      		case "pdf": $ctype="application/pdf"; break;
      		case "exe": $ctype="application/octet-stream"; break;
      		case "zip": $ctype="application/zip"; break;
      		case "doc": $ctype="application/msword"; break;
      		case "xls": $ctype="application/vnd.ms-excel"; break;
      		case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
      		case "gif": $ctype="image/gif"; break;
      		case "png": $ctype="image/png"; break;
      		case "jpeg": $ctype="image/jpeg"; break;
      		case "jpg": $ctype="image/jpeg"; break;
      		case "mp3": $ctype="audio/mpeg"; break;
      		case "wav": $ctype="audio/x-wav"; break;
      		case "mpeg":
      		case "mpg":
      		case "mpe": $ctype="video/mpeg"; break;
      		case "mov": $ctype="video/quicktime"; break;
      		case "avi": $ctype="video/x-msvideo"; break;
      		default: $ctype="application/force-download";
    	}
    	
    	
    	if(file_exists($location)){
    	
    		header("Pragma: public"); // required
    		header("Expires: 0");
    		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    		header("Cache-Control: public",true); // required for certain browsers
    		//header("Content-Type: $ctype");
    		header("Content-Disposition: attachment; filename=\"".basename($nome)."\" .$ext;" );
    		header("Content-Transfer-Encoding: binary");
    		header("Content-Length: ". filesize($location));
    		ob_clean();
    		flush();
    		
    		readfile($location);
    		
    		$this->view->layout()->disableLayout();
	    	$this->_helper->viewRenderer->setNoRender(true);
    	}	
    	
    	else{
    		echo 'Arquivo não encontrado';
    	}
    }

	public function faturaAction(){

		$idFatura = $this->_getParam('idFatura');

		$faturas_model = new Application_Model_DbTable_Faturas();

		$this->view->rows = $faturas_model->listagem($idFatura);

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
					$this->_redirect("/aluno");
				}
			}
		}
		 
		$this->view->form = $form;
	}
	
	
	public function alterarDadosAction(){
		 
		$auth = Zend_Auth::getInstance();
		$dados = $auth->getStorage()->read();
		 
		$id = $dados->idUsuario;
		 
		$form = new Application_Form_AlterarDados();
		$model = new Application_Model_DbTable_Usuario();
		 
		$data = $model->editar($id);
		if(is_array($data)){
			$form->populate($data);
		}
		 
		if($this->_request->isPost()){
			if($form->isValid($this->_request->getPost())){
				$data = $form->getValues();
				if($id){
					$where = $model->getAdapter()->quoteInto('idUsuario = ?', $id);
					$model->update($data, $where);
					$this->_helper->flashMessenger->addMessage("Dados Alterados com sucesso.");
					$this->_redirect("/aluno");
				}
			}
		}
		$this->view->form = $form;
	}
	
	
	public function sobreAction(){
		
		
		
	}
	
	
}