<?php

class Application_Form_Curso extends Zend_Form
{

    public function init()
    {
    	
        $nome = new Zend_Form_Element_Text('Nome');
        $nome->setLabel('Nome do Curso:* ')
        	 ->addValidator('regex', false, array('/[a-z]/'))
        	 ->setRequired(true)
        	 ->setDecorators(array(
			 	'ViewHelper',
    		  	'Label',
			   	'Errors',
			 	array('HtmlTag', array('tag'=>'p')),
			 ));
        	 
        	 
        $tempo = new Zend_Form_Element_Text('Duracao');
        $tempo->setLabel('Duração do Curso:* ')
        	  ->addValidator('regex', false, array('/[a-z]/'))
        	  ->setRequired(true)
        	  ->setDecorators(array(
			 	'ViewHelper',
    		  	'Label',
			   	'Errors',
			 	array('HtmlTag', array('tag'=>'p')),
			 ));
        	  
        	  
        $desc = new Zend_Form_Element_Text('Descricao');
        $desc->setLabel('Descrição do Curso:* ')
        	 ->addValidator('regex', false, array('/[a-z]/'))
        	 ->setRequired(true)->setDecorators(array(
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
        
        
        $this->addElements(array($nome,$tempo,$desc,$submit,$botao));
		
        
        $this->addElement('hidden','Status',
         	array(
        		'value' => 'ativo'
        	)
        );
    }
}