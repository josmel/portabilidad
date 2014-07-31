<?php

class Admin_Model_Ans extends Core_Model
{
    protected $_tableAns; 
    
    public function __construct() {
        $this->_tableAns = new Application_Model_DbTable_Ans();
    }    
  
     public function statusAns($id) {
            $smt = $this->_tableAns->getAdapter()->select()
                        ->from($this->_tableAns->getName(),array('idtAns'))
                        ->where("IdentificacionSolicitud = ?", $id)->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
   
     public function statusSpIdentificacionSolicitud($id) {
            $smt = $this->_tableAns->getAdapter()->select()
                        ->from($this->_tableAns->getName())
                        ->where("idtSp = ?", $id)->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
    
     public function statusAnsId($id) {
            $smt = $this->_tableAns->getAdapter()->select()
                        ->from($this->_tableAns->getName())
                        ->where("idtAns = ?", $id)->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
}
