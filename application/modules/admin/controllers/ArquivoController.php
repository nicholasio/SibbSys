<?php

class Admin_ArquivoController extends AppBaseController{


	public function init(){

	}

	public function preDispatch(){

		parent::preDispatch();
		$auth = Zend_Auth::getInstance();
		if(!$auth->hasIdentity()){
			$this->_redirect('/default');
		}
	}


	public function indexAction(){
		 
		$id = $this->_getParam('idTurma');
		 
		$model = new Application_Model_DbTable_Arquivos();
		$turma = new Application_Model_DbTable_Turma();
		$result = $turma->editar($id);
		$this->view->turma = $result['Nome'];

		$idTurma = $result['idTurma'];
		
		$form = new Application_Form_Arquivo();

		if($this->_request->isPost()){
			if($form->isValid($this->_request->getPost())){
				$data = $form->getValues();
				$data['Turma_idTurma'] = $idTurma;
				$model->insert($data);
				$this->_redirect("/admin/arquivo/listar/idTurma/$id");
			}
		}

		$this->view->form = $form;

	}


	public function editarAction(){
		 
		$id = $this->_getParam('idArquivo');
		$idTurma = $this->_getParam('idTurma');
		$form = new Application_Form_ArquivoEdit();
		$model = new Application_Model_DbTable_Arquivos();
		 

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
					$this->_redirect("/admin/arquivo/listar/idTurma/$idTurma");
				}
			}
		}

		$this->view->form = $form;

	}


	public function listarAction(){
		 
		$id = $this->_getParam('idTurma');

		$turma = new Application_Model_DbTable_Turma();
		$result = $turma->editar($id);
		$this->view->turma = $result['Nome'];
		 
		$idTurma = $result['idTurma'];
		$model = new Application_Model_DbTable_Arquivos();
		 
		$this->view->rows = $model->listar($idTurma);
	}


	public function deleteAction(){
		 
		$id = $this->_getParam('idArquivo');
		$idTurma = $this->_getParam('idTurma');
		 
		$model = new Application_Model_DbTable_Arquivos();
		$model->deletar($id);
		$this->_redirect("/professor/arquivo/listar/idTurma/$idTurma");
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
			case "zip": $ctype="application/zip"; break;
			case "doc": $ctype="application/msword"; break;
			case "docx": $ctype="application/msword"; break;
			case "odt": $ctype="application/msword"; break;
			case "xlsx": $ctype="application/vnd.ms-excel"; break;
			case "xls": $ctype="application/vnd.ms-excel"; break;
			case "ods": $ctype="application/msword"; break;
			case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
			case "pptx": $ctype="application/vnd.ms-powerpoint"; break;
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