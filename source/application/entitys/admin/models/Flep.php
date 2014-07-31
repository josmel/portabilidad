<?php

class Admin_Model_Flep extends Core_Model
{
    protected $_tableFlep; 
    
    public function __construct() {
        $this->_tableFlep = new Application_Model_DbTable_Flep();
    }    
  
     public function statusFlepIdentificacionSolicitud($id) {
            $smt = $this->_tableFlep->getAdapter()->select()
                        ->from($this->_tableFlep->getName())
                        ->where("idtAns = ?", $id)->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }

}
