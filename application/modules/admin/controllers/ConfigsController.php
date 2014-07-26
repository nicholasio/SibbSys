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
		
		
		
	}
}