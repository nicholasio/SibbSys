<?php 

class Admin_ConfigsController extends Zend_Controller_Action{
	
public function preDispatch(){
	
		parent::preDispatch();
		$auth = Zend_Auth::getInstance();
		if(!$auth->hasIdentity()){
			$this->_redirect('/default');
		}
	}
	
	public function indexAction(){
		$model = new Application_Model_DbTable_Configs();
		$allConfigs = $model->listar();

		if ( count($allConfigs) > 0 ) {
			foreach ($allConfigs as $config) {
				$this->view->{$config->Meta_Key} = $config->Meta_Value;
			}	
			
		}
		
	}

	public function insertAction() {

		$model = new Application_Model_DbTable_Configs();

		if ( isset($_POST['configs_btn']) && is_array($_POST['configs'])) {
			foreach($_POST['configs'] as $key => $value) {
				$model->insert(array('meta_key' => $key, 'meta_value' => $value));
			}
		}

		$this->_redirect('/admin/configs');
	}
}