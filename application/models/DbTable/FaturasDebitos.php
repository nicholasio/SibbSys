<?php

class Application_Model_DbTable_FaturasDebitos extends Zend_Db_Table_Abstract {
    protected $_name = 'Faturas_has_Debitos';
    protected $_primary = 'idFatura_has_Debitos';


    public function insert(array $data){
        parent::insert($data);
    }

    public function getDebitos($idFatura) {
        $sql = $this->select()->from('Faturas_has_Debitos', array('Debitos_idDebitos'))->where('Faturas_idFatura = ?', $idFatura);

        return $this->getAdapter()->fetchCol($sql);
    }

    public function editar($id){

        $sql = $this->select()->where('idFatura_has_Debitos = ?', $id);
        $row = $this->fetchRow($sql);

        if(null !== $row)
            return $row->toArray();
    }


    public function deletar($id){

        $sql = $this->select()->where('idFatura_has_Debitos = ?', $id);
        $row = $this->fetchRow($sql);

        $row->delete();
    }


    public function listar(){

        $sql = $this->select()
            ->order(array(new Zend_Db_Expr('idFatura_has_Debitos ASC')));

        $rows = $this->fetchAll($sql);

        return $rows;
    }

    public function findDebito($idDebito) {
        $sql = $this->select()->where('Debitos_idDebitos = ?', $idDebito);

        $row = $this->fetchRow($sql);

        return $row;
    }

}