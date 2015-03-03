<?php

class Application_Form_UsuarioServico extends Zend_Form{
	
	public function init(){
		
		$serv = new Zend_Form_Element_Select('Servicos_idServicos');
		$serv->setLabel('Serviços: ')->addMultiOption('','');
		
		$servTable = new Application_Model_DbTable_Servicos;
		foreach($servTable->fetchAll() as $s){
			$serv->addMultiOption($s->idServicos, $s->nome)
				 ->setRequired(true)
				 ->addValidator('NotEmpty', true);
		}
		
		
		$valor = new Zend_Form_Element_Text('valor');
		$valor->setLabel('Valor: ')
			  ->setAttrib('placeholder', 'Valor do Serviço')
			  ->addValidator('regex', true, array('/^[+-]?((\d+|\d{1,3}(\,\d{3})+)(\.\d*)?|\.\d+)$/'));
			  //->addValidator('regex', true, array('/^(-).?[0-9]+$/'));
		
		
		$submit = new Zend_Form_Element_Submit('Inserir', array('class' => 'btn btn-success'));
		
		
		$this->addElements(array ($serv,$valor));
		
		$this->setElementDecorators(array(
        	'Errors',
        	'ViewHelper',
        	'Label',
		));
		
		$this->addElements(array($submit));
	} 
}