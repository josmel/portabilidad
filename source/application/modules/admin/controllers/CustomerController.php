<?php

class Admin_CustomerController extends Core_Controller_ActionAdmin {

    public function init() {
        parent::init();
        $this->_config = Zend_Registry::get('config');
    }

    public function indexAction() {
        
    }

    public function listAction() {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $params = $this->_getAllParams();
        $iDisplayStart = isset($params['iDisplayStart']) ? $params['iDisplayStart'] : null;
        $iDisplayLength = isset($params['iDisplayLength']) ? $params['iDisplayLength'] : null;
        $sEcho = isset($params['sEcho']) ? $params['sEcho'] : 1;
        $sSearch = isset($params['sSearch']) ? $params['sSearch'] : '';
        $obj = new Application_Entity_DataTable('Customer',$iDisplayLength, $sEcho, true, 'tcliente');
        $obj->setIconAction($this->action());
        $query = "";
        $query.=!empty($sSearch) ? " AND telefono like '%" . $sSearch . "%' " : " ";
        $obj->setSearch($query);
        $this->getResponse()
                ->setHttpResponseCode(200)
                ->setHeader('Content-type', 'application/json;charset=UTF-8', true)
                ->appendBody(json_encode($obj->getQuery($iDisplayStart, $iDisplayLength)));
    }

    
    function action() {
        $action = "<a class=\"tblaction ico-edit\" title=\"Historial\" href=\"/customer\">Historial</a>";
        return $action;
    }

}
