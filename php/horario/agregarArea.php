<?php
include("../conexion.php");
$conexion = mysqli_connect($server, $user, $pass,$bd);

if (!$conexion) {
    echo "ERROR-Error al conectar a la base de datos";
}

$area=$_POST['Area'];
$matricula=$_POST['Matricula'];

if (empty($_POST['Area'])) {
    echo '{"message": "Selecione un area", "result": false}'; 
}else if($area){
    $validar="SELECT * FROM tblar_do WHERE intMatricula = '$matricula' && idAreas = '$area'";
    $validando = $conexion->query($validar);

    if ($validando->num_rows > 0) {
        sleep(1);
    echo '{"message": "Ya estas asignada a esta area", "result": false}';
    }else if($matricula){
    $validar="SELECT * FROM tblar_do WHERE intMatricula = '$matricula'";
    $validando = $conexion->query($validar);

    if ($validando->num_rows > 0) {
        sleep(1);
        echo '{"message": "Ya tienes un area asignada", "result": false}';
    }else{
            $query = "INSERT INTO `tblar_do`(`idAreas`, `intMatricula`)
                    VALUES ('$area','$matricula')";
            $resultado = mysqli_query($conexion,$query);
            sleep(1);
            echo '{"message": "Correcto", "result": true}';
        }
        
    }    
}

?>