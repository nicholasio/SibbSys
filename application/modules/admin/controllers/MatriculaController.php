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


		$ano = $semestre = false;

		if($this->_request->isPost()){
			$ano =  $_POST['ano'];
			$semestre =  $_POST['semestre'];
		}

		$this->view->curr_ano = $ano;
		$this->view->curr_semestre = $semestre;

		$this->view->prof = $turma->lista();
		
		$this->view->rows = $model->listar($ano, $semestre);

		$this->view->ano = $turma->_findAno(false);
		$this->view->semes = $turma->_findSemestre(false);

				
    }

    public function novoAction() {
    	
    	//$form = new Application_Form_Matricula();
    	$model = new Application_Model_DbTable_Matricula();
    	$turma = new Application_Model_DbTable_Turma();
		$config = new Application_Model_DbTable_Configs();

		// A Matrícula deve ser feita em turmas do período letivo atual
		$ano_atual 		= $config->findKey('ano_atual');
		$semestre_atual = $config->findKey('semestre_atual');


    	
    	$this->view->turmas = $turma->listar($ano_atual, $semestre_atual);

    	if ($this->_helper->FlashMessenger->hasMessages()) {
            $this->view->messages = $this->_helper->FlashMessenger->getMessages();
        }


    	if ( $this->_request->isPost() ) {
    		$aluno    = $_POST['aluno'];
    		

    		$nTurmas  = count($_POST['matricula']);

    		$data['Usuario_idUsuario'] = $aluno;
    		$data['Status'] = 'Cursando';

    		for( $i = 0; $i < $nTurmas; $i++ ) {
    			$turma_id  = $_POST['matricula'][$i]['turma'];
    			$turma_data = $turma->findForSelect($turma_id)->toArray()[0];
    			$professor  = $turma->_find($aluno, $turma_id);

    			$find = $model->verificar($aluno, $turma_id);
    			if ( is_null($find) ) {
    				if ( is_null($professor) ) {
	    				$data['Turma_idTurma'] = $turma_id;
	    				$model->insert($data);    				
    				} else {
    					$this->_helper->flashMessenger->addMessage("Aluno é professor da turma: <strong>" . $turma_data['Nome'] . "</strong>");
    				}
    			} else {
    				$msg = "O Usuário já está matricula na turma <strong>" . $turma_data['Nome'] . "</strong>";;
    				$this->_helper->flashMessenger->addMessage($msg);
    			}
    		}

    		$this->_redirect('/admin/matricula/novo');
    	}

    	
    	/*if($this->_request->isPost()){
			
			$idTurma = $data['Turma_idTurma'];
			$idUsuario = $data['Usuario_idUsuario'];

			$count = count($_POST['matriculas']);
			for($i = 0; $i < $count; $i++ ) {
				$user = $_POST['matriculas'][$i]['user_id'];
				$turma_id = $_POST['matriculas'][$i]['turma_id'];

			}
			
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
				$this->view->messages = $msg
			}
		}*/
		
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