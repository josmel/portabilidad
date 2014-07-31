<?php

ini_set("soap.wsdl_cache_enabled", "0"); // disabling WSDL cache
$server = new SoapServer("http://local.portabilidad/static/moche.wsdl");	// Locate WSDL file to learn structure of functions
$server->addFunction("receiveMessage");	// Same func name as in our WSDL XML, and below
$server->handle();  

function receiveMessage($formdata) { 
    $attempt = false; // File writing attempt successful or not
    $formdata = get_object_vars($formdata); // Pull parameters from SOAP connection
    
    // Sort out the parameters and grab their data
    $myname = $formdata['userID']; 
    $mycolour = $formdata['password'];
    $mynumber = $formdata['xmlMsg'];
    
   
    
    $str =  "userID: " . $myname . ", ";
    $str .= "password: " . $mycolour . ", ";
    $str .= "xmlMsg: " . $mynumber . "\r\n";
   
//    $filename = "./formdata.txt";
//    if (($fp = fopen($filename, "a")) == false) return array('Success' => false);
//    if (fwrite($fp, $str)) {
//    	$attempt = "ack";
//    }
//    fclose($fp);     
  
    $attempt = "ack";
   return array('response' => $attempt);
   //return "ack";
}

?>
