<?php
  ini_set("soap.wsdl_cache_enabled", 0);
/**
 * Esta clase contiene la función que será utilizado por el servicio de llamadas Web.
 * Todas las lógicas empresariales serán implented o llama en estas funciones. 
 * 
 * @author Josmel Yupanqui
 *
 */
  
     /**
        * MOCHE Web service
        
      */
      
class Server_Data  {
    
      private $_USER       = "";
      private $_PASSWORD   = "";
 
      public function __construct() {
      //  $this->_config   = Zend_Registry::get('config');
       // $this->_USER     =  $this->_config['resources']['view']['userIdServer'];
       $this->_USER     =  '59u1';
       //  $this->_USER     =  $this->_config['resources']['view']['userIdServer'];  
       $this->_PASSWORD = base64_encode('P59u1');
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

