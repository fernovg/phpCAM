<?php
    include("conexion.php");
    //Creamos la conexión
    $conexion = mysqli_connect($server, $user, $pass,$bd) 
    or die("Ha sucedido un error inexperado en la conexion de la base de datos");
    $alumno=$_POST['Matricula'];
    $estado=$_POST['Estado'];
    $sql = "CALL spCitasAlumno('$alumno','$estado');";
    mysqli_set_charset($conexion, "utf8"); //formato de datos utf8
    if(!$result = mysqli_query($conexion, $sql)) die("ocurrio un error al momento de realizar la consulta");
    $alumno = array();
    $alumno['citas'] = array(); //creamos un array
    while($row = mysqli_fetch_array($result)) 
    {         
        $Num_Cita=$row['Num_Cita'];
        $idAlumno=$row['idAlumno'];
        $foto=$row['foto'];
        $Nombre=$row['Nombre'];
        $Telefono=$row['Telefono'];
        $docente=$row['Matricula'];
        $Nombre_Area=$row['Nombre_Area'];
        $Aula=$row['Aula'];
        $Fecha_Cita=$row['Fecha_Cita'];
        $Hora=$row['Hora'];
        $Estado_Cita=$row['Estado_Cita'];
        //creamos la estructura de como va a quedar nuestro objeto json    
        $item = array('Num_Cita'=> $Num_Cita, 'idAlumno'=> $idAlumno,'Nombre'=> $Nombre,'Foto'=> $foto,
                            'Telefono'=> $Telefono,'Matricula'=>$docente,'Nombre_Area'=>$Nombre_Area,'Aula'=>$Aula,
                            'Fecha_Cita'=>$Fecha_Cita,'Hora'=>$Hora,'Estado_Cita'=>$Estado_Cita);
        array_push($alumno['citas'],$item);
    }        
    //desconectamos la base de datos
    $close = mysqli_close($conexion) 
    or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
    sleep(1);
    //Creamos el JSON
    $respuesta = json_encode($alumno);
    echo $respuesta;
?>