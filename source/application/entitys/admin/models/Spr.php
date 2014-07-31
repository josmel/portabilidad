<?php

class Admin_Model_Spr extends Core_Model
{
    protected $_tableSpr; 
    
    public function __construct() {
        $this->_tableSpr = new Application_Model_DbTable_Spr();
    }    
  
     public function statusSprIdentificacionSolicitud($id) {
            $smt = $this->_tableSpr->getAdapter()->select()
                        ->from($this->_tableSpr->getName())
                        ->where("idtAns = ?", $id)->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
     public function statusSpr($id) {
            $smt = $this->_tableSpr->getAdapter()->select()
                        ->from($this->_tableSpr->getName())
                        ->where("idtSpr = ?", $id)->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
    
     public function statusEsc($id) {
            $smt = $this->_tableSpr->getAdapter()->select()
                        ->from($this->_tableSpr->getName())
                        ->where("idtEsc = ?", $id)->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
    
}
