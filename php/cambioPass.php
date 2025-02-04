<?php
// Incluye el archivo con las variables y funciones globales
include 'VarGlobales.php';

// Verifica si el método de solicitud es POST (envío de formulario)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura los datos enviados desde el formulario
    $usuario = $_POST['usuario']; // Nombre de usuario
    $nuevaContraseña = $_POST['nueva_password']; // Nueva contraseña
    $preguntaSeguridad = $_POST['pregunta']; // Pregunta de seguridad
    $respuestaSeguridad = $_POST['respuesta']; // Respuesta de seguridad

    // Llama a la función cambioContraseña para actualizar la contraseña del usuario
    if (cambioContraseña($usuario, $nuevaContraseña, $preguntaSeguridad, $respuestaSeguridad)) {
        echo "Contraseña cambiada con éxito.";
        // Redirige a login.php después de cambiar la contraseña exitosamente
        header('Location: login.php');
        exit();
    } else {
        // Mensaje de error si la pregunta o respuesta de seguridad no coincide
        echo "Error: pregunta o respuesta de seguridad incorrecta.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cambiar Contraseña</title>
    <!-- Enlace a los estilos personalizados -->
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap para estilos y diseño responsivo -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fuente personalizada para el estilo temático -->
    <link href="https://fonts.googleapis.com/css2?family=Creepster&display=swap" rel="stylesheet">
</head>

<body class="bg-dark text-white">
    <!-- Superposición de fondo -->
    <div class="overlay position-fixed top-0 start-0 w-100 h-100"></div>

    <!-- Banner con animaciones de arañas -->
    <section class="banner position-absolute top-0 w-100 h-100 d-flex justify-content-center align-items-center">
        <img src="../img/spider.png" class="spider position-absolute">
        <img src="../img/spider.png" class="spider2 position-absolute">
        <img src="../img/spider.png" class="spider3 position-absolute">
    </section>

    <!-- Contenedor principal centrado para el formulario de cambio de contraseña -->
    <div class="main-container d-flex align-items-center justify-content-center vh-100 position-relative">
        <div class="form-container p-4 text-center bg-black bg-opacity-75 rounded-4 shadow-lg" style="width: 400px;">
            <p class="title fs-2 text-warning" style="font-family: 'Creepster', cursive;">Cambiar contraseña</p>
            
            <!-- Formulario de cambio de contraseña -->
            <form class="form" action="" method="POST">
                <!-- Campo de nombre de usuario -->
                <div class="mb-3">
                    <input type="text" class="form-control bg-dark text-light border-warning rounded-3" 
                           name="usuario" id="usuario" placeholder="Nombre de usuario" required>
                </div>
                
                <!-- Campo de nueva contraseña -->
                <div class="mb-3">
                    <input type="password" class="form-control bg-dark text-light border-warning rounded-3" 
                           name="nueva_password" id="nueva_password" placeholder="Nueva Contraseña" required>
                </div>
                
                <!-- Campo de pregunta de seguridad -->
                <div class="mb-3">
                    <input type="text" class="form-control bg-dark text-light border-warning rounded-3" 
                           name="pregunta" id="pregunta" placeholder="Pregunta de Seguridad" required>
                </div>
                
                <!-- Campo de respuesta a la pregunta de seguridad -->
                <div class="mb-3">
                    <input type="text" name="respuesta" id="respuesta" class="form-control bg-dark text-light border-warning rounded-3" 
                           placeholder="Respuesta a la Pregunta de Seguridad" required>
                </div>
                
                <!-- Botón para enviar el formulario -->
                <button type="submit" class="btn btn-warning w-100 my-2 rounded-3">Cambiar</button>
                
                <!-- Botón para volver a la página anterior -->
                <button type="button" onclick="history.back()" class="btn btn-outline-warning w-100 rounded-3">Volver</button>
            </form>
        </div>
    </div>
</body>
</html>
