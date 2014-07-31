<?php

class Application_Model_DbTable_Esc extends Core_Db_Table
{
    protected $_name = 'tEsc';
    protected $_primary = "idtEsc";
    const NAMETABLE='tEsc';
    
    public function __construct($config = array(), $definition = null) {
        parent::__construct($config, $definition);
    }
    
    static function populate($params)
    {
        $data = array();
        if(isset($params['IdentificadorMensaje'])) $data['IdentificadorMensaje'] = $params['IdentificadorMensaje'];
        if(isset($params['Remitente'])) $data['Remitente']                       = $params['Remitente'];
        if(isset($params['Destinatario'])) $data['Destinatario']                 = $params['Destinatario'];
        if(isset($params['FechaCreacionMensaje'])) $data['FechaCreacionMensaje'] = $params['FechaCreacionMensaje'];
        if(isset($params['IdentificadorProceso'])) $data['IdentificadorProceso'] = $params['IdentificadorProceso'];
        if(isset($params['FechaReferenciaABDCP'])) $data['FechaReferenciaABDCP'] = $params['FechaReferenciaABDCP'];
        if(isset($params['Numeracion'])) $data['Numeracion']                     = $params['Numeracion'];
        if(isset($params['CodigoReceptor'])) $data['CodigoReceptor']             = $params['CodigoReceptor'];
        if(isset($params['CodigoCedente'])) $data['CodigoCedente']               = $params['CodigoCedente'];
        if(isset($params['TipoDocumentoIdentidad'])) $data['TipoDocumentoIdentidad'] = $params['TipoDocumentoIdentidad'];
        if(isset($params['NumeroDocumentoIdentidad'])) $data['NumeroDocumentoIdentidad'] = $params['NumeroDocumentoIdentidad'];
        if(isset($params['TipoPortabilidad'])) $data['TipoPortabilidad']         = $params['TipoPortabilidad'];
        if(isset($params['TipoServicio'])) $data['TipoServicio']                 = $params['TipoServicio'];
        if(isset($params['NombreContacto'])) $data['NombreContacto']             = $params['NombreContacto'];
        if(isset($params['EmailContacto'])) $data['EmailContacto']               = $params['EmailContacto'];
        if(isset($params['TelefonoContacto'])) $data['TelefonoContacto']         = $params['TelefonoContacto'];
        if(isset($params['FaxContacto'])) $data['FaxContacto']                   = $params['FaxContacto'];
      
        
        
        return $data;
    }

    /**
     * 
     * @param obj DB $resulQuery
     */
    public function columnDisplay()
    {
        return array('IdentificadorProceso','NumeroDocumentoIdentidad','Numeracion','TipoPortabilidad','TipoServicio');
    }
        
    public function getPrimaryKey()
    {
        return $this->_primary;
    }
    
    public function getWhereActive()
    {
        return " AND state= 1";
    }
}

