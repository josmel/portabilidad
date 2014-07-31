<?php

class Admin_SolicitudConsultaPreviaController extends Core_Controller_ActionAdmin {

    public function init() {
        parent::init();
        $this->_config = Zend_Registry::get('config');
        $this->_GetResultSoapPruebas = $this->_helper->getHelper('GetResultSoapPruebas');
        $this->_GetResultXml = $this->_helper->getHelper('GetResultXml');
        $this->_GetResultSoap = $this->_helper->getHelper('GetResultSoap');
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
        $obj = new Application_Entity_DataTable('Ecpc',$iDisplayLength, $sEcho, true, 'tEcpc');
        $obj->setIconAction($this->action());
        $query = "";
        $query.=!empty($sSearch) ? " AND Numeracion like '%" . $sSearch . "%' " : " ";
        $obj->setSearch($query);
        $this->getResponse()
                ->setHttpResponseCode(200)
                ->setHeader('Content-type', 'application/json;charset=UTF-8', true)
                ->appendBody(json_encode($obj->getQuery($iDisplayStart, $iDisplayLength)));
    }

    
    function action() {
        $action = "<a class=\"tblaction ico-edit\" title=\"Historial\" href=\"/ecpc\">Historial</a>";
        return $action;
    }

}
