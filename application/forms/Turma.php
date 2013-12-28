<?php

class Application_Form_Turma extends Zend_Form
{

    public function init(){
        
    	$nome = new Zend_Form_Element_Text('Nome');
    	$nome->setLabel('Nome da Turma:* ')
    		 ->addValidator('regex', false, array('/[a-z]/'))
    		 ->setRequired(true);

    		 
    	$desc = new Zend_Form_Element_Text('Descricao');
    	$desc->setLabel('Descrição da Turma:*')
    		 ->addValidator('regex', false, array('/[a-z]/'))
    		 ->setRequired(true);
		
		
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

				 
		$disc = new Zend_Form_Element_Select('Disciplina_idDisciplina');
		$disc->setLabel('Disciplina: ')
			 ->addMultiOption('','');

		$model = new Application_Model_DbTable_Disciplina();
		$rows = $model->findForSelect();
		
		foreach($rows as $d){
			$disc->addMultiOption($d->idDisciplina, $d->Disciplina);
		}

		
		$prof = new Zend_Form_Element_Select('Usuario_idUsuario');
		$prof->setLabel('Professor: ')
			 ->addMultiOption('','');
		
		$user = new Application_Model_DbTable_Usuario();
		$rows = $user->findForSelect();
		
		foreach($rows as $p){
			$prof->addMultiOption($p->idUsuario, $p->Nome);
		}
		
		
		$submit = new Zend_Form_Element_Submit('Cadastrar');
		$botao = new Zend_Form_Element_Submit('Voltar');

		$this->addElements(
			array(
				$nome,$desc,$ano,$semestre,$disc,$prof,$submit,$botao
			)
		);
		
		$this->addElement('hidden','Status',
				array(
					'value' => 'ativo'		
				)
		);
		
    }
}