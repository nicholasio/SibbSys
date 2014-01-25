<?php

class Application_Form_Login extends Zend_Form{

    public function init(){    	
		
    	$this->addElement('text','login', array(
    		'label'		=>	'Email',
    		'required'	=>	true,
    		'filters' 	=>	array('StringTrim'),
        ));
    	
    	$this->addElement('password','senha',array(
    		'label'		=>	'Senha',
    		'required'	=>	true,
    		'filters'	=>	array('StringTrim'),
    	));
    	
    	$this->setElementDecorators(array(
    		'Errors',
    		'ViewHelper',
    		'Label',
    	));
    	
    	$submit = new Zend_Form_Element_Submit('Entrar', array('class'=>'btn btn-primary'));
    	
    	$this->addElements(array($submit));
    	
    	$this->setMethod('post');
    }
}