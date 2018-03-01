<?php

class Admin_MatriculaController extends AppBaseController{

    
	public function preDispatch(){
	
		parent::preDispatch();
		$auth = Zend_Auth::getInstance();
		if(!$auth->hasIdentity()){
			$this->_redirect('/default');
		}
	}
	
	
	public function indexAction(){
		$turma = new Application_Model_DbTable_Turma();

		$this->view->ano = $turma->_findAno(false);
		$this->view->semes = $turma->_findSemestre(false);
    }

	public function getAction() {
		$this->getHelper( 'Layout' )->disableLayout();
		$this->getHelper( 'ViewRenderer' )->setNoRender();
		$this->getResponse()->setHeader( 'Content-Type', 'application/json' );

		$model = new Application_Model_DbTable_Matricula();
		$turma = new Application_Model_DbTable_Turma();

		$ano      = isset( $_GET['ano'] ) ? (int) $_GET['ano'] : false;
		$semestre = isset( $_GET['semestre'] ) ? (int) $_GET['semestre'] : false;
		$start    = isset( $_GET['start'] ) ? (int) $_GET['start'] : 0;
		$length   = isset( $_GET['length'] ) ? (int) $_GET['length'] : 30;
		$draw     = isset( $_GET['draw'] ) ? (int) $_GET['draw'] : 1;
		$search   = isset( $_GET['search']['value'] ) ? filter_var( $_GET['search']['value'], FILTER_SANITIZE_STRING ): false;

		$prof = $turma->lista();
		$rows = $model->listar( $ano, $semestre, $search, $start, $length );

		$numeroMatriculas = $model->numeroMatriculas( $search );
		$data = array(
			'draw'         => $draw,
			'recordsTotal' => $numeroMatriculas,
			'recordsFiltered' => $numeroMatriculas,
			'data'         => array()
		);

		foreach ( $rows as $row ) {
			$prof_name = '';
			foreach ( $prof as $_prof ) {
				if ( $_prof->findParentRow( 'Application_Model_DbTable_Usuario' )->idUsuario ==
				     $row->findParentRow( 'Application_Model_DbTable_Turma' )->idUsuario ) {
					$prof_name = $_prof->findParentRow( 'Application_Model_DbTable_Usuario' )->Nome;
				}
			}
			$status = $row->statusMatricula;
			switch($status){
				case 'Aprovado':
					$status = sprintf( "<span class='label label-success'>%s</span>", $status );
					break;
				case 'Reprovado':
					$status = sprintf( "<span class='label label-important'>%s</span>", $status );
					break;
				case 'Cursando':
					$status = sprintf( "<span class='label label-info'>%s</span>", $status );
					break;
				default:
					$status = sprintf( "<span class='label label-info'>%s</span>", $status );
					break;
			}
			$action = sprintf( "<a id='btn-admin' class='btn btn-danger' href='%s'>Excluir</a>", $this->getHelper('url')->url(
				array(
					'controller'          => 'matricula',
					'action'              => 'delete',
					'idUsuario_has_Turma' => $row->idUsuario_has_Turma
				) ) );
			$_data          = array(
				$row->idUsuario_has_Turma,
				$row->findParentRow( 'Application_Model_DbTable_Usuario' )->Nome,
				$row->findParentRow( 'Application_Model_DbTable_Turma' )->Nome,
				$row->findParentRow( 'Application_Model_DbTable_Turma' )->Ano . '/' . $row->findParentRow( 'Application_Model_DbTable_Turma' )->Semestre,
				$prof_name,
				$status,
				$action
			);
			$data['data'][] = $_data;
		}

		return $this->getHelper( 'json' )->sendJson( $data );
    }

    public function novoAction() {
    	
    	
    	//$form = new Application_Form_Matricula();
    	$model = new Application_Model_DbTable_Matricula();
    	$model_usuario = new Application_Model_DbTable_Usuario();
    	$turma = new Application_Model_DbTable_Turma();
		$config = new Application_Model_DbTable_Configs();

		// A Matrícula deve ser feita em turmas do período letivo atual
		$ano_atual 		= $config->findKey('ano_atual');
		$semestre_atual = $config->findKey('semestre_atual');


    	$this->view->usuario = $model_usuario->listaUsuario(); 
		
		
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
	    				$this->_helper->flashMessenger->addMessage("Matricula realizada com sucesso!");
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