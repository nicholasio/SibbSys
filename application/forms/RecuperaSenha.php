<?php

class Application_Form_RecuperaSenha extends Zend_Form{

	public function init(){
	
		$email = new Zend_Form_Element_Text('email');
		$email->setLabel('Email: ')
			  ->setRequired(true);
			  
		$submit = new Zend_Form_Element_Submit('Recuperar');
		
		$this->addElements(array(
			$email,$submit
		));
	}
	
}