<?php
include("conexion.php");
//Creamos la conexión
$conexion = mysqli_connect($server, $user, $pass,$bd) 
or die("Ha sucedido un error inexperado en la conexion de la base de datos");

$buscar=$_POST['Nombre'];

//generamos la consulta ocupada en la app
$sql = "SELECT * FROM alumnos WHERE Nombre LIKE '%$buscar%'";
mysqli_set_charset($conexion, "utf8"); 

if(!$result = mysqli_query($conexion, $sql)) die("ocurrio un error al momento de realizar la consulta");

    $listAlumnos = array(); //creamos un array
    $listAlumnos['listAlumnos'] = array();

    while($row = mysqli_fetch_array($result)) 
    {        
        $matri=$row['Matricula'];
        $nombre=$row['Nombre'];
        //creamos la estructura de como va a quedar nuestro objeto json 
        //$docente[]   
        $item = array('Matricula'=> $matri,'Nombre'=> $nombre);
            array_push($listAlumnos['listAlumnos'],$item);
        }
    //desconectamos la base de datos
    $close = mysqli_close($conexion) 
    or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
    sleep(1);
    //Creamos el JSON
    $respuesta = json_encode($listAlumnos);
    echo $respuesta;