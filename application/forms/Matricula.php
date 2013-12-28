<?php

class Application_Form_Matricula extends Zend_Form{

    public function init(){
    	
    	$usuario = new Zend_Form_Element_Select('Usuario_idUsuario');
    	$usuario->setLabel('Usuario: ')->setRequired(true)
    			->addMultiOption('','')
    			->setDecorators(array(
			 	'ViewHelper',
    		  	'Label',
			   	'Errors',
			 	array('HtmlTag', array('tag'=>'p')),
			 ));
    			
    	$model = new Application_Model_DbTable_Usuario();
    	foreach($model->fetchAll() as $user){
    		$usuario->addMultiOption($user->idUsuario, $user->Nome);
    	}
    	
    	
    	$turma = new Zend_Form_Element_Select('Turma_idTurma');
    	$turma->setLabel('Turma: ')
    		  ->setRequired(true)
    		  ->addMultiOption('','')
    		  ->setDecorators(array(
			 	'ViewHelper',
    		  	'Label',
			   	'Errors',
			 	array('HtmlTag', array('tag'=>'p')),
			 ));
    	
    	$model = new Application_Model_DbTable_Turma();
    	$result = $model->listar();
    	foreach($result as $class){
    		$turma->addMultiOption($class->idTurma, $class->Nome);
    	}

    	
		$submit = new Zend_Form_Element_Submit('Submit');
		$submit->setLabel('Matricular')
				->setDecorators(array(
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
		
		$this->addElements(
			array(
				$usuario,$turma,$submit,$botao
			)
		);
		
		$this->addElement('hidden','Status',
				array(
					'value' => 'Cursando'
				)
		);
		
    }
}

