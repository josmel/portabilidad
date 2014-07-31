<?php

class Admin_Model_Ancp extends Core_Model
{
    protected $_tableAncp; 
    
    public function __construct() {
        $this->_tableAncp = new Application_Model_DbTable_Ancp();
    }    
  
     public function statusCp($id) {
            $smt = $this->_tableAncp->getAdapter()->select()
                        ->from($this->_tableAncp->getName(),array('iancp'))
                        ->where("IdentificacionSolicitud = ?", $id)->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
   
     public function statusCpIdentificacionSolicitud($id) {
            $smt = $this->_tableAncp->getAdapter()->select()
                        ->from($this->_tableAncp->getName())
                        ->where("idcp = ?", $id)->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
}
