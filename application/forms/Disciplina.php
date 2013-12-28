<?php

class Application_Form_Disciplina extends Zend_Form{

	
	public function init(){
	
		
		$nome = new Zend_Form_Element_Text('Disciplina');
        $nome->setLabel('Disciplina:* ')
        	 ->addValidator('regex', false, array('/[a-z]/'))
        	 ->setRequired(true)
        	 ->setDecorators(array(
			 	'ViewHelper',
    		  	'Label',
			   	'Errors',
			 	array('HtmlTag', array('tag'=>'p')),
			 ));

        	 
       	$qtd = new Zend_Form_Element_Text('QntdCred');
       	$qtd->setLabel('Crédito:* ')
       		->addValidator('digits')
       	    ->setRequired(true)
       	    ->setDecorators(array(
			 	'ViewHelper',
    		  	'Label',
			   	'Errors',
			 	array('HtmlTag', array('tag'=>'p')),
			 ));
       	    
       	    
       	$valor = new Zend_Form_Element_Text('ValorCred');
       	$valor->setLabel('Valor do Crédito:* ')
       		  ->addValidator('regex', true, array('/[.]/'))
       	      ->setRequired(true)
       	      ->setDecorators(array(
			 	'ViewHelper',
    		  	'Label',
			   	'Errors',
			 	array('HtmlTag', array('tag'=>'p')),
			 ));
       	
       	      
        $submit = new Zend_Form_Element_Submit('Cadastrar');
        $submit->setDecorators(array(
			 	'ViewHelper',
			   	'Errors',
			 	array('HtmlTag', array('tag'=>'span')),
			 ));
        
        $botao = new Zend_Form_Element_Submit('Voltar');
        $botao->setDecorators(array(
			 	'ViewHelper',
			   	'Errors',
			 	array('HtmlTag', array('tag'=>'span')),
			 ));
        
        
        $this->addElements(array
        	(
        		$nome,$qtd,$valor,$submit,$botao
        	)
        );
        
        
        $this->addElement('hidden','Status',
        	array(
        		'value' => 'ativo'
        	)
        );
        
	}
	
}