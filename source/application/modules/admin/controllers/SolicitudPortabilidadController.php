<?php

class Admin_SolicitudPortabilidadController extends Core_Controller_ActionAdmin {

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
        $obj = new Application_Entity_DataTable('Sp', $iDisplayLength, $sEcho, true, 'tSp');
        $obj->setIconAction($this->action());
        $query = "";
        $query.=!empty($sSearch) ? " AND NumeracionSolicitada like '%" . $sSearch . "%' " : " ";
        $obj->setSearch($query);
        $this->getResponse()
                ->setHttpResponseCode(200)
                ->setHeader('Content-type', 'application/json;charset=UTF-8', true)
                ->appendBody(json_encode($obj->getQuery($iDisplayStart, $iDisplayLength)));
    }

    public function newAction() {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $id = $this->_getParam('id', 0);
        $modelCp = new Admin_Model_Cp();
        $dataForm= $modelCp->dataAllTotal($id);
        $obj = new Application_Entity_RunSql('Sp');
        $xmlMsgSP = $this->_GetResultXml->_SolicitudPortabilidadXml($dataForm,$this->_config['resources']['view']['sp']);
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
                    $this->_redirect('/cp/history?id='.$id);
        }
        $this->_redirect('/sp');
    }
    public function editAction() {
           $id = $this->_getParam('id', 0);
           $modelAns = new Admin_Model_Ans();
           $dataAns = $modelAns->statusSpIdentificacionSolicitud($id);
           $dataRabdcp = '';
           $dataSpr = '';
           $dataPep = '';
           $dataFlep = '';
           if ($dataAns) {
               $modelRabdcp = new Admin_Model_Rabdcp();
               $dataRabdcp = $modelRabdcp->statusRabdcpIdentificacionSolicitud($dataAns['idtAns']);
               $modelSpr= new Admin_Model_Spr();
               $dataSpr = $modelSpr->statusSprIdentificacionSolicitud($dataAns['idtAns']);
               $modelPep= new Admin_Model_Pep();
               $dataPep = $modelPep->statusPepIdentificacionSolicitud($dataAns['idtAns']);
               $modelFlep= new Admin_Model_Flep();
               $dataFlep = $modelFlep->statusFlepIdentificacionSolicitud($dataAns['idtAns']);
           }
           if ($dataPep) {
                $FechaEjecucionPortabilidad = new DateTime($dataPep['FechaEjecucionPortabilidad']);
            $dataPep['FechaEjecucionPortabilidad']= $FechaEjecucionPortabilidad->format('d/m/Y - H:i:s');
                      $FechaCreacionMensaje = new DateTime($dataPep['FechaCreacionMensaje']);
           $dataPep['FechaCreacionMensaje']= $FechaCreacionMensaje->format('d/m/Y - H:i:s');
               $this->view->pep = $dataPep;
           }
           if ($dataFlep) {
               $this->view->flep = $dataFlep;
           }
            if ($dataRabdcp) {
              $modelError = new Admin_Model_Error();
              $dataError = $modelError->errorDescripcion($dataRabdcp['CausaRechazo']);
              $dataRabdcp['CausaRechazo']=$dataError['descripcion'];
               $this->view->rabdcp = $dataRabdcp;
           }
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
           $this->view->ans = $dataAns;
       }
       
       
      public function scheduleAction() {
        $id = $this->_getParam('id', 0);
        $modelSp= new Admin_Model_Ans();
        $dataSp = $modelSp->statusAnsId($id);
        $modelSpr= new Admin_Model_Spr();
        $dataSpr = $modelSpr->statusSprIdentificacionSolicitud($id);
        $HoraDia= substr($dataSpr["FechaLimiteProgramacionPortabilidad"],0, 8);
       // $data=date("YmdHis");
        $xmlMsgSP = $this->_GetResultXml->_ProgramacionPortabilidad($HoraDia.'010000',$this->_config['resources']['view']['sp'],$dataSp["IdentificacionSolicitud"]);
        $resultSP= $this->_GetResultSoap->_receiveMessage($xmlMsgSP); 
         if ($resultSP == 'ack') {
                   $this->_flashMessenger->success('Programacion guardada correctamente');  
          } else {
                    $this->_flashMessenger->success($resultSP);
         }  
         $this->_redirect('/sp/history?id='.$dataSp["idtSp"]);
    } 
       
    
       
    function action() {
        $action = "<a class=\"tblaction ico-edit\" title=\"Historial\" href=\"/sp/history?id=__ID__\">Historial</a>
                    <a data-id=\"__ID__\" class=\"tblaction ico-delete\" title=\"Eliminar\"  href=\"/quiz/delete\">Eliminar</a>";
        return $action;
    }

}
