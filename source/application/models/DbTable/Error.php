<?php

class Application_Model_DbTable_Error extends Core_Db_Table
{
    protected $_name = 'tError';
    protected $_primary = "idtError";
    const NAMETABLE='tError';
    
    public function __construct($config = array(), $definition = null) {
        parent::__construct($config, $definition);
    }
    
    static function populate($params)
    {
        $data = array();
        if(isset($params['codigo'])) $data['codigo'] = $params['codigo'];
        if(isset($params['descripcion'])) $data['descripcion'] = $params['descripcion'];
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

