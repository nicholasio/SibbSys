<?php
class SIBB_Plugins_Acl extends Zend_Controller_Plugin_Abstract {
       
    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request){
    	
    	$module = $request->getModuleName();
        $resource = $request->getControllerName();
        $action = $request->getActionName();
        
        $auth = Zend_Auth::getInstance();
        
        
        
        if($auth->hasIdentity()){
        	$user = $auth->getIdentity();
        		if(is_object($user)){
        			if($user->Tipo == 1 && $module != 'admin'){
        				header('Location: admin');
        			}
        			if($user->Tipo == 2 && $module != 'professor'){
        				header('Location: professor');
        			}
        			if($user->Tipo == 3 && $module != 'aluno'){
        				header('Location: aluno');
        			}
        		}
        }
        
    }
}
        