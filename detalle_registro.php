<?php
// Insertamos el código PHP donde nos conectamos a la base de datos
require_once "conn_mysql_marian.php";

// Recuperamos el ID del envío desde la URL mediante GET
$idenvio = isset($_GET["id"]) ? $_GET["id"] : null;



// Escribimos la consulta para recuperar el registro único de MySQL mediante el ID obtenido por GET
$sql = 'SELECT E.envioID, E.fechaEnvio, E.direccionDestino, E.ciudadDestino, E.estado, 
               E.costo, E.nombreRemitente, E.nombreDestinatario, E.peso, C.nombre AS nombreEmpresa 
        FROM Envios E 
        INNER JOIN Empresa_Paqueteria C ON E.empresaID = C.empresaID 
        WHERE E.envioID = ' . intval($idenvio);

// Ejecutamos la consulta y asignamos el resultado a la variable llamada $result
$result = $conn->query($sql);

// Recuperamos los valores o registros de la variable $result y los asignamos a la variable $rows
$rows = $result->fetchAll();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Detalle del Envío</title>
</head>
<body>
    <h2>Detalle del Envío Seleccionado</h2>

    <?php if ($rows): // Verificamos si hay resultados ?>
        <?php foreach ($rows as $row): ?>
            <div align="center">
                <table border="1" width="50%">
                    <tr><th>ID Envío:</th><td><?php echo $row['envioID']; ?></td></tr>
                    <tr><th>Empresa:</th><td><?php echo htmlspecialchars($row['nombreEmpresa']); ?></td></tr>
                    <tr><th>Fecha Envío:</th><td><?php echo $row['fechaEnvio']; ?></td></tr>
                    <tr><th>Dirección Destino:</th><td><?php echo $row['direccionDestino']; ?></td></tr>
                    <tr><th>Ciudad Destino:</th><td><?php echo $row['ciudadDestino']; ?></td></tr>
                    <tr><th>Estado:</th><td><?php echo $row['estado']; ?></td></tr>
                    <tr><th>Costo:</th><td><?php echo $row['costo']; ?></td></tr>
                    <tr><th>Nombre Remitente:</th><td><?php echo $row['nombreRemitente']; ?></td></tr>
                    <tr><th>Nombre Destinatario:</th><td><?php echo $row['nombreDestinatario']; ?></td></tr>
                    <tr><th>Peso:</th><td><?php echo $row['peso']; ?></td></tr>
                </table>

                <!-- Enlace para regresar -->
                <p><a href="reporte_general_marian.php"><<< --- Regresar al listado completo (Envíos)</a></p>

            </div>

        <?php endforeach; ?>
    <?php else: // Si no hay resultados ?>
        <p>No se encontraron registros.</p>

        <!-- Enlace para regresar -->
        <p><a href="reporte_general_marian.php"><<< --- Regresar al listado completo (Envíos)</a></p>
    <?php endif; ?>

    <?php
    // Cerramos la conexión a la base de datos
    $conn = null;
    ?>
</body>
</html>