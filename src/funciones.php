<?php

function conectarBD()
{
    $host = getenv('MYSQL_HOST');
    $user = getenv('MYSQL_USER');
    $pass = getenv('MYSQL_PASSWORD');
    $nomBD   = getenv('MYSQL_DATABASE');
    var_dump(getenv('MYSQL_USER'));
    var_dump(getenv('MYSQL_DATABASE'));
    $bd = mysqli_connect($host, $user, $pass, $nomBD);
    return $bd;
}
function obtenerEmpleados($bd)
{
    $sql = "SELECT e.*, d.Nombre as nombreDepartamento FROM empleados AS e INNER JOIN departamentos AS d  
    ON e.Departamento = d.Numero";
    $consulta = mysqli_query($bd, $sql);
    return $consulta;
}
function dibujarTabla($consulta, $numeroEmpleados, $esFormulario)
{
    if ($esFormulario) {
        echo "<form action = 'esborrarEmpleats.php' method= 'POST'>";
    }

    echo "<table border= '1'>";
    if ($esFormulario) {
        echo "<th> </th>";
    }
    echo
    "<th> Numero</th>
    <th> Nombre</th>
    <th> Puesto</th>
    <th> Jefe</th>
    <th> FechaAlta</th>
    <th> Salario</th>
    <th> Comision</th>
    <th> Departamento</th>
    ";

    for ($i = 0; $i < $numeroEmpleados; $i++) {
        echo "<tr>";
        $empleadoActual = mysqli_fetch_array($consulta);
        if ($esFormulario) {
            echo "<td> <input type='checkbox' name= 'empleats[]' value ='{$empleadoActual['Numero']}'></td>";
        }
        echo "<td> {$empleadoActual['Numero']}</td>";
        echo "<td> {$empleadoActual['Nombre']}</td>";
        echo "<td> {$empleadoActual['Puesto']}</td>";
        echo "<td> {$empleadoActual['Jefe']}</td>";
        echo "<td> {$empleadoActual['FechaAlta']}</td>";
        echo "<td> {$empleadoActual['Salario']}</td>";
        echo "<td> {$empleadoActual['Comision']}</td>";
        echo "<td> {$empleadoActual['nombreDepartamento']}</td>";
        echo "</tr>";
    }
    echo "</table>";

    if ($esFormulario) {
        echo "<td> <input type='submit' name= 'Enviar' value ='Enviar'></td>";
        echo "</form>";
    }
}
function mostrarEmpleats($empleatsEsborrar, $bd)
{
    $sql = "SELECT * FROM empleados WHERE Numero IN ($empleatsEsborrar)";
    $consulta = mysqli_query($bd, $sql);
    $numEmpleados  = mysqli_num_rows($consulta);
    echo "Numero de empleados a borrar;: $numEmpleados";
    for ($i = 0; $i < $numEmpleados; $i++) {
        $empleadoActual = mysqli_fetch_array($consulta);
        echo "Empleado num {$empleadoActual['Numero']}, {$empleadoActual['Nombre']}";
    }
}
function esborrarempletas($empleatsEsborrar, $bd)
{
    $sql = "DELETE FROM empleados WHERE Numero IN ($empleatsEsborrar)";
    $consulta = mysqli_query($bd, $sql);
    return $consulta;
}
