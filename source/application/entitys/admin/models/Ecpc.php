<?php

class Admin_Model_Ecpc extends Core_Model
{
    protected $_tableEcpc; 
    
    public function __construct() {
        $this->_tableEcpc = new Application_Model_DbTable_Ecpc();
    }    
  //,array('idtEcpc','NumeroDocumentoidentidad','Numeracion','TipoServicio')
     public function listaStateTrue($IdentificadorProceso) {
            $smt = $this->_tableEcpc->getAdapter()->select()
                        ->from($this->_tableEcpc->getName())
                        ->where("IdentificadorProceso = ?",$IdentificadorProceso)->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
    
    
    
    
    
    
    
    
    
    
    
    

     public function getQuizEmpresario($idEmpresario,$idEncuesta) {
        $smt = $this->_tableEncuestaEmpreario->getAdapter()->select()
                        ->from($this->_tableEncuestaEmpreario->getName())
                        ->where("codempr = ?", $idEmpresario)
                        ->where("idencuesta = ?", $idEncuesta)->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
    
    public function hasFuxionCard($cardNumber) {
        $smt = $this->_tableBusinessman->select()
                    ->where('ntfempr = ?', $cardNumber);
        //echo $smt->assemble(); exit;
        $smt = $smt->query();
        $result = $smt->fetchAll();
        $smt->closeCursor();
        
        if (!empty($result)) return true;
        
        return false;
    }
    
    
}
