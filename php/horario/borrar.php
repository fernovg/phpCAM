<?php

include("../conexion.php");
$conexion = mysqli_connect($server, $user, $pass,$bd);

if (!$conexion) {
    echo "ERROR-Error al conectar a la base de datos";
}

$id=$_POST['IdHora'];

$query = "DELETE FROM `tblhorario` WHERE id_horario = '$id'";
$resultado = mysqli_query($conexion,$query);

sleep(3);

if ($resultado) {
    echo '{"message": "Borrada", "result": true}';
    
}else{
    echo '{"message": "Datos no validos", "result": false}'; 
}


?>