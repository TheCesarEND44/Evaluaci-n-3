<?php

include ('conexiondatabase.php');

session_start();


$correo=$_POST['correo'];
$pass=$_POST['password'];

$_SESSION['correo']=$correo;

$sql = "SELECT * FROM usuarios WHERE correo='$correo' and passw='$pass'";

$result=mysqli_query($conexion ,$sql) or die ("Algo salio mal");

//Guarda si encontro un resultado
$filas =mysqli_num_rows($result);


if($filas>0){

	header("location:index.php");

 }
else{
	echo "Error en la autentificacion";
    header("location:login.html");
}


mysqli_free_result($result);
mysqli_close($conexion);


?>
