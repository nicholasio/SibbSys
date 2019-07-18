<?php

class Default_IndexController extends Zend_Controller_Action
{

	public function indexAction()
	{
		$this->_forward('login');
		
	}

	public function loginAction(){
		
		if ($this->_helper->FlashMessenger->hasMessages()) {
			$this->view->menssagem = $this->_helper->FlashMessenger->getMessages();
		}
		
		$form = new Application_Form_Login();

		$request = $this->_request;
		 
		if($request->isPost()){
			$data = $request->getPost();
			if($form->isValid($data)){
				$data = $form->getValues();

				$login = Application_Model_DbTable_Login::login($data['login'], $data['senha']);
				if($login === true){
					$auth = Zend_Auth::getInstance();
					$tipo = $auth->getStorage()->read();
					if($tipo->Tipo == 1){
						$this->_redirect('/admin');
					}
					else if($tipo->Tipo == 2){
						$this->_redirect('/professor');
					}
					else if($tipo->Tipo == 3){
						$this->_redirect('/aluno');
					}
				}
				else{
					
					$this->view->messages = $login;
				}

			}
		}
		$this->view->form = $form;
	}
	
	
	public function logoutAction(){

		$auth = Zend_Auth::getInstance();
		$auth->clearIdentity();
		$this->_redirect('/default');
		
	}
	
	
	public function recuperaSenhaAction(){
	
		$form = new Application_Form_RecuperaSenha();
		$model = new Application_Model_DbTable_Usuario();
		
		if($this->getRequest()->isPost()){
			if($form->isValid($this->_request->getPost())){
				
				$email = $form->getValues();
				$getEmail = $model->getUsuario($email);
				
				$id = $getEmail['idUsuario'];
	
				
				if($email['email'] == $getEmail['Email']){

					$bodyText = ('<b>Olá ' . $getEmail['Nome'] . '</b>' . ' <br /><br />' . 
					'Alguém solicitou o processo de recuperação da senha para sua conta.' . '<br />' . 
					'Para completar o processo, por favor '  . '<a href="' . 'academico.seminariobereiano.com.br/index/form-recupera/?id='.$id .'">' . 'clique aqui' . '</a>' . 
					'<br /><br />' .  'A Família SIBB Agradece!' . '<br /><br /><br />' . 
					'Para mais informações, Contate-nos em ' . Zend_Registry::get('config')->email->support . '<br />' . 
					'http://seminariobereiano.com.br/'
					);

					$mail = new Zend_Mail("UTF-8");
					$mail->setBodyHtml($bodyText);
					$mail->setFrom(Zend_Registry::get('config')->email->support);
					$mail->addTo($getEmail['Email']);
					$mail->setSubject('Recuperar Senha');
					
					$mail->send();
					$this->_helper->flashMessenger->addMessage("Foi enviado um e-mail para a sua conta de e-mail para continuarmos o processo de recuperação da sua senha. Obrigado!");
					$this->_redirect("/default");
					
					
				} else {
					echo 'Endereço de Email não cadastrado!';
				}
			}
		}
		
		$this->view->form = $form;
	}
	
	
	public function formRecuperaAction(){
	
		$form = new Application_Form_AlteraSenha();
		$model = new Application_Model_DbTable_Usuario();
		
		$id = $_GET["id"];
		
		if($this->_request->isPost()){
			if($form->isValid($this->_request->getPost())){
				$data = $form->getValues();
				$data['Senha'] = sha1($data['Senha']);
				$data['ConfirmaSenha'] = sha1($data['ConfirmaSenha']);
				
				if($id){
					$where = $model->getAdapter()->quoteInto('idUsuario = ?', $id);
					$model->update($data, $where);
					$this->_redirect("/default");
				}
			}
		}
		
		$this->view->form = $form;
	}
	
}