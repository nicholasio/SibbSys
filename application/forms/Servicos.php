<?php

class Application_Form_Servicos extends Zend_Form{
	
	public function init(){
		
		$nome = new Zend_Form_Element_Text('nome');
		$nome->setLabel('Nome: ')
			 ->setAttrib('placeholder', 'Nome do Serviço')
			 ->addValidator('regex', false, array('/[a-z]/'));
		
		
		$desc = new Zend_Form_Element_Text('descricao');
		$desc->setLabel('Descrição: ')
			 ->setAttrib('placeholder', 'Descrição / Observação do Serviço')
			 ->addValidator('regex', false, array('/[a-z]/'));
		
		
		$valor = new Zend_Form_Element_Text('valor');
		$valor->setLabel('Valor: ')
			  ->setAttrib('placeholder', 'Valor do Serviço')
			  ->addValidator('regex', true, array('/[.]/'));
		
		
		$submit = new Zend_Form_Element_Submit('Cadastrar', array('class' => 'btn btn-success'));
		
		$this->addElements(array(
			$nome, $desc, $valor
		));
		
		$this->setElementDecorators(array(
       	 	'Errors',
         	'ViewHelper',
        	'Label',
       	));
		
		$this->addElements(array($submit));
	}
}