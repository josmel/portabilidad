<?php

class Application_Model_DbTable_Cprabd extends Core_Db_Table
{
    protected $_name = 'tCprabd';
    protected $_primary = "idtCprabd";
    const NAMETABLE='tCprabd';
    
    public function __construct($config = array(), $definition = null) {
        parent::__construct($config, $definition);
    }
    
    static function populate($params)
    {
        $data = array();
        if(isset($params['IdentificacionSolicitud'])) $data['IdentificacionSolicitud'] = $params['IdentificacionSolicitud'];
        if(isset($params['CausaRechazo'])) $data['CausaRechazo'] = $params['CausaRechazo'];
        if(isset($params['Numeracion'])) $data['Numeracion'] = $params['Numeracion'];
        if(isset($params['idancp'])) $data['idancp'] = $params['idancp'];
        if(isset($params['IdentificadorProceso'])) $data['IdentificadorProceso'] = $params['IdentificadorProceso'];
        if(isset($params['IdentificadorMensaje'])) $data['IdentificadorMensaje'] = $params['IdentificadorMensaje'];
        if(isset($params['Remitente'])) $data['Remitente'] = $params['Remitente'];
        if(isset($params['Destinatario'])) $data['Destinatario'] = $params['Destinatario'];
        if(isset($params['FechaCreacionMensaje'])) $data['FechaCreacionMensaje'] = $params['FechaCreacionMensaje'];
       
        $data=  array_filter($data);
        return $data;
    }

  
    /**
     * 
     * @param obj DB $resulQuery
     */
    public function columnDisplay()
    {
        return array("CONCAT(name, ' ', apepat, ' ', apemat)",'email',"IF(state=1, 'Activo', 'Inactivo')");
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

