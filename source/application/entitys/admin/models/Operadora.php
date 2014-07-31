<?php

class Admin_Model_Operadora extends Core_Model
{
    protected $_tableOperadora; 
    
    public function __construct() {
        $this->_tableOperadora = new Application_Model_DbTable_Operadora();
    }    
  
    public function getPairsAll() {
        $smt = $this->_tableOperadora->getAdapter()->select()
                ->from($this->_tableOperadora->getName())
                ->where("state LIKE '1'")->query();
        
        $result = array();
        while ($row = $smt->fetch()) {
            $result[$row['codigo']] = $row['nombre'];
        }
        $smt->closeCursor();
        return $result;
    }
   
}
