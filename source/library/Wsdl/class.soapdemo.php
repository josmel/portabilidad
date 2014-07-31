<?php

if(basename($_SERVER['SCRIPT_FILENAME'])==basename(__FILE__))
	exit;

/**
 * This demo webservice shows you how to work with PhpWsdl
 * 
 * @service SoapDemo
 */
class SoapDemo{
	/**
	 * Get a complex type object
	 * 
	 * @return ComplexTypeDemo The object
	 */
	public function GetComplexType(){
		return new ComplexTypeDemo();
	}
	
	/**
	 * Print an object
	 * 
	 * @param string $obj 
	 * @return string The result of print_r
	 */
	public function PrintComplexType($obj){
		return 'hola'.$obj;
	}
	
	/**
	 * Print an array of objects
	 * 
	 * @param ComplexTypeDemoArray $arr A ComplexTypeDemo array
	 * @return stringArray The results of print_r
	 */
	public function ComplexTypeArrayDemo($arr){
		$res=Array();
		$i=-1;
		$len=sizeof($arr);
		while(++$i<$len)
			$res[]=$this->PrintVariable($arr[$i]);
		return $res;
	}
	
	/**
	 * Say hello demo
	 * 
	 * @param string $name Some name (or an empty string)
	 * @return string Response string
	 */
	public function SayHello($name=null){
		$name=utf8_decode($name);// Because a string parameter may be UTF-8 encoded...
		if($name=='')
			$name='man';
		return utf8_encode('HOLAAAAAAAAAAAA '.$name.'!');// Because a string return value should by UTF-8 encoded...
	}

	/**
	 * This method has no parameters and no return value, but it is visible in WSDL, too
	 */
	public function DemoMethod(){
	}
	
	/**
	 * This method should not be visible in WSDL - but notice:
	 * If the PHP SoapServer doesn't know the WSDL, this method is still accessable for SOAP requests!
	 * 
	 * @ignore
	 * @param unknown_type $var
	 * @return string
	 */
	public function PrintVariable($var){
		return print_r($var,true);
	}
        
        /**
        * service
        * @param string $userID
        * @param string $password
        * @param string $xmlMsg
        * @param string $attachedDoc
        * @return string
        */
	public function receiveMessage($userID,$password,$xmlMsg,$attachedDoc) {
             ini_set("soap.wsdl_cache_enabled", 0);
         $datosTotales= array('request'=>array('userID'=>$userID,'password'=>$password,'xmlMsg'=>$xmlMsg,'attachedDoc'=>$attachedDoc));   
       if($userID == $this->_USER && $password == $this->_PASSWORD) {
             $util = new Server_Util(); 
             $data =  $util->xml2array($xmlMsg);
             $dataForm = array();         
                    switch ($data['MensajeABDCP']['CuerpoMensaje_attr']['IdMensaje']) {
                       case 'ANCP':
                        $dataForm['IdentificacionSolicitud']       = $data['MensajeABDCP']['CuerpoMensaje']['AsignacionNumeroConsultaPrevia']['IdentificacionSolicitud'];
                        $dataForm['FechaRecepcionMensajeAnterior'] = $data['MensajeABDCP']['CuerpoMensaje']['AsignacionNumeroConsultaPrevia']['FechaRecepcionMensajeAnterior'];
                        $dataForm['FechaReferenciaABDCP']          = $data['MensajeABDCP']['CuerpoMensaje']['AsignacionNumeroConsultaPrevia']['FechaReferenciaABDCP'];
                        $dataForm['Numeracion']                    = $data['MensajeABDCP']['CuerpoMensaje']['AsignacionNumeroConsultaPrevia']['Numeracion'];
                        $obj = new Application_Entity_RunSql('Ancp');      
                        $obj->save=$dataForm; 
                        
                        
                         @unlink(APPLICATION_PATH . '/../data/log/Error.xml');
            file_put_contents(
                    APPLICATION_PATH . '/../data/log/Error.xml',json_encode($datosTotales), FILE_APPEND
            );
        return 'valor ingresado ancp';
                           break;
//                       case 'CPRABD':
//                        $dataForm['IdentificacionSolicitud'] = $data['MensajeABDCP']['CuerpoMensaje']['ConsultaPreviaRechazadaABDCP']['IdentificacionSolicitud'];
//                        $dataForm['CausaRechazo']            = $data['MensajeABDCP']['CuerpoMensaje']['ConsultaPreviaRechazadaABDCP']['CausaRechazo'];
//                        $dataForm['Numeracion']              = $data['MensajeABDCP']['CuerpoMensaje']['ConsultaPreviaRechazadaABDCP']['Numeracion'];
//                        $obj = new Application_Entity_RunSql('Ancp');      
//                        $obj->save=$dataForm;      
//                        return 'valor ingresado CPRABD';   
//                           break;
//                       case 'CPPR':
//                        $dataForm['FechaReferenciaABDCP'] = $data['MensajeABDCP']['CuerpoMensaje']['ConsultaPreviaProcedente']['FechaReferenciaABDCP'];
//                        $obj = new Application_Entity_RunSql('Ancp');      
//                        $obj->save=$dataForm; 
//                        return 'valor ingresado CPPR';
//                           break;
//                       case 'ANS':
//                       $dataForm['IdentificacionSolicitud']       = $data['MensajeABDCP']['CuerpoMensaje']['AsignacionNumeroSolicitud']['IdentificacionSolicitud'];
//                       $dataForm['FechaRecepcionMensajeAnterior'] = $data['MensajeABDCP']['CuerpoMensaje']['AsignacionNumeroSolicitud']['FechaRecepcionMensajeAnterior'];
//                       $dataForm['FechaReferenciaABDCP']          = $data['MensajeABDCP']['CuerpoMensaje']['AsignacionNumeroSolicitud']['FechaReferenciaABDCP'];
//                       $dataForm['Numeracion']                    = $data['MensajeABDCP']['CuerpoMensaje']['AsignacionNumeroSolicitud']['Numeracion'];
//                       $obj = new Application_Entity_RunSql('Ancp');      
//                       $obj->save=$dataForm; 
//                       return 'valor ingresado CPPR';
//                           break;
//                       case 'RABDCP':
//                       $dataForm['IdentificacionSolicitud'] = $data['MensajeABDCP']['CuerpoMensaje']['RechazadaABDCP']['IdentificacionSolicitud'];
//                       $dataForm['CausaRechazo']            = $data['MensajeABDCP']['CuerpoMensaje']['RechazadaABDCP']['CausaRechazo'];
//                       $dataForm['Numeracion']              = $data['MensajeABDCP']['CuerpoMensaje']['RechazadaABDCP']['Numeracion'];
//                       $obj = new Application_Entity_RunSql('Ancp');      
//                       $obj->save=$dataForm; 
//                       return 'valor ingresado RABDCP';
//                           break;
//                       case 'SPR':
//                       $dataForm['FechaLimiteProgramacionPortabilidad'] = $data['MensajeABDCP']['CuerpoMensaje']['SolicitudProcedente']['FechaLimiteProgramacionPortabilidad'];
//                       $dataForm['FechaReferenciaABDCP']                = $data['MensajeABDCP']['CuerpoMensaje']['SolicitudProcedente']['FechaReferenciaABDCP'];
//                       $obj = new Application_Entity_RunSql('Ancp');      
//                       $obj->save=$dataForm; 
//                       return 'valor ingresado SPR'; 
//                           break;
//                       case 'CPSPR':
//                       $dataForm['FechaLimiteProgramacionPortabilidad'] = $data['MensajeABDCP']['CuerpoMensaje']['SolicitudProcedenteConsultaPreviaProcedente']['FechaLimiteProgramacionPortabilidad'];
//                       $dataForm['FechaLimiteEjecucionPortabilidad']    = $data['MensajeABDCP']['CuerpoMensaje']['SolicitudProcedenteConsultaPreviaProcedente']['FechaLimiteEjecucionPortabilidad'];
//                       $dataForm['FechaReferenciaABDCP']                = $data['MensajeABDCP']['CuerpoMensaje']['SolicitudProcedenteConsultaPreviaProcedente']['FechaReferenciaABDCP'];
//                       $dataForm['NumeroConsultaPrevia']                = $data['MensajeABDCP']['CuerpoMensaje']['SolicitudProcedenteConsultaPreviaProcedente']['NumeroConsultaPrevia'];
//                       $obj = new Application_Entity_RunSql('Ancp');      
//                       $obj->save=$dataForm; 
//                       return 'valor ingresado CPSPR';
//                           break;
//                       case 'CNPF':
//                           return  "CNPF CNPF";
//                           break;
                       case 'PEP':
                       $dataForm['FechaEjecucionPortabilidad'] = $data['MensajeABDCP']['CuerpoMensaje']['ProgramadaEjecutarPortabilidad']['FechaEjecucionPortabilidad'];
                       $obj = new Application_Entity_RunSql('Ancp');      
                       $obj->save=$dataForm; 
                       
                       
                       
                       
                     
      
                       return 'valor ingresado PEP';  
                           break;
                       default:
                           
                            @unlink(APPLICATION_PATH . '/../data/log/Error.xml');
            file_put_contents(
                    APPLICATION_PATH . '/../data/log/Error.xml',json_encode($datosTotales) , FILE_APPEND
            );

                       
                         return 'valor ingresado PEP';      
                   }

            } else {
                
         $this->_clienteCip = new Zend_Soap_Client(
                'http://local.portabilidad/MOCHEWebApp/services/MOCHEWebService?wsdl'
              );       
                 @unlink(APPLICATION_PATH . '/../data/log/Error.xml');
            file_put_contents(
                    APPLICATION_PATH . '/../data/log/Error.xml',json_encode($datosTotales), FILE_APPEND
            );

            
               
            return 'datos incorrectos'; 
           }
                
	}
        
        
        
        
}
