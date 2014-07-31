<?php

class Application_Model_DbTable_Cp extends Core_Db_Table
{
    protected $_name = 'tCp';
   // protected $_nameUserRoles = 'tusers_to_roles';
    protected $_primary = "idtCp";
    const NAMETABLE='tCp';
    
    public function __construct($config = array(), $definition = null) {
        parent::__construct($config, $definition);
        //$this->setDefaultAdapter(Zend_Registry::get('dbAdmin'));
       // $this->_setAdapter(Zend_Registry::get('portabilidad'));
    }
    
    static function populate($params)
    {
        $data = array();
        if(isset($params['CodigoCedente'])) $data['CodigoCedente'] = $params['CodigoCedente'];
        if(isset($params['TipoDocumentoIdentidad'])) $data['TipoDocumentoIdentidad'] = $params['TipoDocumentoIdentidad'];
        if(isset($params['NumeroDocumentoIdentidad'])) $data['NumeroDocumentoIdentidad'] = $params['NumeroDocumentoIdentidad'];
        if(isset($params['CantidadNumeraciones'])) $data['CantidadNumeraciones'] = $params['CantidadNumeraciones'];
        if(isset($params['NumeracionSolicitada'])) $data['NumeracionSolicitada'] = $params['NumeracionSolicitada'];
        if(isset($params['NombreContacto'])) $data['NombreContacto'] = $params['NombreContacto'];
        if(isset($params['EmailContacto'])) $data['EmailContacto'] = $params['EmailContacto'];
        if(isset($params['TelefonoContacto'])) $data['TelefonoContacto'] = $params['TelefonoContacto'];
        if(isset($params['FaxContacto'])) $data['FaxContacto'] = $params['FaxContacto'];
        if(isset($params['TipoServicio'])) $data['TipoServicio'] = $params['TipoServicio'];
        if(isset($params['TipoPortabilidad'])) $data['TipoPortabilidad'] = $params['TipoPortabilidad'];
        if(isset($params['Cliente'])) $data['Cliente'] = $params['Cliente'];
        if(isset($params['IdentificadorMensaje'])) $data['IdentificadorMensaje'] = $params['IdentificadorMensaje'];
        if(isset($params['Remitente'])) $data['Remitente'] = $params['Remitente'];
        if(isset($params['Destinatario'])) $data['Destinatario'] = $params['Destinatario'];
        if(isset($params['FechaCreacionMensaje'])) $data['FechaCreacionMensaje'] = $params['FechaCreacionMensaje'];
        if(isset($params['IdentificadorProceso'])) $data['IdentificadorProceso'] = $params['IdentificadorProceso'];
        if(isset($params['tipo'])) $data['tipo'] = $params['tipo'];
        $data=  array_filter($data);
        return $data;
    }

  
    /**
     * 
     * @param obj DB $resulQuery
     */
    public function columnDisplay()
    {
        return array('IdentificadorProceso','CodigoCedente','NumeracionSolicitada');
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

