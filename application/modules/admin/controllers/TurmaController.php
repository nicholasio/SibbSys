<?php

class Admin_TurmaController extends AppBaseController{

	
	public function preDispatch(){
	
		parent::preDispatch();
		$auth = Zend_Auth::getInstance();
		if(!$auth->hasIdentity()){
			$this->_redirect('/default');
		}
	}
	
	
    public function indexAction(){
    	
    	/**if ($this->_helper->FlashMessenger->hasMessages()) {
    		$this->view->messages = $this->_helper->FlashMessenger->getMessages();
    	}**/
    
    	$model = new Application_Model_DbTable_Turma();
    	//$model_matricula = new Application_Model_DbTable_Matricula();

        $this->view->ano = $model->_findAno(false);
        $this->view->semes = $model->_findSemestre(false);
   
    	
    	//$this->view->rows = $model->listar();	
    	
    }


    public function getAction(){

	    $this->getHelper( 'Layout' )->disableLayout();
	    $this->getHelper( 'ViewRenderer' )->setNoRender();
	    $this->getResponse()->setHeader( 'Content-Type', 'application/json' );

	    $turma = new Application_Model_DbTable_Turma();

	    $ano      = isset( $_GET['ano'] ) ? $_GET['ano'] : false;
	    $semestre = isset( $_GET['semestre'] ) ? $_GET['semestre'] : false;
	    $start    = isset( $_GET['start'] ) ? $_GET['start'] : 0;
	    $length   = isset( $_GET['length'] ) ? $_GET['length'] : 30;
	    $draw     = isset( $_GET['draw'] ) ? (int) $_GET['draw'] : 1;
	    $search   = isset( $_GET['search']['value'] ) ? filter_var( $_GET['search']['value'], FILTER_SANITIZE_STRING ) : false;

	    $rows = $turma->listar( $ano, $semestre, $search, $start, $length );


	    $numeroTurmas = $turma->numeroTurmas( $search );
	    $data         = array(
		    'draw'            => $draw,
		    'recordsTotal'    => $numeroTurmas,
		    'recordsFiltered' => $numeroTurmas,
		    'data'            => array()
	    );

	    foreach ( $rows as $row ) {

		    $editar = sprintf( "<a id='btn-admin' class='btn btn-primary' href='%s'>Editar</a>", $this->getHelper( 'url' )->url(
			    array(
				    'controller' => 'turma',
				    'action'     => 'editar',
				    'idTurma'    => $row->idTurma
			    ) ) );

		    $caderneta = sprintf( "<a id='btn-admin' class='btn btn-inverse' href='%s'>Caderneta</a>", $this->getHelper( 'url' )->url(
			    array(
				    'controller' => 'turma',
				    'action'     => 'caderneta',
				    'idTurma'    => $row->idTurma
			    ) ) );

		    if ( $row->Status == 'ativo' ) {

			    $status = sprintf( "<a id='btn-admin' class='btn btn-danger' href='%s'>Encerrar Turma</a>", $this->getHelper( 'url' )->url(
				    array(
					    'controller' => 'professor',
					    'action'     => 'admin-encerrarturma',
					    'idTurma'    => $row->idTurma
				    ) ) );

		    } else {

			    $status = sprintf( "<a id='btn-admin' class='btn btn-success' href='%s'>Ativar Turma</a>", $this->getHelper( 'url' )->url(
				    array(
					    'controller' => 'turma',
					    'action'     => 'ativar',
					    'idTurma'    => $row->idTurma
				    ) ) );
		    }

		    $_data = array(
			    $row->idTurma,
			    $row->Nome,
			    $row->Ano . '/' . $row->Semestre,
			    $row->findParentRow( 'Application_Model_DbTable_Usuario' )->Nome,
			    $editar . "&nbsp;" . $caderneta . "&nbsp;" . $status
		    );

		    $data['data'][] = $_data;

	    }

	    return $this->getHelper( 'json' )->sendJson( $data );
    }


    public function novoAction() {
    	
    	if ($this->_helper->FlashMessenger->hasMessages()) {
    		$this->view->messages = $this->_helper->FlashMessenger->getMessages();
    	}
    	
    	$model = new Application_Model_DbTable_Turma();
        $DiscTable = new Application_Model_DbTable_Disciplina();
        $form = new Application_Form_Turma();
    
        if($this->_request->isPost()){
            if($form->isValid($this->_request->getPost())){
                $data = $form->getValues();
                $model->insert($data);
                $this->_helper->flashMessenger->addMessage("Turma cadastrada com sucesso!");
                $this->_redirect('/admin/turma/novo');
            }
        }
        $this->view->form = $form;
        
    }
    
    
    public function editarAction(){

    	$model = new Application_Model_DbTable_Turma();
    	$form = new Application_Form_Turma();
    	
    	$id = $this->_getParam('idTurma');
    	
    	$data = $model->editar($id);
    	if(is_array($data)){
    		$form->populate($data);
    	}
    	
    	if($this->_request->isPost()){
    		if($form->isValid($this->_request->getPost())){
    			$data = $form->getValues();
    			if($id){
    				$where = $model->getAdapter()->quoteInto('idTurma = ?', $id);
    				$model->update($data, $where);
    				$this->_helper->flashMessenger->addMessage("Dados atualizados com sucesso!");
    				$this->_redirect('/admin/turma');
    			}
    		}
    	}
    	$this->view->form = $form;
    }
    
    public function cadernetaAction(){
    	
    	$total = 0;
    	$id = $this->_getParam('idTurma');
    	$model = new Application_Model_DbTable_Matricula();
    	$turma = new Application_Model_DbTable_Turma();
    	$this->view->dados = $model->findForSelect($id);
    	$this->view->turma = $turma->hasTurma($id);
    }
    
    

    public function ativarAction(){
        	
    	$model = new Application_Model_DbTable_Turma();
    	
    	$id = $this->_getParam('idTurma');
    	
    	$turma_ativada = $model->ativar($id);
    	
    	$this->_helper->FlashMessenger->addMessage(" Turma ativada com sucesso! ");
    	
    	$this->_redirect('/admin/turma');
    	
    }

    public function notasAction() {
	    $this->_helper->layout()->disableLayout();
	    $this->view->turma_id = $this->_getParam('idTurma');

    }
    
    
}