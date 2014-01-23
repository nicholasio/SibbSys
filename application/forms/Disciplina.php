<?php

class Application_Form_Disciplina extends Zend_Form{

	
	public function init(){
		
		$nome = new Zend_Form_Element_Text('Disciplina');
        $nome->setLabel('Disciplina:* ')
        	 ->addValidator('regex', false, array('/[a-z]/'))
        	 ->setRequired(true);

        	 
       	$qtd = new Zend_Form_Element_Text('QntdCred');
       	$qtd->setLabel('Crédito:* ')
       		->addValidator('digits')
       	    ->setRequired(true);
       	    
       	    
       	$valor = new Zend_Form_Element_Text('ValorCred');
       	$valor->setLabel('Valor do Crédito:* ')
       		  ->addValidator('regex', true, array('/[.]/'))
       	      ->setRequired(true);
       	
       	      
        $submit = new Zend_Form_Element_Submit('Cadastrar', array('class' => 'btn btn-success'));
        
        
        $this->addElements(
        	array(
        		$nome,$qtd,$valor
        	));
        
        $this->setElementDecorators(array(
       		'Errors',
        	'ViewHelper',
    		'Label',
     	));
        
        $this->addElements(array($submit));
        
        $this->addElement('hidden','Status',
        	array(
        		'value' => 'ativo'
        	));
	}
}