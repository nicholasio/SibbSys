<?php
class Application_Form_Pesquisar extends Zend_Form{


	public function init(){
		
		$nome = new Zend_Form_Element_Text('Usuario');
		$nome->addValidator('regex', false, array('/[a-z]/'))
			 ->setDecorators(array(
			 	'ViewHelper',
			 	'Errors',
			 	array('HtmlTag', array('tag'=>'span'))
			 ));
		
		
		$submit = new Zend_Form_Element_Submit('Buscar');
		$submit->setDecorators(array(
			'ViewHelper',
			'Errors',
			array('HtmlTag', array('tag'=>'span'))
		));
		
		$this->addElements(array($nome, $submit));

	}
}