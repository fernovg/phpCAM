<?php
include("../conexion.php");
$conexion = mysqli_connect($server, $user, $pass,$bd);

if (!$conexion) {
    echo "ERROR-Error al conectar a la base de datos";
}
$fecha=$_POST['Fecha'];
$hora=$_POST['Hora'];
$estado=$_POST['Estado'];
$id=$_POST['Cita'];
// crear validacion para fecha y hora disponible
$originalDate = $fecha;
$newDate = date("Y-m-d", strtotime($originalDate));

if (empty($_POST['Fecha']) || empty($_POST['Hora'])) {
    echo '{"message": "Campos vacios", "result": false}'; 
}
else if($estado){
    $validar="select * from tblcitas where dteFecha = '$newDate' && idArea=idArea && tmeHoraIni = '$hora' && (vchEstado='Aprobado')";
    $validando = $conexion->query($validar);
    
    if ($validando->num_rows > 0) {
        sleep(2);
        echo '{"message": "Sin disponibilidad de citas", "result": false}';

    }else if ($hora) {
        $validar="select * from tblcitas where idDocente=idDocente && dteFecha = '$newDate' && tmeHoraIni = '$hora' && (vchEstado='Aprobado' || vchEstado='Pendiente')";
        $validando = $conexion->query($validar);

        if ($validando->num_rows > 0) {
            sleep(2);
            echo '{"message": "Docente no disponible", "result": false}';
            
        }else{
            
            $query = "CALL spReagendarApp('$fecha','$hora','$estado','$id')";
            $resultado = mysqli_query($conexion,$query);
            sleep(2);
            echo '{"message": "Reagendado", "result": true}';
        }
    }     
}


?>