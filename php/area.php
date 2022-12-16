<?php

include("conexion.php");
//Creamos la conexión
$conexion = mysqli_connect($server, $user, $pass,$bd) 
or die("Ha sucedido un error inexperado en la conexion de la base de datos");
//generamos la consulta ocupada en la app
$sql = "CALL spGetArea()";
mysqli_set_charset($conexion, "utf8"); 

if(!$result = mysqli_query($conexion, $sql)) die("ocurrio un error al momento de realizar la consulta");
    $areas = array(); //creamos un array
    $areas['areas'] = array();
    while($row = mysqli_fetch_array($result)) 
    {         
        $id=$row['idAreas'];
        $area=$row['vchNombreArea'];
        $aula=$row['vchAula'];
        //creamos la estructura de como va a quedar nuestro objeto json 
        //$docente[]   
        $item = array('ID'=> $id,'Area'=> $area,'Aula'=>$aula);
            array_push($areas['areas'],$item);
        }
    //desconectamos la base de datos
    $close = mysqli_close($conexion) 
    or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
    //Creamos el JSON
    $respuesta = json_encode($areas);
    echo $respuesta;