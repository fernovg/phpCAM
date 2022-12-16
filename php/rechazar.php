<?php

include("conexion.php");
$conexion = mysqli_connect($server, $user, $pass,$bd);

if (!$conexion) {
    echo "ERROR-Error al conectar a la base de datos";
}
$id=$_POST['Num_Cita'];

$query = "CALL spCancelar('$id')";
$resultado = mysqli_query($conexion,$query);

sleep(1);

if ($resultado) {
    echo '{"message": "Cancelada con exito", "result": true}';
    
}else{
    echo '{"message": "Datos no validos", "result": false}'; 
}

?>