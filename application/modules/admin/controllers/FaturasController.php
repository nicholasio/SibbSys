<?php 

class Admin_FaturasController extends AppBaseController{
	
	
	public function preDispatch(){
	
		parent::preDispatch();
		$auth = Zend_Auth::getInstance();
		if(!$auth->hasIdentity()){
			$this->_redirect('/default');
		}
	}

	/**
	 * Cria um registro de fatura e associa os débitos selecionados
     */
	public function novoAction() {

		$fatura_model = new Application_Model_DbTable_Faturas();

		if ( $this->_request->isPost() ) {
			$user_id = $_POST['user_id'];
			$debitos_id = $_POST['debitos'];

			$fatura_model->gerarFatura($debitos_id, $user_id);
		}

		$this->_redirect("/admin/faturas");
	}


	public function indexAction(){

	/**	if ($this->_helper->FlashMessenger->hasMessages()) {
			$this->view->messages = $this->_helper->FlashMessenger->getMessages();
		} **/

		$faturas_model = new Application_Model_DbTable_Faturas();
		$user_id = null;

		if ( isset($_GET['aluno']) ) {
			$user_id = $_GET['aluno'];
			$this->view->user_id = $user_id;
		}

		if ( $user_id == -1 ) $user_id = null;
	
		$this->view->rows = $faturas_model->listar($user_id);
		
	}


	public function getAction(){

		$this->getHelper( 'Layout' )->disableLayout();
	    $this->getHelper( 'ViewRenderer' )->setNoRender();
	    $this->getResponse()->setHeader( 'Content-Type', 'application/json' );

	    $faturas_model = new Application_Model_DbTable_Faturas();
	    $user_model = new Application_Model_DbTable_Usuario();

	    //$mes    = isset( $_GET['mes'] ) ? $_GET['mes'] : false;
	    //$ano 	  = isset( $_GET['ano'] ) ? $_GET['ano'] : false;
	    $start    = isset( $_GET['start'] ) ? $_GET['start'] : 0;
	    $length   = isset( $_GET['length'] ) ? $_GET['length'] : 30;
	    $draw     = isset( $_GET['draw'] ) ? (int) $_GET['draw'] : 1;
	    $search   = isset( $_GET['search']['value'] ) ? filter_var( $_GET['search']['value'], FILTER_SANITIZE_STRING ) : false;
		
		//$user = $user_model->list();
		$rows = $faturas_model->getLista($start, $length, $search);

		$numeroPendentes = $faturas_model->numeroPendentes( $search );
		$data         = array(
		    'draw'            => $draw,
		    'recordsTotal'    => $numeroPendentes,
		    'recordsFiltered' => $numeroPendentes,
		    'data'            => array()
	    );


		foreach ( $rows as $row ) {

		echo $row->idFatura;
		die();

		  /**  $editar = sprintf( "<a style='font-size: 12px;' id='btn-admin' class='btn btn-primary' href='%s'>Editar</a>", $this->getHelper( 'url' )->url(
			    array(
				    'controller' => 'turma',
				    'action'     => 'editar',
				    'idTurma'    => $row->idTurma
			    ) ) );
			**/

		    $_data = array(

		    	$row['idFatura'],
				$row['debitos'][0]['user']['Nome'],
				$row['mes'] . '/' . $fatura['ano'],
			    //$row[idFatura,
			    //$row->Nome,
			    //sprintf ("<p style='text-align: center;'> $row->mes.$row->ano</p>"),
			    //$row->findParentRow( 'Application_Model_DbTable_Usuario' )->Nome,
			    //$editar
		    );

		    $data['data'][] = $_data;
		}



		return $this->getHelper( 'json' )->sendJson( $data );
		
	}
	
	
	public function editarAction(){
		
		$model = new Application_Model_DbTable_Faturas();
		$form = new Application_Form_Faturas();
		
		$id = $this->_getParam('idFaturas');
		
		$data = $model->editar($id);
		if(is_array($data)){
			$form->populate($data);
		}
		
		if($this->_request->isPost()){
			if($form->isValid($this->_request->getPost())){
				$data = $form->getValues();
				if($id){
					$where = $model->getAdapter()->quoteInto('idFatura = ?', $id);
					$model->update($data, $where);
					$this->_redirect("/admin/faturas");
				}
			}
		}
		$this->view->form = $form;
	}
	
	
	public function deleteAction(){
		
		$model = new Application_Model_DbTable_Faturas();
		
		$id = $this->_getParam('idFaturas');

		$model->deletar($id);

		$this->_helper->flashMessenger->addMessage("Fatura #{$id} removida");

		$this->_redirect("/admin/faturas");
	}
	
	
	public function downloadAction(){
		
		$idFatura = $this->_getParam('idFatura');
		
		$faturas_model = new Application_Model_DbTable_Faturas();
		$pagamento_model = new Application_Model_DbTable_Pagamento();
		
		$this->view->rows = $faturas_model->listagem($idFatura);

	}
	
	
	public function pendenteAction(){
		
		$idFatura = $this->_getParam('idFatura');
		
		$faturas_model = new Application_Model_DbTable_Faturas();
		$pagamento_model = new Application_Model_DbTable_Pagamento();
		
		$this->view->rows = $faturas_model->listagem($idFatura);
	}


	public function relatorioAction(){
		
		$faturas_model = new Application_Model_DbTable_Faturas();
		
		$this->view->rows = $faturas_model->listar();
		
	}

	
	public function getRelatorioAction(){

		$this->getHelper( 'Layout' )->disableLayout();
	    $this->getHelper( 'ViewRenderer' )->setNoRender();
	    $this->getResponse()->setHeader( 'Content-Type', 'application/json' );

	    $faturas_model = new Application_Model_DbTable_Faturas();
	    //$user_model = new Application_Model_DbTable_Usuario();

	    $mes      = isset( $_GET['mes'] ) ? $_GET['mes'] : false;
	    $ano 	  = isset( $_GET['ano'] ) ? $_GET['ano'] : false;
	    $start    = isset( $_GET['start'] ) ? $_GET['start'] : 0;
	    $length   = isset( $_GET['length'] ) ? $_GET['length'] : 30;
	    $draw     = isset( $_GET['draw'] ) ? (int) $_GET['draw'] : 1;
	    $search   = isset( $_GET['search']['value'] ) ? filter_var( $_GET['search']['value'], FILTER_SANITIZE_STRING ) : false;
		
		
		//$user = $user_model->list();
		$rows = $faturas_model->getLista( $mes, $ano, $start, $length, $search );

		//print_r ($ano);
		//die();

		$numeroPendentes = $faturas_model->numeroPendentes( $search );
		$data         = array(
		    'draw'            => $draw,
		    'recordsTotal'    => $numeroPendentes,
		    'recordsFiltered' => $numeroPendentes,
		    'data'            => array()
	    );


		foreach ( $rows as $row ) {

		    $_data = array(
			    //$row->idFatura,
			    $row['idFatura'],
				$row['debitos'][0]['user']['Nome'],
				$row['mes'] . '/' . $fatura['ano'],
			    //$editar
		    );

		    $data['data'][] = $_data;
		}

		return $this->getHelper( 'json' )->sendJson( $data );
		
		
	}
	
	public function relatorioDownloadAction(){
		
		$faturas_model = new Application_Model_DbTable_Faturas();
		
		$this->view->rows = $faturas_model->listar();
		
	}
	
}