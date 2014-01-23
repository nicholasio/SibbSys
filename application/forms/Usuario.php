<?php

class Application_Form_Usuario extends Zend_Form
{

    public function init(){
    	
        $nome = new Zend_Form_Element_Text('Nome');
        $nome->setLabel('Nome:* ')
        	 ->addValidator('regex', false, array('/[a-z]/'))
        	 ->setRequired(true);
        	 

       	$end = new Zend_Form_Element_Text('Endereco');
       	$end->setLabel('Endereço:* ')
       		->addValidator('regex', false, array('/[a-z]/'))
       		->setRequired(true);
       	
       		
       	$bairro = new Zend_Form_Element_Text('Bairro');
       	$bairro->setLabel('Bairro:* ')
       		   ->addValidator('regex', false, array('/[a-z]/'))
       		   ->setRequired(true);

       		   
       	$cep = new Zend_Form_Element_Text('CEP');
       	$cep->setLabel('CEP: ')
       		->addValidator('StringLength', false, array('min' => 10, 'max' => 10))
       		->addErrorMessage('Entre com um CEP válido! Ex.(00.000-000)');
       		
       		
       	$tel = new Zend_Form_Element_Text('Telefone');
       	$tel->setLabel('Telefone:* ')
       		->addValidator('StringLength', false, array('min' => 12, 'max' => 12))
       		->addErrorMessage('Entre com um número válido! Ex.(00 0000-0000)')
       		->setRequired(true);
       		
       		
       	$cel = new Zend_Form_Element_Text('Celular');
       	$cel->setLabel('Celular: ')
       		->addValidator('StringLength', false, array('min' => 12, 'max' => 12))
       		->addErrorMessage('Entre com um número válido! Ex.(00 0000-0000)');
       	
       		
       	$cpf = new Zend_Form_Element_Text('CPF');
       	$cpf->setLabel('CPF:* ')
       		->addValidator('StringLength', false, array('min' => 14, 'max' => 14))
       		->addErrorMessage('Entre com um CPF válido! Ex.(000.000.000-00)')
       		->setRequired(true);
       		
       		
       	$rg = new Zend_Form_Element_Text('RG');
       	$rg->setLabel('RG: ')
       	   ->addValidator('digits')
       	   ->setAttrib('size', 13);
       	
       	   
       	$nasc = new Zend_Form_Element_Text('DataNascimento');
       	$nasc->setLabel('Data de Nacimento (dd/mm/aaaa):* ')
       		 ->setAttrib('size', 10)
       		 ->addErrorMessage('Insira o formato correto. Ex: DD/MM/AAAA')
       		 ->setRequired(true);
       	
       		 
       	$mae = new Zend_Form_Element_Text('NomeMae');
       	$mae->setLabel('Nome da Mãe:* ')
       		->addValidator('regex', false, array('/[a-z]/'))
       		->setRequired(true);
       	
       		
       	$pai = new Zend_Form_Element_Text('NomePai');
       	$pai->setLabel('Nome do Pai: ')
       		->addValidator('regex', false, array('/[a-z]/'));
       	
       		
        $igreja = new Zend_Form_Element_Select('Igreja_idIgreja');
        $igreja->setLabel('Igreja: ')
        	   ->addMultiOption('','');
        
        $option = new Application_Model_DbTable_Igreja();
        foreach($option->fetchAll() as $i){
        	$igreja->addMultiOption($i->idIgreja, $i->Igreja);
        }
        
        
        $email = new Zend_Form_Element_Text('Email');
        $email->setLabel('Email:* ')
        	  ->addValidator('EmailAddress')
        	  ->addErrorMessage('Insira um endereço de email válido.') 
        	  ->setRequired(true);
        
        	  
		$senha = new Zend_Form_Element_Password('Senha');
		$senha->setLabel('Senha: ')
			  ->addValidator('StringLength', false, array('min' => 6))
			  ->setRequired(true);
		
			  
		$confsenha = new Zend_Form_Element_Password('ConfirmaSenha');
		$confsenha->setLabel('Confirmar Senha: ')
				  ->addValidator('Identical', false, array('token' => 'Senha'))
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
			 ->addValidator('NotEmpty', true);
			 
		
		$foto = new Zend_Form_Element_File('Foto');
		$foto->setLabel('Insira uma Foto: ')
			 ->setDestination('files/')
			 ->addValidator('Count', false, 1)
			 ->addValidator('Size', false, '15MB')
			 ->addValidator('Extension', false, 'jpg,png,gif');
		
			 
    	$curso = new Zend_Form_Element_Select('Curso_idCurso');
    	$curso->setLabel('Cursos: ')
    		  ->addMultiOption('','');
    	
    	$model = new Application_Model_DbTable_Curso;
    	foreach($model->fetchAll() as $c){
    		$curso->addMultiOption($c->idCurso, $c->Nome);
    	}
    		

        $submit = new Zend_Form_Element_Submit('Cadastrar', array('class' => 'btn btn-success'));
        
        
        $this->addElements(array(
        	$nome,$end,$bairro,$cep,$tel,$cel,$nasc,
        	$mae,$pai,$cpf,$rg,$igreja,$tipo,$curso,
        	$email,$senha,$confsenha
        ));
        
        $this->setElementDecorators(array(
    		'Errors',
       		'ViewHelper',
       		'Label',
       	));       
		
        $this->addElements(array($foto, $submit));
        
        $this->addElement('hidden', 'Status', 
        	array(
        		'value' => 'ativo'
        	));
    }
}