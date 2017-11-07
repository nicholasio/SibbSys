<?php
class Application_Form_Foto extends Zend_Form{
	
	public function init(){
		
		$foto = new Zend_Form_Element_File('Foto');
		$foto->setDestination('files/')
		->setRequired(true)
		->addValidator('Count', false, 1)
		->addValidator('Size', false, '15MB')
		->addValidator('Extension', false, 'jpg,png,gif');
		
		
		$submit = new Zend_Form_Element_Submit('Atualizar', array('class' => 'btn btn-success'));
        $submit->setDecorators(array(
        			'Errors',
        			'ViewHelper',
        			array('HtmlTag', array('class'=>'btn-submit'))
        		));
        
        $this->addElements(array($foto, $submit));
	}
	
}
