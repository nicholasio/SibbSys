<?php

class Admin_MatriculaController extends Zend_Controller_Action{

    public function indexAction(){
    	
    	$form = new Application_Form_Matricula();
		$model = new Application_Model_DbTable_Matricula();
		$turma = new Application_Model_DbTable_Turma();
		
		$this->view->prof = $turma->listar();
		
		$this->view->rows = $model->listar();
		
		
    	if($this->getRequest()->getPost('Voltar')){
    		$this->_redirect("/admin");
    	}
		
		if($this->_request->isPost()){
			if($form->isValid($this->_request->getPost())){

				$data = $form->getValues();
				
				$idTurma = $data['Turma_idTurma'];
				$idUsuario = $data['Usuario_idUsuario'];
				
				$this->find = $model->verificar($idUsuario, $idTurma);
				$this->user = $turma->_find($idUsuario);
				
				if(is_null($this->find)){
					if(is_null($this->user)){
						$model->insert($data);
						$this->_redirect('/admin/matricula');
					}
					else{
						echo "O Usuário é o professor da Turma";
					}
				}
				else{
					echo "O Usuário já está matriculado na Turma";
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