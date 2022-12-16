<?php

include("conexion.php");
//Creamos la conexión
$conexion = mysqli_connect($server, $user, $pass,$bd) 
or die("Ha sucedido un error inexperado en la conexion de la base de datos");
//generamos la consulta ocupada en la app
$sql = "SELECT * FROM horas";
mysqli_set_charset($conexion, "utf8"); 

if(!$result = mysqli_query($conexion, $sql)) die("ocurrio un error al momento de realizar la consulta");
    $horas = array(); //creamos un array
    $horas['hora'] = array();

    while($row = mysqli_fetch_array($result)) 
    {         
        $hora=$row['horas'];
        $horac=$row['horaC'];
        //creamos la estructura de como va a quedar nuestro objeto json 
        //$docente[]   
        $item = array('Horas'=> $hora,'HoraC'=> $horac);
            array_push($horas['hora'],$item);
        }
    //desconectamos la base de datos
    $close = mysqli_close($conexion) 
    or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
    //Creamos el JSON
    $respuesta = json_encode($horas);
    echo $respuesta;