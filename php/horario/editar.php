include("../conexion.php");
$conexion = mysqli_connect($server, $user, $pass,$bd);

if (!$conexion) {
    echo "ERROR-Error al conectar a la base de datos";
}