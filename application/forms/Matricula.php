<?php

class Application_Form_Matricula extends Zend_Form{

    public function init(){
    	
    	$usuario = new Zend_Form_Element_Select('Usuario_idUsuario');
    	$usuario->setLabel('Usuario: ')->setRequired(true)
    			->addMultiOption('','');
    			
    	$model = new Application_Model_DbTable_Usuario();
    	foreach($model->fetchAll() as $user){
    		$usuario->addMultiOption($user->idUsuario, $user->Nome);
    	}
    	
    	
    	$turma = new Zend_Form_Element_Select('Turma_idTurma');
    	$turma->setLabel('Turma: ')
    		  ->setRequired(true)
    		  ->addMultiOption('','');
    	
    	$model = new Application_Model_DbTable_Turma();
    	$result = $model->listar();
    	foreach($result as $class){
    		$turma->addMultiOption($class->idTurma, $class->Nome);
    	}

    	
		$submit = new Zend_Form_Element_Submit('Matricular', array('class'=>'btn btn-primary'));
		
		
		$this->addElements(array(
			$usuario,$turma
		));
		
		$this->setElementDecorators(array(
			'Errors',
			'ViewHelper',
			'Label',
		));
		
		$this->addElements(array($submit));
		
		$this->addElement('hidden','Status',
			array(
				'value' => 'Cursando'
		));		
    }
}