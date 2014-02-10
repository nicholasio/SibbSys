<?php

class Application_Form_Disciplina extends Zend_Form{

	
	public function init(){
		
		$nome = new Zend_Form_Element_Text('Disciplina');
        $nome->setLabel('Disciplina:* ')
        	 ->addValidator('regex', false, array('/[a-z]/'))
        	 ->setRequired(true);

        	 
       	$qtd = new Zend_Form_Element_Text('QntdCred');
       	$qtd->setLabel('Crédito(s):* ')
       		->addValidator('digits')
       	    ->setRequired(true);
       	    
       	
        $submit = new Zend_Form_Element_Submit('Cadastrar', array('class' => 'btn btn-success'));
        
        
        $this->addElements(
        	array(
        		$nome,$qtd
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
        
        $model = new Application_Model_DbTable_Credito();
        $list = $model->listar();
        
        $this->addElement('hidden','Credito_idCredito',
        	array(
        		'value' => $list['idCredito']	
        ));
	}
}