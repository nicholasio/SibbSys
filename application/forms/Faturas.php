<?php

class Application_Form_Faturas extends Zend_Form{
	
	public function init(){
		
		$mes = new Zend_Form_Element_Select('mes');
		$lista = array(
				''	=>	'',
				1	=>	'Janeiro',
				2	=>	'Fevereiro',
				3	=>	'Março',
				4	=>	'Abril',
				5	=>	'Maio',
				6	=>	'Junho',
				7	=>	'Julho',
				8	=>	'Agosto',
				9	=>	'Setembro',
				10	=>	'Outubro',
				11	=>	'Novembro',
				12	=>	'Dezembro'
		);
		
		$mes->setLabel('Mês: ')
		->addMultiOptions($lista)
		->setRequired(true)
		->addValidator('NotEmpty', true);
		
		
		$desconto = new Zend_Form_Element_Text('desconto');
		$desconto->setLabel('Desconto: ')
		->setRequired(true);
		
		
		$ano = new Zend_Form_Element_Text('ano');
		$ano->setLabel('Ano: ');
		
		
		$valor = new Zend_Form_Element_Text('valorFatura');
		$valor->setLabel('Valor: ')
			  ->addValidator('regex', true, array('/[.]/'));
		
		
		$submit = new Zend_Form_Element_Submit('Inserir');
		
		$this->addElements(array
			(
				$mes, $ano, $valor, $desconto, $submit
			)
		);
	}
}