<?php

class Service_DevelopmentController extends Zend_Controller_Action {

    public function init() {
        $this->_config = Zend_Registry::get('config');
        $this->_serverSoap = new Zend_Soap_Server(
                $this->_config['resources']['view']['urlSoapWsdl'] . '?wsdl', array("soap_version" => SOAP_1_2)
        );

        $this->_ReceiveMessageProduccion = $this->_helper->getHelper('ReceiveMessageProduccion');
    }

    public function soapAction() {
        $this->_helper->layout()->disableLayout();
        $this->_serverSoap->setClass('Server_Data');
        $this->_serverSoap->registerFaultException(array('Server_Exception'));
        $this->_serverSoap->handle();
    }
    /**
     * function GENERAL WSDL DESARROLLO.
     */
    public function receiveMessageAction() 
     { 
        
        $this->_helper->layout()->disableLayout();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         ini_set("display_errors", 1);
                function receiveMessage($a) {
                    $ReceiveMessage = new App_Controller_Action_Helper_ReceiveMessageProduccion();
                    $result = $ReceiveMessage->_receiveMessages($a);
                    return array("response" => $result);
                }

                function logTrama($str = "") {
                    $archivo = APPLICATION_PATH . '/../data/tramas_recibido/datos_recibidos_abdcp_nuevos_ultimos_producion_' . date('Ymdhis') . ".txt";
                    $fl = fopen($archivo, "x");
                    fwrite($fl, $str);
                    fclose($fl);
                }

                function filtrarMensage($msg) {

                    /* ES DONDE LE QUITAMOS EL MIME */
                    $INI = strpos($msg, '<?xml');
                    $FIN = strpos($msg, ':Envelope>');
                    return substr($msg, $INI, ($FIN + strlen(':Envelope>')) - $INI);
                }

                function soaputils_autoFindSoapRequest() {
                    global $HTTP_RAW_POST_DATA;
                    if ($HTTP_RAW_POST_DATA) {
                        logTrama($HTTP_RAW_POST_DATA);
                        return filtrarMensage(utf8_decode($HTTP_RAW_POST_DATA));
                    }
                    $f = file("php://input");
                    $texto = implode(" ", $f);
                    logTrama($texto);
                    return filtrarMensage(utf8_decode($texto));
                }

                ini_set("soap.wsdl_cache_enabled", "0");
                $this->_serverSoap->addFunction("receiveMessage");
                $this->_serverSoap->handle(soaputils_autoFindSoapRequest());
                exit;
            }
        
    }
    
  }
    