<?php

class Application_Form_Turma extends Zend_Form{

    public function init(){
        $this->setMethod("post");
        
    	$nome = new Zend_Form_Element_Text('Nome');
    	$nome->setLabel('Nome da Turma:* ')
    		 ->addValidator('regex', false, array('/[a-z]/'))
    		 ->setRequired(true);

    		 
    	$desc = new Zend_Form_Element_Textarea('Descricao');
    	$desc->setLabel('Descrição da Turma:')
    		 ->setAttrib('rows','3')
    		 ->addValidator('regex', false, array('/[a-z]/'));
		
		$ano = new Zend_Form_Element_Text('Ano');
		$ano->setLabel('Ano:* ')
			->addValidator('digits')
			->setRequired(true);
			
			
		$semestre = new Zend_Form_Element_Select('Semestre');
			$lista = array(
				''	=>	'',
				1	=>	'1',
				2	=>	'2'
			);
		$semestre->setLabel('Semestre: ')
				 ->addMultiOptions($lista)
				 ->setRequired(true)
				 ->addValidator('NotEmpty', true);

				 
		$disc = new Zend_Form_Element_Text('Disciplina_idDisciplina');
		$disc->setLabel('Disciplina:* ')
			 ->setDecorators(array(
			 	'ViewHelper',
			 	array('HtmlTag', 'class'=>'turma')
			 ));
			 
			
		
		$prof = new Zend_Form_Element_Select('idUsuario');
		$prof->setLabel('Professor: ')
			 ->addMultiOption('','');
		
		$user = new Application_Model_DbTable_Usuario();
		$rows = $user->findForSelect();
		
		foreach($rows as $p){
			$prof->addMultiOption($p->idUsuario, $p->Nome);
		}
		
		
		$submit = new Zend_Form_Element_Submit('Cadastrar', array('class' => 'btn btn-success'));

		$this->addElements(
			array(
				$nome,$desc,$ano,$semestre,$disc,$prof
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