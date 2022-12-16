<?php

include("conexion.php");
//Creamos la conexión
$conexion = mysqli_connect($server, $user, $pass,$bd) 
or die("Ha sucedido un error inexperado en la conexion de la base de datos");
//generamos la consulta ocupada en la app

$matricula=$_POST['Matricula'];

$sql = "SELECT * FROM view_horario WHERE Matricula = '$matricula'";
mysqli_set_charset($conexion, "utf8"); 

if(!$result = mysqli_query($conexion, $sql)) die("ocurrio un error al momento de realizar la consulta");
    $Horario = array(); //creamos un array
    $Horario['hora'] = array();

    while($row = mysqli_fetch_array($result)) 
    {          
        $tiempo=$row['Duracion'];
        $hora=$row['Hora'];
        //creamos la estructura de como va a quedar nuestro objeto json 
        //$docente[]   
        $item = array('Duracion'=> $tiempo,'HoraAten'=> $hora);
            array_push($Horario['hora'],$item);
        }
    //desconectamos la base de datos
    $close = mysqli_close($conexion) 
    or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
    //Creamos el JSON
    $respuesta = json_encode($Horario);
    echo $respuesta;