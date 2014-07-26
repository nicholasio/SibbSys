<?php

class Admin_MatriculaController extends Zend_Controller_Action{

    
	public function preDispatch(){
	
		parent::preDispatch();
		$auth = Zend_Auth::getInstance();
		if(!$auth->hasIdentity()){
			$this->_redirect('/default');
		}
	}
	
	
	public function indexAction(){
    	
    	
		$model = new Application_Model_DbTable_Matricula();
		$turma = new Application_Model_DbTable_Turma();
		
		$this->view->prof = $turma->lista();
		
		$this->view->rows = $model->listar();
				
    }

    public function novoAction() {
    	
    	$form = new Application_Form_Matricula();
    	$model = new Application_Model_DbTable_Matricula();
    	$turma = new Application_Model_DbTable_Turma();
    	
    	$this->view->lista = $turma->listar();
 

    	if($this->_request->isPost()){
			if($form->isValid($this->_request->getPost())){

				$data = $form->getValues();
				
				$idTurma = $data['Turma_idTurma'];
				$idUsuario = $data['Usuario_idUsuario'];

				/*$count = count($_POST['matriculas']);
				for($i = 0; $i < $count; $i++ ) {
					$user = $_POST['matriculas'][$i]['user_id'];
					$turma_id = $_POST['matriculas'][$i]['turma_id'];

				}*/
				
				$this->find = $model->verificar($idUsuario, $idTurma);
				$this->user = $turma->_find($idUsuario);
				
				if(is_null($this->find)){
					if(is_null($this->user)){
						$model->insert($data);
						$this->_redirect('/admin/matricula/novo');
					}
					else{
						$msg = "O Usuário é o professor da Turma";
						$this->view->messages = $msg;
					}
				}
				else{
					$msg = "O Usuário já está matriculado na Turma";
					$this->view->messages = $msg;
				}
				
			}
		}
		
		$this->view->form = $form;
    }

	public function editarAction(){
		
		$id = $this->_getParam('idUsuario_has_Turma');
		
		$model = new Application_Model_DbTable_Matricula();
		$form = new Application_Form_Matricula();	
		
		$data = $model->editar($id);
		
		if(is_array($data)){
			$form->populate($data);
		}
		
		if($this->_request->isPost()){
			if($form->isValid($this->_request->getPost())){
				$data = $form->getValues();
				if($id){
					$where = $model->getAdapter()->quoteInto('idUsuario_has_Turma = ?', $id);
					$model->update($data, $where);
					$this->_redirect("/admin/matricula");
				}
			}
		}
		$this->view->form = $form;
	}
	
	
	public function deleteAction(){
		
		$id = $this->_getParam('idUsuario_has_Turma');
		
		$model = new Application_Model_DbTable_Matricula();
		
		$model->deletar($id);
		
		$this->_redirect("/admin/matricula");
	}
}