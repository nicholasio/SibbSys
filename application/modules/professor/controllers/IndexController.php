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
    	
        $auth = Zend_Auth::getInstance();
    	$data = $auth->getStorage()->read();
    	$this->view->data = $data;
    }

    public function notaAction(){
        
        /*Botões Voltar*/
    	
    	if($this->getRequest()->getPost('voltar')){
    		$this->_redirect("/professor/index/turmas");
    	}
    	
    	if($this->getRequest()->getPost('back')){
    		$this->_redirect("/professor");
    	}
    	
    	/*Botões Voltar*/
    	
    	$id = $this->_getParam('idTurma');
    	
    	$matric = new Application_Model_DbTable_Matricula();
    	$this->view->rows = $matric->findForSelect($id);
    	
    	$model = new Application_Model_DbTable_Nota();
    	$this->view->result = $model->findForSelect($id);
    	
    	$form = new Application_Form_Pesquisar();
    	$user = new Application_Model_DbTable_Usuario();
    	
    	
    	$turma = new Application_Model_DbTable_Turma();
    	
    	$this->view->linha = $turma->findForSelect($id);
    	$this->view->row = $turma->hasTurma($id);
    	
    	
    	if($this->_request->isPost()){
    		if($form->isValid($this->_request->getPost())){
    			$data = $form->getValues();
    			$keyword = $data['Usuario'];
    			$this->view->query = $user->buscar($keyword);
   			}
   		}
    		
    	$this->view->form = $form;
    }

    public function postNotaAction(){
    	
    	$data['Nota'] = $_POST['nota'];
    	$data['Unidade'] = $_POST['unidade'];
    	$data['idUsuario_has_Turma'] = $_POST['idMatricula'];
    	$data['Turma_idTurma'] = $_POST['idTurma'];
		$idTurma = $_POST['idTurma'];
		
    	$model = new Application_Model_DbTable_Nota();
    	
    		
    		if($this->_request->isPost()){
				if(! empty($data['Nota']))

					$model->insert($data);
					$this->_redirect("/professor/index/nota/idTurma/$idTurma");
			}
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
    				$this->_redirect("/professor");
    			}
    		}
    	}
    	
    	$this->view->form = $form;
    	
    	if($this->getRequest()->getPost('Voltar')){
    		$this->_redirect("/professor");
    	}
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

    public function presencaAction(){
        
    	$id = $this->_getParam('idTurma');
    	
    	$user = new Application_Model_DbTable_Usuario();
    	$model = new Application_Model_DbTable_Presenca();
    	
    	$this->view->result = $model->findForSelect($id);
    	
    	
    	$form = new Application_Form_Pesquisar();
    	
    	$turma = new Application_Model_DbTable_Turma();
    	$this->view->linha = $turma->findForSelect($id);
    	$this->view->row = $turma->hasTurma($id);

    	$matric = new Application_Model_DbTable_Matricula();
    	$this->view->rows = $matric->findForSelect($id);
    	
    	if($this->_request->isPost()){
    		if($form->isValid($this->_request->getPost())){
    		$data = $form->getValues();
    		$keyword = $data['Usuario'];
    		$this->view->query = $user->buscar($keyword);
    		}
    	}
		$this->view->form = $form;
    }

    public function postPresencaAction(){
        	
    	$data['Data'] = $_POST['data'];
    	$data['Faltas'] = $_POST['faltas'];
    	$data['idUsuario_has_Turma'] = $_POST['idMatricula'];
    	$data['Turma_idTurma'] = $_POST['idTurma'];
    	$idTurma = $_POST['idTurma'];
    	
    	$model = new Application_Model_DbTable_Presenca();     	
    	
		if($this->_request->isPost()){
			if(! empty($data['Faltas']))
				$model->insert($data);
			$this->_redirect("/professor/index/presenca/idTurma/$idTurma");
		}
    }

    public function excluirAction(){
    
    	if($this->_getParam('idPresenca')){
    		$id = $this->_getParam('idPresenca');
    		
    		$idTurma = $this->_getParam('idTurma');
    	
    		$model = new Application_Model_DbTable_Presenca();
    		$model->excluirPresenca($id);
    		$this->_redirect("/professor/index/presenca/idTurma/$idTurma");
    		
    	}
    	
    	if($this->_getParam('idNota')){
    		$id = $this->_getParam('idNota');
    		
    		$idTurma = $this->_getParam('idTurma');
    		
    		$nota = new Application_Model_DbTable_Nota();
    		$nota->excluir($id);
    		$this->_redirect("/professor/index/nota/idTurma/$idTurma");
    	}
    	
    }

    public function uploadAction(){
    
    	$id = $this->_getParam('idTurma');
    	$turma = new Application_Model_DbTable_Turma();
    	$result = $turma->editar($id);
    	
    	$idDisc = $result->Disciplina_idDisciplina;
    	
    	if($this->getRequest()->getPost('Voltar')){
    	
    		$this->_redirect("/professor/index/turmas");
    	}
    	
    	
    	$form = new Application_Form_Arquivo();
    	$model = new Application_Model_DbTable_Arquivos();
    	$pesq = new Application_Form_Pesquisar();
    	
    	
    	if($this->_request->isPost()){
    		if($pesq->isValid($this->_request->getPost())){
    			$data = $pesq->getValues();
    			$keyword = $data['Usuario'];
    			$this->view->query = $model->buscar($keyword);
    		}			
    	}
    	$this->view->pesq = $pesq;
    	
    	if($this->_request->isPost()){
    		if($form->isValid($this->_request->getPost())){
    			$data = $form->getValues();
    			$data['Disciplina_idDisciplina'] = $result->Disciplina_idDisciplina;
    			$model->insert($data);
    			$this->_redirect("/professor/index/upload/idTurma/$id");
    		}
    	}
    	
    	$this->view->form = $form;
    	
    	$this->view->rows = $model->listar($idDisc);
    }

    public function editarAction(){

    	
    	$idTurma = $this->_getParam('idTurma');
    	$form = new Application_Form_ArquivoEdit();
    	$model = new Application_Model_DbTable_Arquivos();
    	
    	$id = $this->_getParam('idArquivo');
    	
    	$data = $model->editar($id);
    	if(is_array($data)){
    	
    		$form->populate($data);
    	}
    	
    	if($this->_request->isPost()){
    		if($form->isValid($this->_request->getPost())){
    			$data = $form->getValues();
    			if($id){
    				$where = $model->getAdapter()->quoteInto('idArquivos = ?', $id);
    				$model->update($data, $where);
    				$this->_redirect("/professor/index/upload/idTurma/$idTurma");
    			}
    		}
    	}
    	
    	$this->view->form = $form;
    	
    }

    public function encerrarTurmaAction(){
		
    	$model = new Application_Model_DbTable_Turma();
    	
    	$id = $this->_getParam('idTurma');
    	
    	$model->encerrarTurma($id);
    	
    	$this->_redirect("/professor/index/turmas");
    	
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
    		header("Content-Type: $ctype");
    		header("Content-Disposition: attachment; filename=\"".basename($nome)."\";" );
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
}