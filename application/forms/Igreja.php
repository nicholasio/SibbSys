<?php

class Application_Form_Igreja extends Zend_Form{

	public function init(){
		
		
		$nome = new Zend_Form_Element_Text('Igreja');
        $nome->setLabel('Igreja:* ')
        	 ->addValidator('regex', false, array('/[a-z]/'))
        	 ->setRequired(true);

        	 
       	$end = new Zend_Form_Element_Text('Endereco');
       	$end->setLabel('Endereço:* ')
       		->addValidator('regex', false, array('/[a-z]/'))
       		->setRequired(true);
       	    
       		
       	$bairro = new Zend_Form_Element_Text('Bairro');
       	$bairro->setLabel('Bairro:* ')
       		   ->addValidator('regex', false, array('/[a-z]/'))
       		   ->setRequired(true);
       	
       		   
		$cep = new Zend_Form_Element_Text('CEP');
		$cep->setLabel('CEP: ')
			->addValidator('StringLength', false, array('min' => 10, 'max' => 10))
       		->addErrorMessage('Entre com um CEP válido! Ex.(00.000-000)');
			
		
			
       	$pastor = new Zend_Form_Element_Text('Pastor');
       	$pastor->setLabel('Pastor:* ')
       		   ->addValidator('regex', false, array('/[a-z]/'))
       		   ->setRequired(true);
       	
       		   
		$fone = new Zend_Form_Element_Text('Telefone');
		$fone->setLabel('Telefone: ')
			 ->addValidator('StringLength', false, array('min' => 12, 'max' => 12))
       		 ->addErrorMessage('Entre com um número válido! Ex.(00 0000-0000)');
			 
		
			 
        $submit = new Zend_Form_Element_Submit('Cadastrar');
        $botao = new Zend_Form_Element_Submit('Voltar');

        
        $this->addElements(
        	array(
        		$nome,$end,$bairro,$cep,$fone,$pastor,$submit,$botao
        		)
        );
        		
        		
        $this->addElement('hidden','Status',
        		array(
        			'value' => 'ativo'
        		)
        	);
	}
	
}