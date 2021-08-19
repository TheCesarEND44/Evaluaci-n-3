<?php 


$host = "127.0.0.1";
$database = "lotes";
$username = "root";
$password = "";



$conexion= mysqli_connect($host,$username,$password) or trigger_error(mysql_error(),E_USER_ERROR); 

$db = mysqli_select_db($conexion,$database )or die ( "No fue posible la conexion a la base de datos" );

?>