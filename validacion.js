async function verificarDatosExistentes(empresaID, nombre) {
    const response = await fetch('verificar_existencia.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ empresaID, nombre })
    });
    
    const data = await response.json();
    return data.existe; // Se espera que la respuesta contenga un campo 'existe'
 }
 
 async function validarDatos() {
    const empresaID = document.getElementById('empresaID').value;
    const nombre = document.getElementById('nombre').value; // Obtener el nombre
    const telefono = document.getElementById('telefono').value;
    const codigoPostal = document.getElementById('codigoPostal').value;
    const sitioweb = document.getElementById('sitioweb').value;
    const email = document.getElementById('email').value;
    const direccion = document.getElementById('direccion').value;
    const ciudad = document.getElementById('ciudad').value;
    const oficinascentrales = document.getElementById('oficinascentrales').value;
 
    // Asegura que todos los campos estén llenos
    if (!empresaID || !nombre || !telefono || !email || !direccion || !ciudad || !codigoPostal || !oficinascentrales) {
        alert("Por favor, completa todos los campos obligatorios.");
        return false;
    }
 
    // Validar que empresaID sea un número entero
    if (!Number.isInteger(Number(empresaID)) || empresaID <= 0) {
        alert("El Empresa ID debe ser un número entero positivo.");
        return false;
    }
 
    // Que el teléfono solo contenga números y tenga exactamente 10 dígitos
    if (!/^\d+$/.test(telefono) || telefono.length !== 10) {
        alert("El teléfono debe contener exactamente 10 dígitos numéricos.");
        return false;
    }
 
    // código postal sea un número entero
    if (!Number.isInteger(Number(codigoPostal)) || codigoPostal <= 0) {
        alert("El código postal debe ser un número entero positivo.");
        return false;
    }
    // sitio web no contenga números ni caracteres especiales
    const sitioWebPattern = /^[a-zA-Z\-\.]+$/; 
    if (sitioweb && !sitioWebPattern.test(sitioweb)) {
        alert("El sitio web no tiene un formato válido. Solo se permiten letras, guiones y puntos.");
        return false;
    }
 
    // Verificar si los datos ya existen en la base de datos
    const existe = await verificarDatosExistentes(empresaID, nombre);
    if (existe) {
        alert("Ya existe un registro con este Empresa ID o Nombre de Empresa.");
        return false;
    }
 
    return true; // Si todas las validaciones pasan
 }