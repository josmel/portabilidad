<?php

class Application_Model_DbTable_Flep extends Core_Db_Table
{
    protected $_name = 'tFlep';
    protected $_primary = "idtFlep";
    const NAMETABLE='tFlep';
    
    public function __construct($config = array(), $definition = null) {
        parent::__construct($config, $definition);
    }
    
    static function populate($params)
    {
        $data = array();
        if(isset($params['IdentificadorMensaje'])) $data['IdentificadorMensaje'] = $params['IdentificadorMensaje'];
        if(isset($params['Remitente'])) $data['Remitente'] = $params['Remitente'];
        if(isset($params['Destinatario'])) $data['Destinatario'] = $params['Destinatario'];
        if(isset($params['FechaCreacionMensaje'])) $data['FechaCreacionMensaje'] = $params['FechaCreacionMensaje'];
        if(isset($params['IdentificadorProceso'])) $data['IdentificadorProceso'] = $params['IdentificadorProceso'];
        if(isset($params['FechaLimiteProgramacionPortabilidad'])) $data['FechaLimiteProgramacionPortabilidad'] = $params['FechaLimiteProgramacionPortabilidad'];
        if(isset($params['FechaLimiteEjecucionPortabilidad'])) $data['FechaLimiteEjecucionPortabilidad'] = $params['FechaLimiteEjecucionPortabilidad'];
        if(isset($params['idtAns'])) $data['idtAns'] = $params['idtAns'];
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

