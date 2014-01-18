<?php

class Application_Form_Login extends Zend_Form{

    public function init(){    	
		
    	$this->addElement('text','login', array(
    		'label'		=>	'Login',
    		'required'	=>	true,
    		'filters' 	=>	array('StringTrim'),
        ));
    	
    	$this->addElement('password','senha',array(
    		'label'		=>	'Senha',
    		'required'	=>	true,
    		'filters'	=>	array('StringTrim'),
    	));
    	
    	$this->addElement('submit', 'entrar', array('label' => 'Entrar','class' => "btn btn-primary"));
    	
    	
    	$this->setMethod('post');
    }
}