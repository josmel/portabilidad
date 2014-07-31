<?php

class Admin_Model_Pep extends Core_Model
{
    protected $_tablePep; 
    
    public function __construct() {
        $this->_tablePep = new Application_Model_DbTable_Pep();
    }    
  
     public function statusPepIdentificacionSolicitud($id) {
            $smt = $this->_tablePep->getAdapter()->select()
                        ->from($this->_tablePep->getName())
                        ->where("idtAns = ?", $id)->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }

}
