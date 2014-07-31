<?php

class Admin_Model_Sp extends Core_Model
{
    protected $_tableSp; 
    
    public function __construct() {
        $this->_tableSp = new Application_Model_DbTable_Sp();
    }    
  
     public function statusSp($id) {
            $smt = $this->_tableSp->getAdapter()->select()
                        ->from($this->_tableSp->getName(),array('idtSp'))
                        ->where("IdentificadorProceso = ?", $id)->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }

}
