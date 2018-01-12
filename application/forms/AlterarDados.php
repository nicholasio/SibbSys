<?php

class Application_Form_AlterarDados extends Zend_Form{
	
	
	public function init(){
		
		$nome = new Zend_Form_Element_Text('Nome');
		$nome->setLabel('Nome:* ')
			 ->addValidator('regex', false, array('/[a-z]/'))
			 ->setRequired(true)
			 ->setDecorators(array(
				'Errors',
				'Label',
				'ViewHelper',
				array('HtmlTag', array('class'=>'right'))
			));
		
		
		$end = new Zend_Form_Element_Text('Endereco');
		$end->setLabel('Endereço:* ')
			->addValidator('regex', false, array('/[a-z]/'))
			->setRequired(true)
			->setDecorators(array(
				'Errors',
				'Label',
				'ViewHelper',
				array('HtmlTag', array('class'=>'right'))
			));
		
		 
		$bairro = new Zend_Form_Element_Text('Bairro');
		$bairro->setLabel('Bairro:* ')
			   ->addValidator('regex', false, array('/[a-z]/'))
			   ->setRequired(true)
			   ->setDecorators(array(
				'Errors',
				'Label',
				'ViewHelper',
				array('HtmlTag', array('class'=>'right'))
			));
		
		
		$cep = new Zend_Form_Element_Text('CEP');
		$cep->setLabel('CEP: ')
			->addValidator('StringLength', false, array('min' => 10, 'max' => 10))
			->addErrorMessage('Entre com um CEP válido! Ex.(00.000-000)')
			->setDecorators(array(
				'Errors',
				'Label',
				'ViewHelper',
				array('HtmlTag', array('class'=>'right'))
			));
		 
		 
		$tel = new Zend_Form_Element_Text('Telefone');
		$tel->setLabel('Telefone:* ')
			->addValidator('StringLength', false, array('min' => 12, 'max' => 12))
			->addErrorMessage('Insira um número válido! Ex.(00 0000-0000)')
			->setRequired(true)
			->setDecorators(array(
				'Errors',
				'Label',
				'ViewHelper',
				array('HtmlTag', array('class'=>'right'))
			));
		 
		 
		$cel = new Zend_Form_Element_Text('Celular');
		$cel->setLabel('Celular: ')
			->addValidator('StringLength', false, array('min' => 12, 'max' => 12))
			->addErrorMessage('Insira um número válido! Ex.(00 0000-0000)')
			->setDecorators(array(
				'Errors',
				'Label',
				'ViewHelper',
				array('HtmlTag', array('class'=>'right'))
			));
		
		
		 
		$cpf = new Zend_Form_Element_Text('CPF');
		$cpf->setLabel('CPF:* ')
			->addValidator('StringLength', false, array('min' => 14, 'max' => 14))
			->setRequired(true)
			->addErrorMessage('Entre com um CPF válido! Ex.(000.000.000-00)')
			->setDecorators(array(
				'Errors',
				'Label',
				'ViewHelper',
				array('HtmlTag', array('class'=>'right'))
			));
		 
		 
		$nasc = new Zend_Form_Element_Text('DataNascimento');
		$nasc->setLabel('Data de Nacimento (dd/mm/aaaa):* ')
			 ->setAttrib('size', 10)
			 ->setRequired(true)
			 ->addErrorMessage('Entre com o formato da data correto. Ex. 00/00/0000')
			 ->setDecorators(array(
				'Errors',
				'Label',
				'ViewHelper',
				array('HtmlTag', array('class'=>'right'))
			));
		
		
		$mae = new Zend_Form_Element_Text('NomeMae');
		$mae->setLabel('Nome da Mãe:* ')
			->addValidator('regex', false, array('/[a-z]/'))
			->setRequired(true)
			->setDecorators(array(
				'Errors',
				'Label',
				'ViewHelper',
				array('HtmlTag', array('class'=>'right'))
		));
		
		
		 
		$pai = new Zend_Form_Element_Text('NomePai');
		$pai->setLabel('Nome do Pai: ')
			->addValidator('regex', false, array('/[a-z]/'))
			->setDecorators(array(
				'Errors',
				'Label',
				'ViewHelper',
				array('HtmlTag', array('class'=>'right'))
		));
		
		 
		$igreja = new Zend_Form_Element_Select('Igreja_idIgreja');
		$igreja->setLabel('Igreja: ')
			   ->addMultiOption('','')
			   ->setRequired(true)
			   ->setDecorators(array(
				'Errors',
				'Label',
				'ViewHelper',
				array('HtmlTag', array('class'=>'right'))
		));
		
		$option = new Application_Model_DbTable_Igreja();
		foreach($option->fetchAll() as $i){
			$igreja->addMultiOption($i->idIgreja, $i->Igreja);
		}
		
		
		$email = new Zend_Form_Element_Text('Email');
		$email->setLabel('Email:* ')
			->addValidator('EmailAddress')
			->setAttrib('placeholder', 'Insira um E-mail válido')
			->addErrorMessage('Insira um endereço de email válido.')
			->setRequired(true)
			->setDecorators(array(
				'Errors',
				'Label',
				'ViewHelper',
				array('HtmlTag', array('class'=>'right'))
			));
		
		
		
		$submit = new Zend_Form_Element_Submit('Cadastrar', array('class' => 'btn btn-success'));
		$submit->setDecorators(array(
				'Errors',
				'ViewHelper',
				array('HtmlTag', array('class'=>'btn-alterar'))
			));
		
		$this->addElements(array(
				$nome,$end,$bairro,$cep,$tel,$cel,$nasc,
				$mae,$pai,$cpf,$igreja,$email,$submit
		));
		
		$this->addElement('hidden', 'Status',
				array(
						'value' => 'ativo'
				));
		
	}
}