<?php
include("../conexion.php");
$conexion = mysqli_connect($server, $user, $pass,$bd);

if (!$conexion) {
    echo "ERROR-Error al conectar a la base de datos";
}

$matricula=$_POST['matricula'];

//generamos la consulta ocupada en la app
$sql = "SELECT * FROM view_horario WHERE Matricula='$matricula'";
mysqli_set_charset($conexion, "utf8"); //formato de datos utf8
if(!$result = mysqli_query($conexion, $sql)) die("ocurrio un error al momento de realizar la consulta");

$horario = array(); //creamos un array
$horario['detalle'] = array();
while($row = mysqli_fetch_array($result)) 
{        
    $Id=$row['idHora']; 
    $tiempo=$row['Duracion'];
    $inicio=$row['Hora'];

    $item = array('ID'=> $Id, 'Duracion'=> $tiempo,'Hora'=> $inicio);

        array_push($horario['detalle'],$item);
    }        
//desconectamos la base de datos
$close = mysqli_close($conexion) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");

sleep(1);
//Creamos el JSON
$respuesta = json_encode($horario);
echo $respuesta;
?>