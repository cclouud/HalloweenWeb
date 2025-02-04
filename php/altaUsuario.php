<?php
// Incluye el archivo con las variables y funciones globales
include 'VarGlobales.php';

// Verifica si el método de solicitud es POST (envío de formulario)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Crea un array con los datos del nuevo usuario
    $nuevoUser = [
        "Usuario" => $_POST['usuario'], // Nombre de usuario ingresado
        "Contraseña" => $_POST['password'], // Contraseña ingresada
        "Email" => $_POST['email'], // Correo electrónico ingresado
        "PreguntaSeguridad" => $_POST['pregunta_seguridad'], // Pregunta de seguridad ingresada
        "RespuestaSeguridad" => $_POST['respuesta'], // Respuesta a la pregunta de seguridad
        "Perfil" => "Usuario", // Perfil predeterminado del usuario
    ];
    
    // Llama a la función para registrar el nuevo usuario
    AltaUsuario($nuevoUser);
    
    // Redirige a la página de inicio de sesión
    header('Location: login.php');
    exit(); // Asegura la finalización del script después de redirigir
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="style.css"> <!-- Enlace al archivo CSS personalizado -->
    <meta charset="UTF-8">
    <title>Registrar Usuario</title>
    
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

    <!-- Contenedor principal centrado para el formulario de registro -->
    <div class="main-container d-flex align-items-center justify-content-center vh-100 position-relative">
      <div class="form-container p-4 text-center bg-black bg-opacity-75 rounded-4 shadow-lg" style="width: 400px;">
          <p class="title fs-2 text-warning" style="font-family: 'Creepster', cursive;">Crea tu perfil</p>
          
          <!-- Formulario de registro -->
          <form class="form" action="" method="POST">
              <!-- Campo de nombre de usuario -->
              <div class="mb-3">
                  <input type="text" class="form-control bg-dark text-light border-warning rounded-3" 
                         name="usuario" id="usuario" placeholder="Nombre de usuario" required>
              </div>
              
              <!-- Campo de contraseña -->
              <div class="mb-3">
                  <input type="password" class="form-control bg-dark text-light border-warning rounded-3" 
                         name="password" id="password" placeholder="Contraseña (mínimo 8 caracteres)" required>
              </div>
              
              <!-- Campo de correo electrónico -->
              <div class="mb-3">
                  <input type="email" class="form-control bg-dark text-light border-warning rounded-3" 
                         name="email" id="email" placeholder="Correo electrónico (ejemplo@dominio.com)" required>
              </div>
              
              <!-- Campo de pregunta de seguridad -->
              <div class="mb-3">
                  <input type="text" class="form-control bg-dark text-light border-warning rounded-3" 
                         name="pregunta_seguridad" id="pregunta_seguridad" placeholder="Escribe una pregunta de seguridad" required>
              </div>
              
              <!-- Campo de respuesta a la pregunta de seguridad -->
              <div class="mb-3">
                  <input type="text" class="form-control bg-dark text-light border-warning rounded-3" 
                         name="respuesta" id="respuesta" placeholder="Respuesta a la pregunta de seguridad" required>
              </div>
              
              <!-- Botón para enviar el formulario -->
              <button type="submit" class="form-btn btn btn-warning w-100 my-2 rounded-3">Registrar</button>
              
              <!-- Botón para volver a la página anterior -->
              <button type="button" onclick="history.back()" class="btn btn-outline-warning w-100 rounded-3">Volver</button>
          </form>
      </div>
    </div>
</body>
</html>
