<?php

class Application_Model_DbTable_Rabdcp extends Core_Db_Table
{
    protected $_name = 'tRabdcp';
    protected $_primary = "idtRabdcp";
    const NAMETABLE = 'tRabdcp';
    
    public function __construct($config = array(), $definition = null) {
        parent::__construct($config, $definition);
    }
    
    static function populate($params) {
        $data = array();
        if(isset($params['IdentificadorMensaje'])) $data['IdentificadorMensaje'] = $params['IdentificadorMensaje'];
        if(isset($params['Remitente'])) $data['Remitente'] = $params['Remitente'];
        if(isset($params['Destinatario'])) $data['Destinatario'] = $params['Destinatario'];
        if(isset($params['FechaCreacionMensaje'])) $data['FechaCreacionMensaje'] = $params['FechaCreacionMensaje'];
        if(isset($params['IdentificadorProceso'])) $data['IdentificadorProceso'] = $params['IdentificadorProceso'];
        if(isset($params['IdentificacionSolicitud'])) $data['IdentificacionSolicitud'] = $params['IdentificacionSolicitud'];
        if(isset($params['CausaRechazo'])) $data['CausaRechazo'] = $params['CausaRechazo'];
        if(isset($params['Numeracion'])) $data['Numeracion'] = $params['Numeracion'];
        if(isset($params['idtAns'])) $data['idtAns'] = $params['idtAns'];
        return $data;

    }
    
    /**
     * 
     * @param obj DB $resulQuery
     */
    public function columnDisplay()
    {
        return array("pregunta", "IF(vchestado LIKE 'A', 'Activo', 'Inactivo')");
    }
        
    public function getPrimaryKey() {
        return $this->_primary;
    }
    
    public function getWhereActive() {
        return " AND NOT vchestado LIKE 'D'";
    }
    
    public function insert(array $data) {
        if($data['vchestado'] == 'A') {
            //Deshabilitar resto
            $where = $this->getDefaultAdapter()->quoteInto('idayuda LIKE ?', $data['idayuda']);
            $this->update(array('vchestado' => 'I'), $where);
        } 
        
        parent::insert($data);
    }
    
    public function update(array $data, $where) {
        if($data['vchestado'] == 'A' && isset($data['codtvideo'])) {
            //Deshabilitar idayuda
            $whereActive = $this->getDefaultAdapter()->quoteInto('idayuda LIKE ?', $data['idayuda']);
            $this->update(array('vchestado' => 'I'), $whereActive);
        } 
        parent::update($data, $where);
    }
}

