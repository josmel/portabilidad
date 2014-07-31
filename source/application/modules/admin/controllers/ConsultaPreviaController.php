<?php

class Admin_ConsultaPreviaController extends Core_Controller_ActionAdmin {

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
        $obj = new Application_Entity_DataTable('Cp',$iDisplayLength, $sEcho, true, 'tCp');
        $obj->setIconAction($this->action());
        $query = "";
        $query.=!empty($sSearch) ? " AND NumeracionSolicitada like '%" . $sSearch . "%' " : " ";
        $obj->setSearch($query);
        $this->getResponse()
                ->setHttpResponseCode(200)
                ->setHeader('Content-type', 'application/json;charset=UTF-8', true)
                ->appendBody(json_encode($obj->getQuery($iDisplayStart, $iDisplayLength)));
    }

    public function editAction() {
        $id = $this->_getParam('id', 0);
        $modelAncp = new Admin_Model_Ancp();
        $dataAncp = $modelAncp->statusCpIdentificacionSolicitud($id);
        $dataCprabd = '';
        $dataCppr = '';
        if ($dataAncp) {
            $modelCprabd = new Admin_Model_Cprabd();
            $dataCprabd = $modelCprabd->statusCprabdIdentificacionSolicitud($dataAncp['iancp']);
            $modelCppr = new Admin_Model_Cppr();
            $dataCppr = $modelCppr->statusCpprIdentificacionSolicitud($dataAncp['iancp']);
        }
        if ($dataCprabd) {
            $modelError = new Admin_Model_Error();
            $dataError = $modelError->errorDescripcion($dataCprabd['CausaRechazo']);
            $dataCprabd['CausaRechazo']=$dataError['descripcion'];
            $this->view->cprabd = $dataCprabd;
        }
        if ($dataCppr) {
            $this->view->cppr = $dataCppr;
        }
        $this->view->ancp = $dataAncp;
    }

  
    public function newAction() {
        
//           $P59u1=     base64_encode('P59u1');  130   UDU5dTE= desarrollo
//      echo $P59u1 ;
//         $P59u1D=     base64_encode('P59u1D'); 33     UDU5dTFE  produccion
//         echo "\n";
//         echo $P59u1D;
        $form = new Admin_Form_Cp();
        $obj = new Application_Entity_RunSql('Cp');
        if ($this->_request->isPost()) {
            $dataForm = $this->_request->getPost();
            try {
                $msj = array();
                $xmlMsgSP = $this->_GetResultXml->_ConsultaPrevia($dataForm,$this->_config['resources']['view']['cp']);
                $resultSP = $this->_GetResultSoap->_receiveMessage($xmlMsgSP);
                if ($resultSP == 'ack') {
                    $util = new Server_Util();
                    $data = $util->xml2array($xmlMsgSP);
                    $dataForm['IdentificadorMensaje'] = $data['MensajeABDCP']['CabeceraMensaje']['IdentificadorMensaje'];
                    $dataForm['Remitente'] = $data['MensajeABDCP']['CabeceraMensaje']['Remitente'];
                    $dataForm['Destinatario'] = $data['MensajeABDCP']['CabeceraMensaje']['Destinatario'];
                    $dataForm['FechaCreacionMensaje'] = $data['MensajeABDCP']['CabeceraMensaje']['FechaCreacionMensaje'];
                    $dataForm['IdentificadorProceso'] = $data['MensajeABDCP']['CabeceraMensaje']['IdentificadorProceso'];
                    $obj->save = $dataForm;
                } else {
                    $this->_flashMessenger->success($resultSP);
                     $this->_redirect('/cp/new');
                }
                $this->_redirect('/cp');
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } else {
            $this->view->titulo = "Nueva Consulta Previa";
            $this->view->submit = "Consultar";
            $this->view->action = "/cp/new";
            $form->addDecoratorCustom('forms/_formCp.phtml');
            echo $form;
        }
    }

    public function deleteAction() {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $id = $this->getParam('id');
        $rpta = array();
        if (!empty($id)) {
            try {
                $obj = new Application_Entity_RunSql('Help');
                $obj->edit = array('vchestado' => 'D', $obj->getPK() => $id);
                $rpta['msj'] = 'ok';
            } catch (Exception $e) {
                $rpta['msj'] = $e->getMessage();
            }
        } else {
            $rpta['msj'] = 'faltan datos';
        }
        $this->getResponse()
                ->setHttpResponseCode(200)
                ->setHeader('Content-type', 'application/json; charset=UTF-8', true)
                ->appendBody(json_encode($rpta));
    }

    function action() {
        $action = "<a class=\"tblaction ico-edit\" title=\"Historial\" href=\"/cp/history?id=__ID__\">Historial</a>
                    <a data-id=\"__ID__\" class=\"tblaction ico-delete\" title=\"Eliminar\"  href=\"/quiz/delete\">Eliminar</a>";
        return $action;
    }

}
