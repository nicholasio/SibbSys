<?php

class Application_Form_Curso extends Zend_Form
{

    public function init()
    {
    	
        $nome = new Zend_Form_Element_Text('Nome');
        $nome->setLabel('Nome do Curso:* ')
        	 ->addValidator('regex', false, array('/[a-z]/'))
        	 ->setRequired(true);
        	 
        	 
        $tempo = new Zend_Form_Element_Text('Duracao');
        $tempo->setLabel('Duração do Curso:* ')
        	  ->addValidator('regex', false, array('/[a-z]/'))
        	  ->setRequired(true);
        	  
        	  
        $desc = new Zend_Form_Element_Text('Descricao');
        $desc->setLabel('Descrição do Curso:* ')
        	 ->addValidator('regex', false, array('/[a-z]/'))
        	 ->setRequired(true);
        	 
        
        $submit = new Zend_Form_Element_Submit('Cadastrar', array('class' => 'btn btn-success'));
        
        
        $this->addElements(array($nome,$tempo,$desc));
		
        
        $this->setElementDecorators(array(
        	'Errors',
        	'ViewHelper',
        	'Label',
        ));
        
        $this->addElements(array($submit));
        
        $this->addElement('hidden','Status',
         	array(
        		'value' => 'ativo'
        	)
        );
    }
}