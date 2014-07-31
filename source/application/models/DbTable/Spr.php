<?php

class Application_Model_DbTable_Spr extends Core_Db_Table
{
    protected $_name = 'tSpr';
    protected $_primary = "idtSpr";
    const NAMETABLE = 'tSpr';
    
    public function __construct($config = array(), $definition = null) {
        parent::__construct($config, $definition);
        //$this->setDefaultAdapter(Zend_Registry::get('dbAdmin'));
      //  $this->_setAdapter(Zend_Registry::get('dbAdmin'));
    }
    
    static function populate($params) {
        $data = array();
        if(isset($params['IdentificadorMensaje'])) $data['IdentificadorMensaje'] = $params['IdentificadorMensaje'];
        if(isset($params['Remitente'])) $data['Remitente'] = $params['Remitente'];
        if(isset($params['Destinatario'])) $data['Destinatario'] = $params['Destinatario'];
        if(isset($params['FechaCreacionMensaje'])) $data['FechaCreacionMensaje'] = $params['FechaCreacionMensaje'];
        if(isset($params['IdentificadorProceso'])) $data['IdentificadorProceso'] = $params['IdentificadorProceso'];
        if(isset($params['FechaLimiteProgramacionPortabilidad'])) $data['FechaLimiteProgramacionPortabilidad'] = $params['FechaLimiteProgramacionPortabilidad'];
        if(isset($params['FechaLimiteEjecucionPortabilidad'])) $data['FechaLimiteEjecucionPortabilidad'] = $params['FechaLimiteEjecucionPortabilidad'];
        if(isset($params['FechaReferenciaABDCP'])) $data['FechaReferenciaABDCP'] = $params['FechaReferenciaABDCP'];
        if(isset($params['idtAns'])) $data['idtAns'] = $params['idtAns'];
        if(isset($params['idtEsc'])) $data['idtEsc'] = $params['idtEsc']; 
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

