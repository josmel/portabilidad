<?php

class Admin_Model_Customer extends Core_Model {

    protected $_tableCustomer;

    public function __construct() {
        $this->_tableCustomer = new Application_Model_DbTable_Customer();
    }

    public function getCustomerNumber(array $datEcpc) {

        $smt = $this->_tableCustomer->getAdapter()->select()
                ->from($this->_tableCustomer->getName())
                ->where("telefono = ?", $datEcpc['Numeracion'])
                ->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        if ($result == false) {
            return 'REC01PRT05';
        } else {
            if ($result["dni"] == $datEcpc['NumeroDocumentoIdentidad']) {
                if ($result["estado"] == '1') {
                    if ($result["deuda"] == '1') { 
                        if ($result["tipoPortabilidad"] == $datEcpc['TipoPortabilidad']) {
                            if ($result["tipoServicio"] == $datEcpc['TipoServicio']) {
                                if ($result["baja"] == '1') {
                                    return 'ack';
                                } else {
                                    return 'REC01PRT07';
                                }
                            } else {
                                return 'REC01PRT06';
                            }
                        } else {  
                            return 'REC01PRT08';
                        }
                    } else {
                        return 'REC01PRT09';
                    }
                } else {
                    return 'REC01PRT01';
                }
            } else {
                return 'REC01PRT07';
            }
        }
    }


}
