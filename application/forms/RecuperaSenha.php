<?php

class Application_Form_RecuperaSenha extends Zend_Form{

	public function init(){
	
		$email = new Zend_Form_Element_Text('email');
		$email->setLabel('Email: ')
			  ->setRequired(true)
			  ->setDecorators(array(
			  	'Errors',
			  	'Label',
			  	'ViewHelper'
			  ));
			 
		$submit = new Zend_Form_Element_Submit('Recuperar', array('class'=>'btn btn-success'));
		
		$this->addElements(array(
			$email,$submit
		));
	}
}