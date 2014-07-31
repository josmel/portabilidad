<?php

class Admin_Model_Cppr extends Core_Model
{
    protected $_tableCppr; 
    
    public function __construct() {
        $this->_tableCppr = new Application_Model_DbTable_Cppr();
    }    
  
     public function statusCpprIdentificacionSolicitud($id) {
            $smt = $this->_tableCppr->getAdapter()->select()
                        ->from($this->_tableCppr->getName())
                        ->where("idancp = ?", $id)->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
}
