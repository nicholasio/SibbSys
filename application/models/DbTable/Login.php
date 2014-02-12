<?php

class Application_Model_DbTable_Login{

	public static function login($login, $senha){
		
		$model = new self;
		
		$db = Zend_Db_Table::getDefaultAdapter();
		$adapter = new Zend_Auth_Adapter_DbTable($db,
				'Usuario',
				'Email',
				'Senha',
				'SHA1(?)'
		);
		
		$select = $adapter->getDbSelect();
		$select->where('Status = "ativo"');		
		
		$adapter->setIdentity($login);
		$adapter->setCredential($senha);
		
		$auth = Zend_Auth::getInstance();
		$result = $auth->authenticate($adapter);
		
		if($result->isValid()){
			$data = $adapter->getResultRowObject(null, 'Senha');
			$auth->getStorage()->write($data);
			
			return true;
		}
		else{
			
			return $model->getMessages($result);
			
		}
	}

	
	public function getMessages(Zend_Auth_Result $result){
		
		$resultCode = $result->getCode();		
		
		switch($resultCode){
			case Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND:
				$msg = 'Login não encontrado';
				break;
			
			case Zend_Auth_Result::FAILURE_IDENTITY_AMBIGUOUS:
				$msg = 'Duplicidade de login';
				break;

			case Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID:
				$msg = 'Login e/ou senha não corresponde';
				break;
			
			default:
				$msg = 'Login e/ou senha não encontrados';
				break;
		}
		return $msg;
		
	}	
}