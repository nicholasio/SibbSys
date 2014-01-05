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
				 ->addValidator('NotEmpty', true);
		
				 
		$data = new Zend_Form_Element_Text('Data');
		$data->setLabel('Data: ')
			 ->setRequired(true)
			 ->setValue(date('d/m/Y'));
			 
			 
		$file = new Zend_Form_Element_File('Arquivo');
		$file->setLabel('Insira um Arquivo: ')
			 ->setDestination(APPLICATION_PATH . '/../public/arquivos/')
			 ->addValidator('Count', false, 1)
			 ->addValidator('Size', false, '50MB')
			 ->addValidator('Extension', false, 'jpg,png,docx,doc,pdf,odt,ods,ppt,pptx');
			 
			 
		$status = new Zend_Form_Element_Select('Status');
			$list = array(
				''			=>	'',
				'ativo'		=>	'Sim',
				'inativo'	=>	'Não',
			);
		$status->setLabel('Compartilhar: ')
			   ->addMultiOptions($list)
			   ->setRequired(true)
			   ->addValidator('NotEmpty', true);
			   
			   
		$submit = new Zend_Form_Element_Submit('Enviar');
		$botao = new Zend_Form_Element_Submit('Voltar');
			 
		$this->addElements(array
		(
			$file, $nome, $ano, $semestre, $data, $status, $submit, $botao
		));
	}
}