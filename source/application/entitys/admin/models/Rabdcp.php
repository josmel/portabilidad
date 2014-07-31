<?php

class Admin_Model_Rabdcp extends Core_Model
{
    protected $_tableRabdcp; 
    
    public function __construct() {
        $this->_tableRabdcp = new Application_Model_DbTable_Rabdcp();
    }    
  
     public function statusRabdcpIdentificacionSolicitud($id) {
            $smt = $this->_tableRabdcp->getAdapter()->select()
                        ->from($this->_tableRabdcp->getName())
                        ->where("idtAns = ?", $id)->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
}
