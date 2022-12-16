<?php
    include("conexion.php");
    //Creamos la conexión
    $conexion = mysqli_connect($server, $user, $pass,$bd) 
    or die("Ha sucedido un error inexperado en la conexion de la base de datos");

    $docente=$_POST['Matricula'];
    $estado=$_POST['Estado'];
    //generamos la consulta ocupada en la app
    $sql = "SELECT * FROM view_citas_docente WHERE idDocente='$docente' AND Estado_Cita='$estado'";
    mysqli_set_charset($conexion, "utf8"); //formato de datos utf8
    if(!$result = mysqli_query($conexion, $sql)) die("ocurrio un error al momento de realizar la consulta");
    $docente = array(); //creamos un array
    $docente['citas'] = array();
    while($row = mysqli_fetch_array($result)) 
    {         
        $Num_Cita=$row['Num_Cita'];
        $idDocente=$row['idDocente'];
        $foto=$row['foto'];
        $Nombre=$row['Nombre'];
        $Telefono=$row['Telefono'];
        $Tutor=$row['Tutor'];
        $Nombre_Area=$row['Nombre_Area'];
        $Aula=$row['Aula'];
        $Fecha_Cita=$row['Fecha_Cita'];
        $Hora=$row['Hora'];
        $Estado_Cita=$row['Estado_Cita'];
        $item = array('Num_Cita'=> $Num_Cita, 'idDocente'=> $idDocente,'Foto'=> $foto,
                            'Nombre'=> $Nombre,
                            'Telefono'=> $Telefono,'Tutor'=> $Tutor,'Nombre_Area'=>$Nombre_Area,'Aula'=>$Aula,
                            'Fecha_Cita'=>$Fecha_Cita,'Hora'=>$Hora,'Estado_Cita'=>$Estado_Cita);
            array_push($docente['citas'],$item);
        }        
    //desconectamos la base de datos
    $close = mysqli_close($conexion) 
    or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
    sleep(1);
    //Creamos el JSON
    $respuesta = json_encode($docente);
    echo $respuesta;
    ?>
