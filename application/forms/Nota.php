<?php

class Application_Form_Nota extends Zend_Form{
	
	public function init(){
		
		$unit1 = new Zend_Form_Element_Text('Unit1');
		$unit1->setLabel('Unidade 1')
			  ->setRequired(true);
		
		$unit2 = new Zend_Form_Element_Text('Unit2');
		$unit2->setLabel('Unidade 2');
		
		$unit3 = new Zend_Form_Element_Text('Unit3');
		$unit3->setLabel('Unidade 3');
		
		$submit = new Zend_Form_Element_Submit('Inserir', array('class' => 'btn btn-primary'));
		
		$this->addElements(array(
			$unit1, $unit2, $unit3, $submit
		));
	}
}