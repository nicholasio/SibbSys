<?php

class Application_Form_Pagamento extends Zend_Form{
	
	public function init(){
		
		$valor = new Zend_Form_Element_Text('valorPagamento');
		$valor->setLabel('Valor: ')
			  ->addValidator('regex', true, array('/[.]/'));
		
		$data = new Zend_Form_Element_Text('dataPagamento');
		$data->setLabel('Data do Pagamento: ')
			 ->setAttrib('size', 10)
			 ->addErrorMessage('Insira o formato correto. Ex: DD/MM/AAAA');
		
		$submit = new Zend_Form_Element_Submit('Inserir');
		
		$this->addElements(array
			(
				$valor, $data, $submit
			)
		);
	}
}