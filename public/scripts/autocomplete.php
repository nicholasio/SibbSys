<?php 

$model = new Application_Model_DbTable_Disciplina();

$dados = $model->autoComplete();

echo  Zend_Json::encode($dados);
