<?php

class Service_IndexController extends Zend_Controller_Action       
{
    
     public function init() {

        $this->_config = Zend_Registry::get('config');
        $this->_GetResultSoapPruebas = $this->_helper->getHelper('GetResultSoapPruebas');
        $this->_GetResultXml = $this->_helper->getHelper('GetResultXml');
        $this->_GetResultSoap = $this->_helper->getHelper('GetResultSoap');
    }
    
    
      public function indexAction()
    {  
        $numero = '17200875';
        $xmlMsgSP =$this->_GetResultXml->_ConsultaPrevia($numero);
        $util = new Server_Util(); 
        $data =  $util->xml2array($xmlMsgSP);
        
        var_dump($data);exit;
        $dataForm = array();         
        $dataForm['CodigoCedente']       = $data['MensajeABDCP']['CuerpoMensaje']['ConsultaPrevia']['CodigoCedente'];
        $dataForm['TipoDocumentoIdentidad'] = $data['MensajeABDCP']['CuerpoMensaje']['ConsultaPrevia']['TipoDocumentoIdentidad'];
        $dataForm['NumeroDocumentoIdentidad'] =  $data['MensajeABDCP']['CuerpoMensaje']['ConsultaPrevia']['NumeroDocumentoIdentidad'];
        $dataForm['CantidadNumeraciones']    =  $data['MensajeABDCP']['CuerpoMensaje']['ConsultaPrevia']['CantidadNumeraciones'];
        $dataForm['NumeracionSolicitada'] =$data['MensajeABDCP']['CuerpoMensaje']['ConsultaPrevia']['NumeracionSolicitada']['RangoNumeracion']['InicioRango'];
        $dataForm['NombreContacto'] = $data['MensajeABDCP']['CuerpoMensaje']['ConsultaPrevia']['NombreContacto'];
        $dataForm['EmailContacto'] = $data['MensajeABDCP']['CuerpoMensaje']['ConsultaPrevia']['EmailContacto'];
        $dataForm['TelefonoContacto'] = $data['MensajeABDCP']['CuerpoMensaje']['ConsultaPrevia']['TelefonoContacto'];
        $dataForm['FaxContacto'] =  $data['MensajeABDCP']['CuerpoMensaje']['ConsultaPrevia']['FaxContacto'];
        $dataForm['TipoServicio'] =$data['MensajeABDCP']['CuerpoMensaje']['ConsultaPrevia']['TipoServicio'];
        $dataForm['Cliente'] =$data['MensajeABDCP']['CuerpoMensaje']['ConsultaPrevia']['Cliente'];
        $dataForm['IdentificadorMensaje'] =$data['MensajeABDCP']['CabeceraMensaje']['IdentificadorMensaje'];
        $dataForm['Remitente'] =$data['MensajeABDCP']['CabeceraMensaje']['Remitente'];
        $dataForm['Destinatario'] =$data['MensajeABDCP']['CabeceraMensaje']['Destinatario'];
        $dataForm['FechaCreacionMensaje'] =$data['MensajeABDCP']['CabeceraMensaje']['FechaCreacionMensaje'];
        $dataForm['IdentificadorProceso'] =$data['MensajeABDCP']['CabeceraMensaje']['IdentificadorProceso'];
        $obj = new Application_Entity_RunSql('Cp');      
        $obj->save=$dataForm; 
        $resultSP =$this->_GetResultSoap->_receiveMessage($xmlMsgSP);
        var_dump($resultSP);exit;
        if($resultSP == 'ack'){
             $xmlMsgANS =$this->_GetResultXml->_EnvioSolicitudCedente($numero);
             $resultANS = $this->_GetResultSoap->_receiveMessage($xmlMsgANS);
             var_dump($resultANS);exit;
              if($resultANS == 'ack'){
                   echo 'sxdddgs';exit;
              } else {
           var_dump($resultSP);exit;
        }
        } else {
           var_dump($resultSP);exit;
        }
    }
    
      public function testAction()
    {
       $params = array(
            "CardNumber"  => "21213232323"
        );
       $result =$this->_GetResultSoapPruebas ->_getResultSoap($params);
                 var_dump($result->CheckCCResult->CardType);
          echo '<br>';
           var_dump($result->CheckCCResult->CardValid);
          exit;
    }
    
    
}

