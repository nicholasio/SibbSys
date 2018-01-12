<?php

class Application_Form_Arquivo extends Zend_Form{

	
	public function init(){
	
		$nome = new Zend_Form_Element_Text('Nome');
		$nome->setLabel('Nome: ')
			 ->addValidator('regex', false, array('/[a-z]/'))
			 ->addValidator('regex', false, array('/[A-Z]/'))
			 ->setRequired(true);
		
		
		$ano = new Zend_Form_Element_Text('Ano');
		$ano->setLabel('Ano: ')
			->addValidator('digits')
			->setAttrib('class', 'input-small')
			->setRequired(true);
			
			
		$semestre = new Zend_Form_Element_Select('Semestre');
			$lista = array(
				'' 	=>	'',
				1	=>	'1',
				2	=>	'2'
			);
		$semestre->setLabel('Semestre: ')
				 ->addMultiOptions($lista)
				 ->setRequired(true)
				 ->setAttrib('class', 'input-small')
				 ->addValidator('NotEmpty', true);
		
				 
		$data = new Zend_Form_Element_Text('Data');
		$data->setLabel('Data: ')
			 ->setRequired(true)
			 ->setAttrib('class', 'input-small')
			 ->setValue(date('d/m/Y'));
			 
			 
		$file = new Zend_Form_Element_File('Arquivo');
		$file->setLabel('Insira um Arquivo: ')
			 ->setDestination(APPLICATION_PATH . '/../public/arquivos/')
			 ->addValidator('Count', false, 1)
			 ->addValidator('Size', false, '100MB')
			 ->addValidator('Extension', true, 'jpg,png,docx,doc,pdf,odt,ods,ppt,pptx,xls,xlsx');
			 
			 
		$status = new Zend_Form_Element_Select('Status');
			$list = array(
				''			=>	'',
				'ativo'		=>	'Sim',
				'inativo'	=>	'Não',
			);
		$status->setLabel('Compartilhar: ')
			   ->addMultiOptions($list)
			   ->setRequired(true)
			   ->setAttrib('class', 'input-small')
			   ->addValidator('NotEmpty', true);
			   
			   
		$submit = new Zend_Form_Element_Submit('Inserir', array('class'=>'btn btn-success'));
			 
		$this->addElements(array(
			$nome, $ano, $semestre, $data, $status
		));
		
		$this->setElementDecorators(array(
			'Errors',
			'ViewHelper',
			'Label'
		));
		
		$this->addElements(array($file));
		
		$this->addElements(array($submit));
	}
}