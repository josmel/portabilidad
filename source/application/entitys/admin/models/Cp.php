<?php

class Admin_Model_Cp extends Core_Model
{
    protected $_tableCp; 
    
    public function __construct() {
        $this->_tableCp = new Application_Model_DbTable_Cp();
    }    
  
     public function statusCp($id) {
            $smt = $this->_tableCp->getAdapter()->select()
                        ->from($this->_tableCp->getName(),array('idtCp'))
                        ->where("IdentificadorProceso = ?", $id)->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
    public function dataAll($id) {
            $smt = $this->_tableCp->getAdapter()->select()
                        ->from($this->_tableCp->getName(),array('IdentificadorProceso'))
                        ->where("idtCp = ?", $id)->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
      public function dataAllTotal($id) {
            $smt = $this->_tableCp->getAdapter()->select()
                        ->from($this->_tableCp->getName())
                        ->where("idtCp = ?", $id)->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
}
