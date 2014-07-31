<?php
define("CONSOLE", true);
require_once realpath(dirname(__FILE__) . '/../../public') . '/index.php';
$writer = new Zend_Log_Writer_Stream(
        APPLICATION_PATH . '/cron/log/Rcp.log');
$log = new Zend_Log($writer);

$log->info("------------ Inicio cron --------------");
$log->info("");
// ini_set('max_execution_time', 120);
try {
    sleep(3);
    $primer_valor = $argv[1];
    $segundo_valor = $argv[2];
    $Server = new Zend_Soap_Client('https://10.209.3.130/ABDCPWebApp/services/ABDCPWebService?wsdl');
    $Ecpc = new Admin_Model_Ecpc($argv[1]);
    $datEcpc = $Ecpc->listaStateTrue();
    $Customer = Admin_Model_Customer();
    foreach ($echo as $vat) {
        $datCustomer = $Customer->getCustomerActive($vat['Numeracion'],$vat['NumeroDocumentoIdentidad']);
        if ($datCustomer) {
            if (date('Y-m-d H:i:s', (strtotime($vat['dateEvent'] . " + 1 hours "))) < $startone) {
                $Server->receaveMesseage();
                echo $vat['idUser'] . '\n';
                $log->info('desactivo evento del  title: ' . $vat['title'] . ' idEvent: ' . $vat['idEvent']);
                $objEU->updateEvent($vat['idEvent']);
            } else {
            }
        }
    }
} catch (Exception $e) {
    $log->info('Error de Base de datos ' . $e->getMessage());
}
$log->info("");
$log->info("---------- FIN DE CRON --------");
//ini_set('max_execution_time', 30);
exit;

