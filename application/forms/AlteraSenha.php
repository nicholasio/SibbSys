<?php

class Application_Form_AlteraSenha extends Zend_Form{

	public function init(){
	
		$senha = new Zend_Form_Element_Password('Senha');
		$senha->setLabel('Senha: ')
			  ->addValidator('StringLength', false, array('min' => 6))
			  ->setRequired(true);
			  
		$confsenha = new Zend_Form_Element_Password('ConfirmaSenha');
		$confsenha->setLabel('Confirmar Senha: ')
				  ->setRequired(true)
				  ->addValidator('Identical', false, array('token' => 'Senha'))
				  ->addErrorMessage('Senhas não combinam');

		$submit = new Zend_Form_Element_Submit('Atualizar');
	
			  
		$this->addElements(array(
			$senha,$confsenha,$submit
		));
		
	}
}