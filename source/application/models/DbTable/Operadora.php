<?php

class Application_Model_DbTable_Operadora extends Core_Db_Table
{
    protected $_name = 'tOperadoras';
    protected $_primary = "idtOperadoras";
    const NAMETABLE='tOperadoras';
    
    public function __construct($config = array(), $definition = null) {
        parent::__construct($config, $definition);
    }
    
    static function populate($params)
    {
        $data = array();
        if(isset($params['nombre'])) $data['nombre'] = $params['nombre'];
        if(isset($params['codigo'])) $data['codigo'] = $params['codigo'];
        return $data;
    }

  
    /**
     * 
     * @param obj DB $resulQuery
     */
    
    public function getPrimaryKey()
    {
        return $this->_primary;
    }
    
    public function getWhereActive()
    {
        return " AND state= 1";
    }
}

