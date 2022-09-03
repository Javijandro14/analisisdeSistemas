<?php
include 'conexion.php';


$search = $_GET['q'];
$option = $_GET['option'];

if($option == "1"){
    $sql = "SELECT U.ID_USER, U.EMAIL FROM [TBLUSER] U WHERE U.EMAIL LIKE '%" . $search . "%'" ;
    $usuarios = sqlsrv_query($con, $sql);
    $html = "";
    while ($user = sqlsrv_fetch_array($usuarios, SQLSRV_FETCH_NUMERIC)) {
        $html .= "<button type='button' class='btn btn-outline-info btn-block' onclick='setResult(this.innerHTML)'>" . $user[1] . "</button> <br>";
    }
    echo $html;
}
elseif($option === "2"){
    $sql = "SELECT U.USERNAME,U.EMAIL,A.AREA FROM TBLUSER U, TBLAREA A WHERE U.ID_AREA = A.ID_AREA AND U.EMAIL = '". $search."'";
    $usuarios = sqlsrv_query($con, $sql);
    while ($user = sqlsrv_fetch_array($usuarios, SQLSRV_FETCH_NUMERIC)) {
        echo $user[0].",".$user[2];
    }
}
?>