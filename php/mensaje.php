<script src="//code.tidio.co/9diik2qfytb8dtvuosn0g278rtp3eevy.js" async></script>
<?php
    include("conexion.php");
    $conexion = mysqli_connect($server, $user, $pass,$bd);
    if (!$conexion) {
        echo "ERROR-Error al conectar a la base de datos";
    }

    $id=$_POST['Num_Cita'];

    $query = "SELECT Nombre, Fecha_Cita, Hora, Estado_cita  FROM view_citas_alumno 
    WHERE Num_Cita = '$id'";
    $resultado = mysqli_query($conexion,$query);

    while($row = mysqli_fetch_array($resultado)){
        $docen = $row['Nombre'];
        $fecha = $row['Fecha_Cita'];
        $hora = $row['Hora'];
        $estado = $row['Estado_Cita'];  
        }



// Update the path below to your autoload.php, 
// see https://getcomposer.org/doc/01-basic-usage.md 
require_once 'vendor/autoload.php'; 

use Twilio\Rest\Client; 

$sid    = "AC6f0c3322c1751757d4342f4632d414ba"; 
$token  = "943c97bc16d3eddb3e99814c55810ea5"; 
$twilio = new Client($sid, $token); 

$message = $twilio->messages 
    ->create("whatsapp:+5217711805373", // to 
        array( 
                "from" => "whatsapp:+14155238886",       
                "body" => "Tu Cita con el docente " . $docen . "Para la fecha " . $fecha . " y hora " . $hora . " esta aprobada" 
            ) 
        ); 

print($message->sid);

?>
