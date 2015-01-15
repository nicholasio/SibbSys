<?php

class Application_Form_UsuarioEdit extends Zend_Form
{

    public function init(){
    	
        $nome = new Zend_Form_Element_Text('Nome');
        $nome->setLabel('Nome:* ')
        	 ->addValidator('regex', false, array('/[a-z]/'))
        	 ->setDecorators(array(
        	 		'Errors',
        	 		'Label',
        	 		'ViewHelper',
        	 		array('HtmlTag', array('class'=>'right'))
        	 ))
        	 ->setRequired(true);
        	 

       	$end = new Zend_Form_Element_Text('Endereco');
       	$end->setLabel('Endereço:* ')
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
       		->setDecorators(array(
       				'Errors',
       				'Label',
       				'ViewHelper',
       				array('HtmlTag', array('class'=>'right'))
       		))
       		->addErrorMessage('Entre com um CEP válido! Ex.(00.000-000)');
       		
       		
       	$tel = new Zend_Form_Element_Text('Telefone');
       	$tel->setLabel('Telefone:* ')
       		->addValidator('StringLength', false, array('min' => 12, 'max' => 12))
       		->addErrorMessage('Insira um número válido! Ex.(00 0000-0000)')
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
       		->setDecorators(array(
       				'Errors',
       				'Label',
       				'ViewHelper',
       				array('HtmlTag', array('class'=>'right'))
       		))
       		->addErrorMessage('Insira um número válido! Ex.(00 0000-0000)');
       	
       		
       	$cpf = new Zend_Form_Element_Text('CPF');
       	$cpf->setLabel('CPF:* ')
       		->addValidator('StringLength', false, array('min' => 14, 'max' => 14))
       		->addErrorMessage('Entre com um CPF válido! Ex.(000.000.000-00)')
       		->setDecorators(array(
       				'Errors',
       				'Label',
       				'ViewHelper',
       				array('HtmlTag', array('class'=>'right'))
       		))
       		->setRequired(true);
       
       	   
       	$nasc = new Zend_Form_Element_Text('DataNascimento');
       	$nasc->setLabel('Data de Nacimento (dd/mm/aaaa):* ')
       		 ->setAttrib('size', 10)
       		 ->addErrorMessage('Entre com o formato da data correto. Ex. 00/00/0000')
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
       		->setDecorators(array(
       				'Errors',
       				'Label',
       				'ViewHelper',
       				array('HtmlTag', array('class'=>'right'))
       		))
       		->setRequired(true);
       	
       		
       	$pai = new Zend_Form_Element_Text('NomePai');
       	$pai->setLabel('Nome do Pai: ')
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
        	   ->setDecorators(array(
        	   		'Errors',
        	   		'Label',
        	   		'ViewHelper',
        	   		array('HtmlTag', array('class'=>'right'))
        	   ))
        	   ->setRequired(true);
        
        $option = new Application_Model_DbTable_Igreja();
        foreach($option->fetchAll() as $i){
        	$igreja->addMultiOption($i->idIgreja, $i->Igreja);
        }
        
				  
		$tipo = new Zend_Form_Element_Select('Tipo');
		
		$lista = array(
			''	=>	'',
			1	=> 	'Admin',
			2 	=> 	'Professor',
			3 	=> 	'Aluno'
		);

		
		$tipo->setLabel('Tipo: ')
			 ->addMultiOptions($lista)
			 ->setDecorators(array(
			 		'Errors',
			 		'Label',
			 		'ViewHelper',
			 		array('HtmlTag', array('class'=>'right'))
			 ))
			 ->setRequired(true)->addValidator('NotEmpty', true);
			 
			 
    	$curso = new Zend_Form_Element_Select('Curso_idCurso');
    	$curso->setLabel('Cursos: ')
    		  ->addMultiOption('','')
    		  ->setDecorators(array(
    		  		'Errors',
    		  		'Label',
    		  		'ViewHelper',
    		  		array('HtmlTag', array('class'=>'right'))
    		  ))
    		  ->setRequired(true);
    	
    	
    	$model = new Application_Model_DbTable_Curso;
    	foreach($model->fetchAll() as $c){
    		$curso->addMultiOption($c->idCurso, $c->Nome);
    	}
    	
    	
        $submit = new Zend_Form_Element_Submit('Cadastrar', array('class' => 'btn btn-success'));
        $submit->setDecorators(array(
        			'Errors',
        			'ViewHelper',
        			array('HtmlTag', array('class'=>'btn-submit_edit'))
        		));
        
        $this->addElements(array(
        	$nome,$end,$bairro,$cep,$tel,$cel,$nasc,
        	$mae,$pai,$cpf,$igreja,$tipo,$curso,$submit
        ));
        
               
        $this->addElement('hidden', 'Status', 
        	array(
        		'value' => 'ativo'
        	));
    }
}