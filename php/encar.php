<?php
    include("conexion.php");
    //Creamos la conexión
    $conexion = mysqli_connect($server, $user, $pass,$bd) 
    or die("Ha sucedido un error inexperado en la conexion de la base de datos");

    $area=$_POST['Area'];

    $sql = "SELECT * FROM view_encar_areas WHERE idArea = '$area'";
    mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

    if(!$result = mysqli_query($conexion, $sql)) die("ocurrio un error al momento de realizar la consulta");
    
    $enDocen = array();
    $enDocen['encar'] = array(); //creamos un array
    while($row = mysqli_fetch_array($result)) 
    {         

        $matricula=$row['Matricula'];
        $docente=$row['Nombre'];

        //creamos la estructura de como va a quedar nuestro objeto json    
        $item = array('Matricula'=> $matricula,
        'Docente'=> $docente);
        array_push($enDocen['encar'],$item);
    }        
    //desconectamos la base de datos
    $close = mysqli_close($conexion) 
    or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
    sleep(1);
    //Creamos el JSON
    $respuesta = json_encode($enDocen);
    echo $respuesta;
?>