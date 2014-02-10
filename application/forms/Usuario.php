<?php

class Application_Form_Usuario extends Zend_Form
{

    public function init(){
    	
        $nome = new Zend_Form_Element_Text('Nome');
        $nome->setLabel('Nome:* ')
        	 ->addValidator('regex', false, array('/[a-z]/'))
        	 ->setAttrib('placeholder', 'Nome: ')
        	 ->setDecorators(array(
        	 	'Errors',
        	 	'Label',
        		'ViewHelper',
        	 	array('HtmlTag', array('class'=>'right')),
        	 ))
        	 ->setRequired(true);
        	 

       	$end = new Zend_Form_Element_Text('Endereco');
       	$end->setLabel('Endereço:* ')
       		->setAttrib('placeholder', 'Insira o Endereço com o número')
       		->addValidator('regex', false, array('/[a-z]/'))
       		->setDecorators(array(
       				'Errors',
       				'Label',
       				'ViewHelper',
       				array('HtmlTag', array('class'=>'right'))
       		))
       		->setRequired(true);
       	
       		
       	$bairro = new Zend_Form_Element_Text('Bairro');
       	$bairro->setLabel('Bairro:* ')
       		   ->addValidator('regex', false, array('/[a-z]/'))
       		   ->setAttrib('placeholder', 'Bairro: ')
       		   ->setDecorators(array(
       		   		'Errors',
       		   		'Label',
       		   		'ViewHelper',
       		   		array('HtmlTag', array('class'=>'right'))
       		   ))
       		   ->setRequired(true);

       		   
       	$cep = new Zend_Form_Element_Text('CEP');
       	$cep->setLabel('CEP: ')
       		->addValidator('StringLength', false, array('min' => 10, 'max' => 10))
       		->setAttrib('placeholder', 'CEP (00.000-000)')
       		->setDecorators(array(
       				'Errors',
       				'Label',
       				'ViewHelper',
       				array('HtmlTag', array('class'=>'right'))
       		))
       		->addErrorMessage('Entre com um CEP válido!');
       		
       		
       	$tel = new Zend_Form_Element_Text('Telefone');
       	$tel->setLabel('Telefone:* ')
       		->addValidator('StringLength', false, array('min' => 12, 'max' => 12))
       		->setAttrib('placeholder', 'Ex: 00 0000-0000')
       		->addErrorMessage('Insira um número válido!')
       		->setDecorators(array(
       				'Errors',
       				'Label',
       				'ViewHelper',
       				array('HtmlTag', array('class'=>'right'))
       		))
       		->setRequired(true);
       		
       		
       	$cel = new Zend_Form_Element_Text('Celular');
       	$cel->setLabel('Celular: ')
       		->addValidator('StringLength', false, array('min' => 12, 'max' => 12))
       		->setAttrib('placeholder', 'Ex. 00 0000-0000')
       		->setDecorators(array(
       				'Errors',
       				'Label',
       				'ViewHelper',
       				array('HtmlTag', array('class'=>'right'))
       		))
       		->addErrorMessage('Entre com número válido!');
       		
       	
       	$nasc = new Zend_Form_Element_Text('DataNascimento');
       	$nasc->setLabel('Data de Nacimento:* ')
       		->setAttrib('size', 10)
       		->setAttrib('placeholder', 'DD/MM/AAAA')
       		->addErrorMessage('Insira o formato correto.')
       		->setDecorators(array(
       				'Errors',
       				'Label',
       				'ViewHelper',
       				array('HtmlTag', array('class'=>'right'))
       		))
       		->setRequired(true);
       	
       		
       	$cpf = new Zend_Form_Element_Text('CPF');
       	$cpf->setLabel('CPF:* ')
       		->addValidator('StringLength', false, array('min' => 14, 'max' => 14))
       		->addErrorMessage('Insira CPF válido!')
       		->setAttrib('placeholder', 'Ex. 000.000.000-00')
       		->setDecorators(array(
       				'Errors',
       				'Label',
       				'ViewHelper',
       				array('HtmlTag', array('class'=>'right'))
       		))
       		->setRequired(true);
       	
       		 
       	$mae = new Zend_Form_Element_Text('NomeMae');
       	$mae->setLabel('Nome da Mãe:* ')
       		->addValidator('regex', false, array('/[a-z]/'))
       		->setAttrib('placeholder', 'Insira o nome da mãe')
       		->setDecorators(array(
       				'Errors',
       				'Label',
       				'ViewHelper',
       				array('HtmlTag', array('class'=>'right'))
       		))
       		->setRequired(true);
       	
       		
       	$pai = new Zend_Form_Element_Text('NomePai');
       	$pai->setLabel('Nome do Pai: ')
       		->setAttrib('placeholder', 'Insira nome do pai')
       		->setDecorators(array(
       			'Errors',
       			'Label',
       			'ViewHelper',
       			array('HtmlTag', array('class'=>'right'))
       		))
       		->addValidator('regex', false, array('/[a-z]/'));
       	
       		
        $igreja = new Zend_Form_Element_Select('Igreja_idIgreja');
        $igreja->setLabel('Igreja: ')
        	   ->addMultiOption('','')
        	   ->setAttrib('placeholder', 'Nome da Igreja do usuário')
        	   ->setAttrib('data-provider', 'typeahead')
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
        	  ->setDecorators(array(
        	  		'Errors',
        	  		'Label',
        	  		'ViewHelper',
        	  		array('HtmlTag', array('class'=>'right'))
        	  ))
        	  ->setRequired(true);
        
        	  
		$senha = new Zend_Form_Element_Password('Senha');
		$senha->setLabel('Senha: ')
			  ->addValidator('StringLength', false, array('min' => 6))
			  ->setAttrib('placeholder', 'No mínimo 6 caracteres')
			  ->setDecorators(array(
			  		'Errors',
			  		'Label',
			  		'ViewHelper',
			  		array('HtmlTag', array('class'=>'right'))
			  ))
			  ->setRequired(true);
		
			  
		$confsenha = new Zend_Form_Element_Password('ConfirmaSenha');
		$confsenha->setLabel('Confirmar Senha: ')
				  ->addValidator('Identical', false, array('token' => 'Senha'))
				  ->setAttrib('placeholder', 'Insira a mesma senha')
				  ->setDecorators(array(
				  		'Errors',
				  		'Label',
				  		'ViewHelper',
				  		array('HtmlTag', array('class'=>'right'))
				  ))
				  ->addErrorMessage('Senhas não combinam');
		
				  
		$tipo = new Zend_Form_Element_Select('Tipo');
		
		$lista = array(
			''	=>	'',
			1	=> 	'Admin',
			2 	=> 	'Professor',
			3 	=> 	'Aluno'
		);

		
		$tipo->setLabel('Tipo: ')
			 ->addMultiOptions($lista)
			 ->setRequired(true)
			 ->setAttrib('cols', 3)
			 ->setAttrib('placeholder', 'Tipo do usuário')
			 ->setAttrib('class','input-small')
			 ->setDecorators(array(
			 		'Errors',
			 		'Label',
			 		'ViewHelper',
			 		array('HtmlTag', array('class'=>'right'))
			 ))
			 ->addValidator('NotEmpty', true);
			 
		
		$foto = new Zend_Form_Element_File('Foto');
		$foto->setDestination('files/')
			 ->addValidator('Count', false, 1)
			 ->addValidator('Size', false, '15MB')
			 ->addDecorators(array(
			 		array('HtmlTag', array('tag'=>'div','class'=>'foto'))
			 ))
			 ->addValidator('Extension', false, 'jpg,png,gif');
		
			 
    	$curso = new Zend_Form_Element_Select('Curso_idCurso');
    	$curso->setLabel('Cursos: ')
    		  ->addMultiOption('','')
    		  ->setAttrib('placeholder', 'Curso do usuário')
    		  ->setAttrib('data-provider', 'typeahead')
    		  ->setDecorators(array(
    		  		'Errors',
    		  		'Label',
    		  		'ViewHelper',
    		  		array('HtmlTag', array('class'=>'right'))
    		  ));
    	
    	$model = new Application_Model_DbTable_Curso;
    	foreach($model->fetchAll() as $c){
    		$curso->addMultiOption($c->idCurso, $c->Nome);
    	}
    		

        $submit = new Zend_Form_Element_Submit('Cadastrar', array('class' => 'btn btn-success'));
        
        $this->addElements(array(
        	$nome,$end,$bairro,$cep,$nasc,$tel,$cel,
        	$cpf,$mae,$pai,$igreja,$curso,$tipo,
        	$email,$senha,$foto,$submit
        ));
        
        
        $this->addElement('hidden', 'Status', 
        	array(
        		'value' => 'ativo'
        	));
    }
}