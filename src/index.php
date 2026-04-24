<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
     <h1> Version 2 </h1>
    <?php
     require_once("funciones.php");	
    $conexion = conectarBD();

    if ($conexion == false) {
        echo mysqli_connect_error();
    } else {

        $consulta = obtenerEmpleados($conexion);
        $numeroEmpleados = mysqli_num_rows($consulta);
        echo "<h1>Consulta empleats</h1>";
        echo "<h3> Numero d empleados: $numeroEmpleados</h3>";
        dibujarTabla($consulta, $numeroEmpleados, false);
    }
    ?>
</body>

</html>
