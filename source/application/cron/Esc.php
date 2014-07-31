<?php

define("CONSOLE", true);
require_once realpath(dirname(__FILE__) . '/../../public') . '/index.php';
sleep(3);
$servicio = new App_Controller_Action_Helper_GetResultSoap();
$cuerpoMensaje = new App_Controller_Action_Helper_GetResultXml();
$Esc = new Admin_Model_Esc();
$datEsc = $Esc->listaStateTrue($argv[1]);
if ($datEsc) {
    $Customer = new Admin_Model_Customer();
    $datCustomer = $Customer->getCustomerNumber($datEsc);
    if ($datCustomer == 'ack') {
        $xmlMsgESC = $cuerpoMensaje->_SolicitudAceptadaCedente($datEsc['Numeracion'], '01', $argv[1]);
    } else {
        $datEsc['ERROR'] = $datCustomer;
        $xmlMsgESC = $cuerpoMensaje->_ObjecionConcesionarioCedente($datEsc, '01', $argv[1]);
    }
     $enviarMensaje = $servicio->_receiveMessage($xmlMsgESC);
} else {
    $enviarMensaje = 'no hay registro en el ESC';
}
echo  "\n".$enviarMensaje."\n";
exit;