<?php

class Application_Form_Debitos extends Zend_Form{
	
	
	public function init(){
		
		$mes = new Zend_Form_Element_Select('mesPagamento');
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
		
		$desconto = new Zend_Form_Element_Text('descontoMes');
		$desconto->setLabel('Desconto: ')
				 ->setRequired(true);
		
		$ano = new Zend_Form_Element_Text('anoPagamento');
		$ano->setLabel('Ano: ');
		
		$submit = new Zend_Form_Element_Submit('Cadastrar', array('class'=>'btn btn-success'));
		
		$this->addElements(array(
			$mes, $ano, $desconto,
		));
		
		$this->setElementDecorators(array(
			'Errors',
			'Label',
			'ViewHelper'
		));
		
		$this->addElements(array($submit));
	}
}