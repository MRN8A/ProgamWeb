<?php
require_once "conn_mysql_googie.php";
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
        <h1>Formulario de Captura de Datos para la tabla de Empresas</h1>
        <form id="dataForm" action="grabar_datos.php" method="POST" onsubmit="return validarDatos()">
            <label for="id_empresa">Empresa ID:</label>
            <input type="number" id="id_empresa" name="id_empresa" required><br>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" required><br>

            <label for="sitioweb">Sitio Web:</label>
            <input type="text" id="sitio_web" name="sitioweb"><br>

            <label for="oficinascentrales">Oficinas Centrales:</label>
            <select id="oficinascentrales" name="oficinascentrales">
                <option value="">Seleccione una opción</option>
                <option value="CDMX">CDMX</option>
                <option value="JALISCO">JALISCO</option>
                <option value="SONORA">SONORA</option>
                <option value="NUEVO LEON">NUEVO LEON</option>
                <option value="PUEBLA">PUEBLA</option>
            </select><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion"><br>

            <label for="ciudad">Ciudad:</label>
            <input type="text" id="ciudad" name="ciudad"><br>

            <label for="codigoPostal">Código Postal:</label>
            <input type="number" id="cp" name="codigoPostal"><br>

            <input type="submit" value="Enviar">
        </form>
        <h3>Marian Ochoa Estrella / Programación Web</h3>
    </div>
    <?php
			//Cerramos la oonexion a la base de datos **********************************************
			$conn = null;
     ?>

</body>
</html>