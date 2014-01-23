<?php

class Application_Form_ArquivoEdit extends Zend_Form{

	public function init(){
	
		$nome = new Zend_Form_Element_Text('Nome');
		$nome->setLabel('Nome: ')
			 ->addValidator('regex', false, array('/[a-z]/'))
			 ->setRequired(true);
			 
		
		$ano = new Zend_Form_Element_Text('Ano');
		$ano->setLabel('Ano: ')
			->addValidator('digits')
			->setRequired(true);

		
		$semestre = new Zend_Form_Element_Select('Semestre');
			$lista = array(
				'' 	=>	'',
				1	=>	'1',
				2	=>	'2'
			);
		$semestre->setLabel('Semestre: ')
				 ->addMultiOptions($lista)
				 ->setRequired(true)
				 ->addValidator('NotEmpty', true);

		
		$status = new Zend_Form_Element_Select('Status');
			$list = array(
				''			=>	'',
				'ativo'		=>	'Sim',
				'inativo'	=>	'Não',
			);
		$status->setLabel('Compartilhar: ')
			   ->addMultiOptions($list)
			   ->setRequired(true)
			   ->addValidator('NotEmpty', true);

		
		$submit = new Zend_Form_Element_Submit('Enviar', array('class'=>'btn btn-success'));
			 
		$this->addElements(array
		(
			$nome, $ano, $semestre, $status
		));
		
		$this->setElementDecorators(array(
				'Errors',
				'ViewHelper',
				'Label',
		));
		
		$this->addElements(array($submit));
	}
}