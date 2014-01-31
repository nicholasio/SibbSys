<?php 

class Application_Form_AlterarCredito extends Zend_Form{
	
	
	public function init(){
		
		$valor = new Zend_Form_Element_Text('ValorCred');
		$valor->setLabel('Valor do Crédito: ')
			  ->setRequired(true)
			  ->setDecorators(array(
			  		'Errors',
			  		'ViewHelper',
			  		'Label'
			  ));
			  
		$submit = new Zend_Form_Element_Submit('Atualizar', array('class'=>'btn btn-success'));
		
		$this->addElements(array(
			$valor, $submit
		));
		
	}
}