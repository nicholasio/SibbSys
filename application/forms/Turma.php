<?php

class Application_Form_Turma extends Zend_Form{

    public function init(){
        $this->setMethod("post");
        
    	$nome = new Zend_Form_Element_Text('Nome');
    	$nome->setLabel('Nome da Turma:* ')
    		 ->addValidator('regex', false, array('/[a-z]/'))
    		 ->setAttrib('placeholder', 'Nome da Turma')
    		 ->setRequired(true);

    		 
    	$desc = new Zend_Form_Element_Textarea('Descricao');
    	$desc->setLabel('Descrição da Turma:')
    		 ->setAttrib('rows','3')
    		 ->setAttrib('placeholder', 'Observações')
    		 ->addValidator('regex', false, array('/[a-z]/'));
		
		$ano = new Zend_Form_Element_Text('Ano');
		$ano->setLabel('Ano:* ')
			->addValidator('digits')
			->setAttrib('placeholder', 'Ano')
			->setAttrib('class', 'input-small')
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
				 ->setAttrib('class', 'input-small')
				 ->setAttrib('placeholder', 'Semestre')
				 ->addValidator('NotEmpty', true);

		
		$disc = new Zend_Form_Element_Select('Disciplina_idDisciplina');
		$disc->setLabel('Disciplina:* ')
			 ->setAttrib('data-provider', 'typeahead')
			 ->setAttrib('placeholder', 'Disciplina')
			 ->addMultiOption('','')
			 ->setAttrib('id', 'disciplina');
		
		$model = new Application_Model_DbTable_Disciplina();
		$list = $model->listar();
		foreach($list as $l){
			$disc->addMultiOption($l->idDisciplina, $l->Disciplina);
		}
		
		
		$prof = new Zend_Form_Element_Select('idUsuario');
		$prof->setLabel('Professor: ')
			 ->setAttrib('data-provider', 'typeahead')
			 ->setAttrib('placeholder', 'Professor')
			 ->setAttrib('id', 'professor');
		
		$user = new Application_Model_DbTable_Usuario();
		$rows = $user->findForSelect();
		
		foreach($rows as $p){
			$prof->addMultiOption($p->idUsuario, $p->Nome);
		}
		
		
		$submit = new Zend_Form_Element_Submit('Cadastrar', array('class' => 'btn btn-success'));

		$this->addElements(
			array(
				$nome,$ano,$semestre,$disc,$prof,$desc
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