<?php
require_once "conn_mysql_marian.php";

// Si se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_empresa = $_POST['id_empresa'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $sitioweb = $_POST['sitio_web'];
    $oficinas_c = $_POST['oficinas_c'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $cp = $_POST['cp'];

    // Verificar si el id_empresa ya existe o el nombre de la empresa (sin distinción de mayúsculas)
    $stmt = $conn->prepare("SELECT COUNT(*) FROM Paqueteria WHERE id_empresa = ? OR LOWER(nombre) = LOWER(?)");
    $stmt->execute([$id_empresa, $nombre]);
    
    $existe = $stmt->fetchColumn();

    if ($existe > 0) {
        echo "<script>document.getElementById('message').innerHTML = 'Error: Ya existe un registro con este ID de Empresa o Nombre de Empresa.'; document.getElementById('message').className = 'message error'; document.getElementById('message').style.display = 'block'; setTimeout(() => { document.getElementById('message').style.display = 'none'; }, 3000);</script>";
    } else {
        // Preparar la consulta SQL para inserción
        $stmt = $conn->prepare("INSERT INTO Paqueteria (id_empresa, nombre, telefono, sitio_web, oficinas_c, email, direccion, ciudad, cp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Ejecutar la consulta con los valores
        if ($stmt->execute([$id_empresa, $nombre, $telefono, $sitioweb, $oficinas_c, $email, $direccion, $ciudad, $cp])) {
            echo "<script>document.getElementById('message').innerHTML = 'Nuevo registro creado exitosamente'; document.getElementById('message').className = 'message success'; document.getElementById('message').style.display = 'block'; setTimeout(() => { document.getElementById('message').style.display = 'none'; }, 3000);</script>";
        } else {
            echo "<script>document.getElementById('message').innerHTML = 'Error al crear el registro.'; document.getElementById('message').className = 'message error'; document.getElementById('message').style.display = 'block'; setTimeout(() => { document.getElementById('message').style.display = 'none'; }, 3000);</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Tabla Empresas</title>
    <link href="../css/estilo_formulario.css" rel="stylesheet" type="text/css" media="screen"> 
    <script src="../javascript/validacion.js" defer></script>
</head>
<body>
    <div id="message" class="message" style="display: none;"></div> <!-- Contenedor para mensajes -->
    <div class="form-container">
        <h1>Datos Registrados</h1>
        <fieldset style="width: 90%;">
            <div>
                <br />
                    <b>ID Empresa:</b> <?php echo htmlspecialchars($id_empresa); ?>
                <br />
                <br />
                    <b>Nombre:</b> <?php echo htmlspecialchars($nombre); ?>
                <br />
                <br />
                    <b>Teléfono:</b> <?php echo htmlspecialchars($telefono); ?>
                <br />
                <br />
                    <b>Sitio Web:</b> <?php echo htmlspecialchars($sitio_web); ?>
                <br />
                <br />
                    <b>Oficinas Centrales:</b> <?php echo htmlspecialchars($oficinas_c); ?>
                <br />
                <br />
                    <b>Email:</b> <?php echo htmlspecialchars($email); ?>
                <br />
                <br />
                    <b>Dirección:</b> <?php echo htmlspecialchars($direccion); ?>
                <br />
                <br />
                    <b>Ciudad:</b> <?php echo htmlspecialchars($ciudad); ?>
                <br />
                <br />
                    <b>Código Postal:</b> <?php echo htmlspecialchars($cp); ?>
                <br />
                    <a href="alta_tabla_marian.php">REGISTRAR OTRA EMPRESA</a>
                <br />
                <br />
                    <a href="ver_registros.php">Ver todos los registros</a>
            </div>
        </fieldset>
        <h3>Marian Ochoa Estrella / Programación Web</h3>
    </div>
    
    <?php
        // Cerramos la conexión a la base de datos
        $conn = null;
     ?>

</body>
</html>