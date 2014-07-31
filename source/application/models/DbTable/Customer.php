<?php

class Application_Model_DbTable_Customer extends Core_Db_Table
{
    protected $_name = 'tcliente';
    protected $_primary = "idtcliente";
    const NAMETABLE = 'tcliente';
    
    public function __construct($config = array(), $definition = null) {
        parent::__construct($config, $definition);
    }
    
    static function populate($params) {
        $data = array();
        if(isset($params['telefono'])) $data['telefono'] = $params['telefono'];
        if(isset($params['dni'])) $data['dni'] = $params['dni'];
        if(isset($params['tipoServicio'])) $data['tipoServicio'] = $params['tipoServicio'];
        if(isset($params['estado'])) $data['estado'] = $params['estado'];
        if(isset($params['deuda'])) $data['deuda'] = $params['deuda'];
        if(isset($params['tipoPortabilidad'])) $data['tipoPortabilidad'] = $params['tipoPortabilidad'];
        if(isset($params['baja'])) $data['baja'] = $params['baja'];
        return $data;
    }
    
    /**
     * 
     * @param obj DB $resulQuery
     */
    public function columnDisplay()
    {
        return array("telefono","dni", "IF(tipoServicio LIKE '1', 'Móvil', 'Fijo')","IF(tipoPortabilidad LIKE '01', 'Prepago', 'Pospago')");
    }
        
    public function getPrimaryKey() {
        return $this->_primary;
    }
    
//    public function getWhereActive() {
//        return " AND NOT vchestado LIKE 'D'";
//    }
    public function getWhereActive()
    {
        return " AND estado= 1";
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

