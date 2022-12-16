<?php
include("conexion.php");
$conexion = mysqli_connect($server, $user, $pass,$bd);

if (!$conexion) {
    echo "ERROR-Error al conectar a la base de datos";
}
$alumno=$_POST['Matricula'];
$docente=$_POST['Nombre'];
$fecha=$_POST['Fecha'];
$Area=$_POST['Area'];
$hora=$_POST['Hora'];

$originalDate = $fecha;
$newDate = date("Y-m-d", strtotime($originalDate));

if ($Area) {
    $validar="select * from tblcitas where idArea='$Area' && dteFecha = '$newDate' && tmeHoraIni = '$hora' && (vchEstado='Aprobado' || vchEstado='Pendiente')";
    $validando = $conexion->query($validar);
    if ($validando->num_rows > 0) {
        sleep(2);
        echo '{"message": "Fecha, Hora o Area no disponible", "result": false}';
    }else if ($docente) {
        $validar="select * from tblcitas where idAlumno='$alumno' && dteFecha = '$newDate' && tmeHoraIni = '$hora' && (vchEstado='Aprobado' || vchEstado='Pendiente')";
        $validando = $conexion->query($validar);
        if ($validando->num_rows > 0) {
            sleep(2);
            echo '{"message": "Alumno tiene cita este dia", "result": false}';
        }else {
            $query = "CALL spAddCita('$alumno','$docente','$fecha','$Area','$hora')";
            $resultado = mysqli_query($conexion,$query);
            sleep(2);
            echo '{"message": "Registro Correcto", "result": true}';
        }
    }
}
?>