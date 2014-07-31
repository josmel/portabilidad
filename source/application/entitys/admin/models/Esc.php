<?php

class Admin_Model_Esc extends Core_Model
{
    protected $_tableEsc; 
    
    public function __construct() {
        $this->_tableEsc = new Application_Model_DbTable_Esc();
    }    
  
     public function IdentificacionProceso($id) {
            $smt = $this->_tableEsc->getAdapter()->select()
                        ->from($this->_tableEsc->getName(),array('idtEsc'))
                        ->where("IdentificadorProceso = ?", $id)->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }

     public function IdentificacionProcesoEsc($id) {
            $smt = $this->_tableEsc->getAdapter()->select()
                        ->from($this->_tableEsc->getName(),array('idtEsc'))
                        ->where("IdentificadorProceso = ?", $id)->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
    
     public function listaStateTrue($IdentificadorProceso) {
            $smt = $this->_tableEsc->getAdapter()->select()
                        ->from($this->_tableEsc->getName())
                        ->where("IdentificadorProceso = ?",$IdentificadorProceso)->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
    
}
