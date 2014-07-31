<?php

class Admin_Model_Error extends Core_Model
{
    protected $_tableError; 
    
    public function __construct() {
        $this->_tableError = new Application_Model_DbTable_Error();
    }    
  
     public function errorDescripcion($id) {
            $smt = $this->_tableError->getAdapter()->select()
                        ->from($this->_tableError->getName(),array('descripcion'))
                        ->where("codigo = ?", $id)->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }

    
}
