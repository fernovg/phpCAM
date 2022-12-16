<?php

include("conexion.php");
$conexion = mysqli_connect($server, $user, $pass,$bd);

if (!$conexion) {
    echo "ERROR-Error al conectar a la base de datos";
}
$id=$_POST['Num_Cita'];


    $query = "SELECT * FROM tblcitas where tblcitas.idCita='$id'";
    $resultado = mysqli_query($conexion,$query);

    while($row = mysqli_fetch_array($resultado)){
        $fecha = $row['dteFecha'];
        $area = $row['idArea'];
        $hora = $row['tmeHoraIni'];
    }

    if($fecha){
        $validar="select * from tblcitas where dteFecha = '$fecha' && idArea='$area' && tmeHoraIni = '$hora' && vchEstado='Aprobado'";
        $validando = $conexion->query($validar);
        
        if ($validando->num_rows > 0) {

            sleep(2);
            echo '{"message": "No se puedo aprobar esta cita, Sera cancelada", "result": false}';
            $query = "CALL spCancelar('$id')";
            $resultado = mysqli_query($conexion,$query);

        }else{
            $query = "CALL spAprobar('$id')";
            $resultado = mysqli_query($conexion,$query);

            sleep(2);

            echo '{"message": "Aprobado", "result": true}';

        }
    }


?>