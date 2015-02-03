<?php

class Professor_NotaController extends AppBaseController{
	
	
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
			
		$user = new Application_Model_DbTable_Usuario();
		$turma = new Application_Model_DbTable_Turma();
		$model = new Application_Model_DbTable_Nota();
		$matric = new Application_Model_DbTable_Matricula();
		
		$this->view->nota = ! is_null($model->findForSelect($id)) ? $model->findForSelect($id)->toArray() : null;
		
		$this->view->rows = $matric->findForSelect($id);
		$this->view->linha = $turma->findForSelect($id);
		$this->view->row = $turma->hasTurma($id);
		$this->view->find = $matric->_findId($id);
		
	}
	
	
	public function postNotaAction(){
		
		$model = new Application_Model_DbTable_Nota();
		
		if($this->_request->isPost()){
			$count = count($_POST['unit1']);
			
			for($i = 0; $i < $count; $i++){
				$data = array();
				if ( strlen($_POST['unit1'][$i]) > 0 )
					$data['Unit1'] = abs(str_replace(',','.',$_POST['unit1'][$i]));

				if ( strlen($_POST['unit2'][$i]) > 0 )
					$data['Unit2'] = abs(str_replace(',','.',$_POST['unit2'][$i]));

				if ( strlen($_POST['unit3'][$i]) > 0)
					$data['Unit3'] = abs(str_replace(',','.',$_POST['unit3'][$i]));
				
				$data['idUsuario_has_Turma'] = $_POST['idMatricula'][$i];
				$data['Turma_idTurma'] = $_POST['idTurma'][$i];

				$id = $_POST['idNota'][$i];
				$idTurma = $_POST['idTurma'][$i];
				
				$unit1 = isset($data['Unit1']) ? (int) $data['Unit1'] : 0;
				$unit2 = isset($data['Unit2']) ? (int) $data['Unit2'] : 0;
				$unit3 = isset($data['Unit3']) ? (int) $data['Unit3'] : 0;

				if ( $unit1 <= 10 && $unit2 <= 10 && $unit3 <= 10 ) {
					if($id){
						$where = $model->getAdapter()->quoteInto('idNota = ?', $id);
						$model->update($data, $where);
					}
					else{
						$model->insert($data);
					}
				}
			}
		}

		$this->_redirect("/professor/nota/index/idTurma/$idTurma");
		
	}
	
	
	public function listarAction(){
		
		$id = $this->_getParam('idTurma');
			
		$model = new Application_Model_DbTable_Nota();
		$turma = new Application_Model_DbTable_Turma();
		
		$this->view->result = $model->findForSelect($id);
		$this->view->linha = $turma->findForSelect($id);
		$this->view->row = $turma->hasTurma($id);
		
	}
	
	
	public function deleteAction(){
		
		$id = $this->_getParam('idNota');
		$idTurma = $this->_getParam('idTurma');
		
		$model = new Application_Model_DbTable_Nota();
		$model->deletar($id);
		$this->_redirect("/professor/nota/listar/idTurma/$idTurma");
		
	}
}