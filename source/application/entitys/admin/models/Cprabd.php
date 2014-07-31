<?php

class Admin_Model_Cprabd extends Core_Model
{
    protected $_tableCprabd; 
    
    public function __construct() {
        $this->_tableCprabd = new Application_Model_DbTable_Cprabd();
    }    
  
     public function statusCprabdIdentificacionSolicitud($id) {
            $smt = $this->_tableCprabd->getAdapter()->select()
                        ->from($this->_tableCprabd->getName())
                        ->where("idancp = ?", $id)->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
}
