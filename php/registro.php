<?php
    include("conexion.php");
    $conexion = mysqli_connect($server, $user, $pass,$bd);
    if (!$conexion) {
        echo "error en conexion";
    } 
    $nombre=$_POST['Nombre'];
    $matricula=$_POST['Matricula'];
    $apaterno=$_POST['APaterno'];
    $amaterno=$_POST['AMaterno'];
    $telefono=$_POST['Telefono'];
    $correo=$_POST['Correo'];
    $tutor=$_POST['Tutor'];
    $usuario=$_POST['Usuario'];
    $password=$_POST['Password'];
    $foto=$_POST['Foto'];
    $hash=password_hash($password, PASSWORD_DEFAULT);

    
    if (empty($_POST['Matricula'])) {
        echo '{"message": "Campos vacios", "result": false}';  
    }else if (strlen($matricula)<8 || strlen($matricula)>8) {
        echo '{"message": "Matricula tiene que ser de 8 caracteres", "result": false}'; 
    }else if (empty($_POST['Nombre']) ||
    empty($_POST['APaterno']) || empty($_POST['APaterno']) || 
    empty($_POST['APaterno']) || empty($_POST['AMaterno']) || 
    empty($_POST['Telefono']) || empty($_POST['Correo']) || 
    empty($_POST['Usuario']) || empty($_POST['Password'])) {

        echo '{"message": "Campos vacios", "result": false}'; 
    }
    else if($usuario){
        $validarU="select * from tblusuario where vchUsuario = '$usuario'";
        $validandoU = $conexion->query($validarU);
            if ($validandoU->num_rows > 0) {
                echo '{"message": "Ya existe esta usuario", "result": false}';
            }
            
            else if (strlen($telefono)<10 || strlen($telefono)>10) {
                echo '{"message": "Su numero debe de ser de 10 digitos", "result": false}'; 
            }
            else if ($matricula) {
                $validar="select * from tblalum_docen where intMatricula = '$matricula'";
                $validando = $conexion->query($validar);
                if ($validando->num_rows > 0) {
                    echo '{"message": "Ya existe esta matricula", "result": false}'; 
                }else if($correo) {
                    $validar="select * from tblalum_docen where vchCorreo = '$correo'";
                    $validando = $conexion->query($validar);
                    if ($validando->num_rows > 0) {
                        echo '{"message": "Ya existe este correo", "result": false}'; 
                    }else if (strlen($password)<4) {
                        echo '{"message": "Contraseña tiene que ser de 4 caracteres", "result": false}'; 
                    }
                    else if (empty($_POST['Foto'])) {
                        echo '{"message": "Falta foto", "result": false}'; 
                    }
                    else{
                        $query = "CALL spRegistro('$matricula', '$nombre', '$apaterno', 
                        '$amaterno', '$telefono', '$correo', '$tutor', '$usuario', '$hash','$foto')";
                        $resultado = mysqli_query($conexion,$query);
                        sleep(1);
                        echo '{"message": "Registro Correcto", "result": true}';
                    }
                }
            }           
        
    }
    

?>