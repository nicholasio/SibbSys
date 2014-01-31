<?php

class Admin_MinhasTurmasController extends Zend_Controller_Action{

    
	public function preDispatch(){
	
		parent::preDispatch();
		$auth = Zend_Auth::getInstance();
		if(!$auth->hasIdentity()){
			$this->_redirect('/default');
		}
	}
	
	
	public function init(){
        /* Initialize action controller here */
    }

    public function indexAction(){
        // action body
    }
    
    public function historicoAction(){
    
    	$auth = Zend_Auth::getInstance();
    	$dados = $auth->getStorage()->read();
    	
    	$id = $dados->idUsuario;
    	
    	$model = new Application_Model_DbTable_Matricula();
    	$this->view->rows = $model->turmas($id);
    	
    }
    
    
    public function turmaAction(){
    
    	$auth = Zend_Auth::getInstance();
    	$data = $auth->getStorage()->read();
    	
    	$id = $data->idUsuario;
    	
    	$model = new Application_Model_DbTable_Matricula();
    	$this->view->rows = $model->turmas($id);
    }
    
    
    public function materialAction(){
    
    	$id = $this->_getParam('idDisciplina');
    	
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
    
    
    public function boletimAction(){
    	
    	    	$auth = Zend_Auth::getInstance();
    	$result = $auth->getStorage()->read();
    	
    	$id = $result->idUsuario;
    	
    	$model = new Application_Model_DbTable_Matricula();
    	$turma = new Application_Model_DbTable_Turma();
    	
    	if($this->_request->isPost()){
    		
    		$data['semestre'] = $_POST['semestre'];
    		$data['ano'] = $_POST['ano'];
    		 
    		$ano = $data['ano'];
    		$semestre = $data['semestre'];
    		
    		$this->view->data = $data;
    	}

    		$this->view->rows = $model->turmas($id);
    		$this->view->row = $model->getTurma($id);
    		$this->view->ano = $turma->_findAno($id);
    		$this->view->semes = $turma->_findSemestre($id);
    }
}