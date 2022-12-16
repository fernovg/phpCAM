<?php
    include("conexion.php");
    $conexion = mysqli_connect($server, $user, $pass,$bd);
    if (!$conexion) {
        echo "ERROR-Error al conectar a la base de datos";
    }
    $usuario=$_POST['Usuario'];
    $password=$_POST['Password'];
    $query = "SELECT tblalum_docen.intMatricula,tblalum_docen.idUsuario, tblusuario.vchUsuario, tblusuario.idTipo, 
    tblalum_docen.vchNombre, tblalum_docen.vchAPaterno , tblalum_docen.vchAMaterno,  tblusuario.vchContraseña
    FROM tblusuario 
    INNER JOIN tblalum_docen ON tblalum_docen.idUsuario = tblusuario.idUsuario 
    WHERE tblusuario.vchUsuario = '$usuario'";
    $resultado = mysqli_query($conexion,$query);
    $response;
    $tipo = "alumno";
    while($row = mysqli_fetch_array($resultado)){
        $hash = $row['vchContraseña'];
        $matricula = $row['intMatricula'];
        if($row['idTipo'] == "2"){
            $tipo = "docente";
        }
        $nom = $row['vchNombre'];
        $pat = $row['vchAPaterno'];
        $mat = $row['vchAMaterno'];
        $nombre = $nom."  ".$pat."  ".$mat;
        //creamos la estructura de como va a quedar nuestro objeto json    
        $response = array('id'=> $row['idUsuario'],'intMatricula'=> $row['intMatricula'], 'tipoId'=> $row['idTipo'], 'tipo'=> $tipo,'nombre'=> $nombre, 'message'=> 'OK', 'result'=> 'true');
    }
    
    if ($resultado->num_rows>0) {                
        if(password_verify($password, $hash)){
            echo json_encode($response);  
        }else{
            echo '{"message": "Usuario/Contraseña incorrecta", "result": false}';
        }
    } else {
        echo '{"message": "Usuario/Contraseña incorrecta", "result": false}';
    }  
?>