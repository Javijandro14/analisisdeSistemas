<?php
$servername = "JAVIER";
$user = "user1";
$pass = "1234";
$db = "FRESHSERVICEDB";

$conInfo = array('Database' => $db,'UID' => $user,'PWD' => $pass);
//Crea la conexion a la base de datos
$con = sqlsrv_connect($servername, $conInfo);
//Revisa la conexion creada
if($con === false){
    die(print_r(sqlsrv_errors(),true));
}
?>