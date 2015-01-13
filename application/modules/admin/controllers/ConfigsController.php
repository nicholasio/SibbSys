<?php 

class Admin_ConfigsController extends AppBaseController{
	
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
				if ( $model->findKey($key) )
					$model->update(array('Meta_Value' => $value), $model->getAdapter()->quoteInto('Meta_Key = ?', $key) );
				else
					$model->insert(array('Meta_Key' => $key, 'Meta_Value' => $value));
			}
		}

		$this->_redirect('/admin/configs');
	}
}