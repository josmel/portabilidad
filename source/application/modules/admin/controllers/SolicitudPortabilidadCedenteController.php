<?php

class Admin_SolicitudPortabilidadCedenteController extends Core_Controller_ActionAdmin {

    public function init() {
        parent::init();
        $this->_config = Zend_Registry::get('config');
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
        $obj = new Application_Entity_DataTable('Esc',$iDisplayLength, $sEcho, true, 'tEsc');
        $obj->setIconAction($this->action());
        $query = "";
        $query.=!empty($sSearch) ? " AND Numeracion like '%" . $sSearch . "%' " : " ";
        $obj->setSearch($query);
        $this->getResponse()
                ->setHttpResponseCode(200)
                ->setHeader('Content-type', 'application/json;charset=UTF-8', true)
                ->appendBody(json_encode($obj->getQuery($iDisplayStart, $iDisplayLength)));
    }

    
      public function editAction() {
               $id = $this->_getParam('id', 0);
               $modelSpr= new Admin_Model_Spr();
               $dataSpr = $modelSpr->statusEsc($id);
          
           if ($dataSpr) {
            $fechaIdentificacionSolicitud = new DateTime($dataSpr['FechaLimiteProgramacionPortabilidad']);
            $fechaFechaRecepcionMensajeAnterior = new DateTime($dataSpr['FechaLimiteEjecucionPortabilidad']);
            $fechaFechaReferenciaABDCP = new DateTime($dataSpr['FechaReferenciaABDCP']);
            $dataSprTotal= array('FechaLimiteProgramacionPortabilidad' => $fechaIdentificacionSolicitud->format('d/m/Y - H:i:s'),
                                    'FechaLimiteEjecucionPortabilidad' => $fechaFechaRecepcionMensajeAnterior->format('d/m/Y - H:i:s'),
                                                'FechaReferenciaABDCP' => $fechaFechaReferenciaABDCP->format('d/m/Y - H:i:s'),
                                                'IdentificadorProceso' => $dataSpr['IdentificadorProceso'],
                                                 'idtSpr' => $dataSpr['idtSpr'], 
                );
            $this->view->Spr = $dataSprTotal;
           }
           
       }
    
    
    
    
    
    
    function action() {
        $action = "<a class=\"tblaction ico-edit\" title=\"Historial\" href=\"/esc/history?id=__ID__\">Historial</a>
                    <a data-id=\"__ID__\" class=\"tblaction ico-delete\" title=\"Eliminar\"  href=\"/quiz/delete\">Eliminar</a>";
        return $action;
    }

}
