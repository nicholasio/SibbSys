<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap{
	
	protected function _initAutoLoader(){
		
		$autoloader = Zend_Loader_Autoloader::getInstance();
		$autoloader->registerNamespace("SIBB");
		return $autoloader;
		
	}
	
	
  	protected function _initConfig(){

    	$config = new Zend_Config($this->getOptions());
    	Zend_Registry::set('config', $config);
	
  	}
		
	protected function _initViews(){
		$this->bootstrap("view");
		$view = $this->getResource("view");

		$view->doctype('XHTML1_TRANSITIONAL');
		Zend_Registry::set('view', $view);
		
		$view->headTitle('Seminario Bereiano')->setSeparator(' - ');
		$view->headMeta()->appendHttpEquiv('Content-type', 'text/html;charset=utf-8');
		$view->headLink()->appendStylesheet($view->baseUrl() . '/css/style.css');
	}
	
	protected function _initPlugins(){
		
		$bootstrap = $this->getApplication();
		if($bootstrap instanceof Zend_Application){
			$bootstrap = $this;
		}
		
		$bootstrap->bootstrap('FrontController');
		$front = $bootstrap->getResource('FrontController');
		$front->registerPlugin(new SIBB_Plugins_Layout());
		$front->registerPlugin(new SIBB_Plugins_Acl());
		
	}
	
	
	protected function _initEmal(){
	
		$emailConfig = array(
			'auth'		=>	'login',
			'username' 	=> 	Zend_Registry::get('config')->email->username,
			'password' 	=> 	Zend_Registry::get('config')->email->password,
			'ssl'		=> 	Zend_Registry::get('config')->email->protocol,
			'port'		=> 	Zend_Registry::get('config')->email->port
		);
		
		$mailTransport = new Zend_Mail_Transport_Smtp(
			Zend_Registry::get('config')->email->server, $emailConfig);
			
		Zend_Mail::setDefaultTransport($mailTransport);
	}
		
}