<?php
include("../conexion.php");
$conexion = mysqli_connect($server, $user, $pass,$bd);
if (!$conexion) {
    echo "ERROR-Error al conectar a la base de datos";
}
$inicio=$_POST['Ini'];
$mininicio=$_POST['minIni'];
$final=$_POST['Fin'];
$minfinal=$_POST['minFin'];
$matricula=$_POST['matricula'];
if ($inicio < 12) {
    $horaini = $inicio . ":" . "$mininicio" . " am";
}else {
    $horaini = $inicio . ":" . "$mininicio" . " pm";
}
if ($final < 12) {
    $horafin = $final . ":" . "$minfinal" . " am";
}else {
    $horafin = $final . ":" . "$minfinal" . " pm";
}
$tiempo = $horaini . " - " . $horafin;
$hora = $inicio . ":" . "$mininicio" . ":00";

$validar="SELECT * FROM tblar_do WHERE intMatricula = '$matricula'";
$validando = $conexion->query($validar);

if ($validando->num_rows > 0) {
    while($row = mysqli_fetch_array($validando)) 
    {         
        $id=$row['idAr_Do'];
    }  
    sleep(2);
    $insert="INSERT INTO tblhorario(`tiempo`, `hora`, `intMatricula`, `idAr_Do`) 
                VALUES ('$tiempo','$hora','$matricula','$id')";
    $resultado = mysqli_query($conexion,$insert);
    
    echo '{"message": "registro correcto", "result": true}';
}else{
    echo '{"message": "No estas dato de alta en ninguna area", "result": false}';
    
} 

?>