<?php

class Application_Form_Igreja extends Zend_Form{

	public function init(){
		
		
		$nome = new Zend_Form_Element_Text('Igreja');
        $nome->setLabel('Igreja:* ')
        	 ->addValidator('regex', false, array('/[a-z]/'))
        	 ->setAttrib('placeholder', 'Insira o nome da Igreja')
        	 ->setRequired(true);
        	 

       	$end = new Zend_Form_Element_Text('Endereco');
       	$end->setLabel('Endereço:* ')
       		->addValidator('regex', false, array('/[a-z]/'))
       		->setAttrib('placeholder', 'Endereco com número')
       		->setRequired(true);
       		
       	    
       	$bairro = new Zend_Form_Element_Text('Bairro');
       	$bairro->setLabel('Bairro:* ')
       		   ->addValidator('regex', false, array('/[a-z]/'))
       		   ->setAttrib('placeholder', 'Bairro')
       		   ->setRequired(true);
       	
       		   
		$cep = new Zend_Form_Element_Text('CEP');
		$cep->setLabel('CEP: ')
			->addValidator('StringLength', false, array('min' => 10, 'max' => 10))
			->setAttrib('placeholder', 'Ex.: 00.000-000')
       		->addErrorMessage('Entre com um CEP válido!');
			
		
       	$pastor = new Zend_Form_Element_Text('Pastor');
       	$pastor->setLabel('Pastor:* ')
       		   ->addValidator('regex', false, array('/[a-z]/'))
       		   ->setAttrib('placeholder', 'Pastor')
       		   ->setRequired(true);
       	
       		   
		$fone = new Zend_Form_Element_Text('Telefone');
		$fone->setLabel('Telefone: ')
			 ->addValidator('StringLength', false, array('min' => 12, 'max' => 12))
			 ->setAttrib('placeholder', 'Ex.: 00 0000-0000')
       		 ->addErrorMessage('Entre com um número válido!');
			 
			 
        $submit = new Zend_Form_Element_Submit('Cadastrar', array('class' => 'btn btn-success'));
        
        
        $this->addElements(
        	array(
        		$nome,$end,$bairro,$cep,$fone,$pastor
        	));
        		
        $this->setElementDecorators(array(
        	'Errors',
        	'Label',
        	'ViewHelper',
        ));
        		
        $this->addElements(array($submit));
        
        $this->addElement('hidden','Status',
        	array(
        		'value' => 'ativo'
        	));
	}
}