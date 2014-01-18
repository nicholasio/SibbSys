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
			  ->addValidator('regex', true, array('/[.]/'));
		
		$submit = new Zend_Form_Element_Submit('Inserir');
		
		$this->addElements(array ($serv,$valor,$submit));
	} 
}