<?php

class Application_Form_Curso extends Zend_Form
{

    public function init()
    {
    	
        $nome = new Zend_Form_Element_Text('Nome');
        $nome->setLabel('Nome do Curso:* ')
        	 ->addValidator('regex', false, array('/[a-z]/'))
        	 ->setAttrib('placeholder', 'Nome do Curso')
        	 ->setRequired(true);
        	 
        	 
        $tempo = new Zend_Form_Element_Text('Duracao');
        $tempo->setLabel('Duração do Curso:* ')
        	  ->addValidator('regex', false, array('/[a-z]/'))
        	  ->setAttrib('placeholder', 'Duração do Curso')
        	  ->setRequired(true);
        	  
        	  
        $desc = new Zend_Form_Element_Textarea('Descricao');
        $desc->setLabel('Descrição do Curso:* ')
        	 ->setAttrib('rows', '3')
        	 ->setAttrib('placeholder', 'Descrição / Observação do Curso')
        	 ->addValidator('regex', false, array('/[a-z]/'));
        
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