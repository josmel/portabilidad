<?php

class Service_ServerController extends Zend_Controller_Action {

    public function init() {
        $this->_config = Zend_Registry::get('config');
        //  Inicializa el servidor y configurar URI
        $this->_serverSoap = new Zend_Soap_Server(
                // $this->_config['resources']['view']['urlSoapWsdl']
                $this->_config['resources']['view']['urlSoapWsdl'] . '?wsdl', array("soap_version" => SOAP_1_2)
        );

        $this->_ReceiveMessage = $this->_helper->getHelper('ReceiveMessage');
    }

    public function soapAction() {
        // desactivamos layouts 
        $this->_helper->layout()->disableLayout();
        /// establecemos la clase de servicio SOAP
        $this->_serverSoap->setClass('Server_Data');
        //$this->_serverSoap->setReturnResponse(false);
        // registramos las exepciones para generar errores de  SOAP 
        $this->_serverSoap->registerFaultException(array('Server_Exception'));
        //gestionamos la solicitud
        $this->_serverSoap->handle();
    }

    /**
     * function GENERAL WSDL.
     */
    public function wsdlAction() {
        $this->_helper->layout()->disableLayout();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($_GET["wsdl"] === "" && isset($_GET["wsdl"]) && empty($_GET["wsdl"]))
                $str = '';
            header("Content-type: text/xml");
            $str .= '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
            $str .= '<wsdl:definitions targetNamespace="http://ws.inpac.telcordia.com" xmlns:ns1="http://org.apache.axis2/xsd" xmlns:ns="http://ws.inpac.telcordia.com" xmlns:wsaw="http://www.w3.org/2006/05/addressing/wsdl" xmlns:wsdl="http://schemas.xmlsoap.org/wsdl/" xmlns:http="http://schemas.xmlsoap.org/wsdl/http/" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/wsdl/soap/" xmlns:mime="http://schemas.xmlsoap.org/wsdl/mime/" xmlns:ttns="http://ws.inpac.telcordia.com" xmlns:soap12="http://schemas.xmlsoap.org/wsdl/soap12/">' . "\n";
            $str .= '<wsdl:documentation>' . "\n";
            $str .= '		This is WSDL for  Web Service' . "\n";
            $str .= '	</wsdl:documentation>' . "\n";
            $str .= '  <wsdl:types>' . "\n";
            $str .= '   <xs:schema attributeFormDefault="qualified" elementFormDefault="qualified" targetNamespace="http://ws.inpac.telcordia.com">' . "\n";
            $str .= '			<xs:element name="receiveMessageRequest">' . "\n";
            $str .= '				<xs:complexType>' . "\n";
            $str .= '					<xs:sequence>' . "\n";
            $str .= '						<xs:element minOccurs="1" name="userID" nillable="false" type="xs:string"/>' . "\n";
            $str .= '						<xs:element minOccurs="1" name="password" nillable="false" type="xs:string"/>' . "\n";
            $str .= '						<xs:element minOccurs="1" name="xmlMsg" nillable="false" type="xs:string"/>' . "\n";
            $str .= '						<xs:element minOccurs="0" name="attachedDoc" nillable="false" type="xs:base64Binary"/>' . "\n";
            $str .= '					</xs:sequence>' . "\n";
            $str .= '				</xs:complexType>' . "\n";
            $str .= '			</xs:element>' . "\n";
            $str .= '			<xs:element name="receiveMessageResponse">' . "\n";
            $str .= '				<xs:complexType>' . "\n";
            $str .= '					<xs:sequence>' . "\n";
            $str .= '						<xs:element minOccurs="1" name="response" nillable="false" type="xs:string"/>' . "\n";
            $str .= '					</xs:sequence>' . "\n";
            $str .= '				</xs:complexType>' . "\n";
            $str .= '			</xs:element>' . "\n";
            $str .= '		</xs:schema>' . "\n";
            $str .= '  </wsdl:types>' . "\n";
            $str .= '  <wsdl:message name="receiveMessageRequest">' . "\n";
            $str .= '    <wsdl:part name="parameters" element="ns:receiveMessageRequest">' . "\n";
            $str .= '    </wsdl:part>' . "\n";
            $str .= '  </wsdl:message>' . "\n";
            $str .= '  <wsdl:message name="receiveMessageResponse">' . "\n";
            $str .= '    <wsdl:part name="parameters" element="ns:receiveMessageResponse">' . "\n";
            $str .= '    </wsdl:part>' . "\n";
            $str .= '  </wsdl:message>' . "\n";
            $str .= '  <wsdl:portType name="ABDCPWebServicePortType">' . "\n";
            $str .= '    <wsdl:operation name="receiveMessage">' . "\n";
            $str .= '      <wsdl:input message="ns:receiveMessageRequest" wsaw:Action="urn:receiveMessageRequest">' . "\n";
            $str .= '    </wsdl:input>' . "\n";
            $str .= '      <wsdl:output message="ns:receiveMessageResponse" wsaw:Action="urn:receiveMessageResponse">' . "\n";
            $str .= '    </wsdl:output>' . "\n";
            $str .= '    </wsdl:operation>' . "\n";
            $str .= '  </wsdl:portType>' . "\n";
            $str .= '  <wsdl:binding name="ABDCPWebServiceSoap12Binding" type="ns:ABDCPWebServicePortType">' . "\n";
            $str .= '    <soap12:binding style="document" transport="http://schemas.xmlsoap.org/soap/http"/>' . "\n";
            $str .= '    <wsdl:operation name="receiveMessage">' . "\n";
            $str .= '      <soap12:operation soapAction="urn:receiveMessage" style="document"/>' . "\n";
            $str .= '      <wsdl:input>' . "\n";
            $str .= '        <soap12:body use="literal"/>' . "\n";
            $str .= '      </wsdl:input>' . "\n";
            $str .= '      <wsdl:output>' . "\n";
            $str .= '       <soap12:body use="literal"/>' . "\n";
            $str .= '      </wsdl:output>' . "\n";
            $str .= '    </wsdl:operation>' . "\n";
            $str .= ' </wsdl:binding>' . "\n";
            $str .= ' <wsdl:service name="ABDCPWebService">' . "\n";
            $str .= '<wsdl:documentation>ABDCP Web service</wsdl:documentation>' . "\n";
            $str .= '   <wsdl:port name="ABDCPWebServiceHttpSoap12Endpoint" binding="ns:ABDCPWebServiceSoap12Binding">' . "\n";
            $str .= '     <soap12:address location="' . $this->_config['resources']['view']['urlSoapWsdl'] . '"/>' . "\n";
            $str .= '   </wsdl:port>' . "\n";
            $str .= ' </wsdl:service>' . "\n";
            $str .= '</wsdl:definitions>' . "\n";
            echo $str;
            exit;
        } else {
            ini_set("display_errors", 1);
            /* INTERFACE DE SERVICIO MOCHE-PORTABILIDAD */

            function receiveMessage($a) {
                $ReceiveMessage = new App_Controller_Action_Helper_ReceiveMessage();
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
    