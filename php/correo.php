<?php
// Incluye el archivo con variables globales y funciones necesarias
include 'VarGlobales.php';

// Verifica si se envió el formulario y si existe un usuario actual
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $para = "julian.ms@yahoo.com"; // Dirección de correo de destino

    $asunto = $_POST['asunto']; // Asunto del correo
    $mensaje = $_POST['mensaje']; // Mensaje del correo
    $headers = "From: " . $para; // Cabecera con el correo del usuario actual

    // Intenta enviar el correo
    if (mail($para, $asunto, $mensaje, $headers)) {
        echo "<p class='text-success'>Correo enviado con éxito.</p>"; // Mensaje de éxito
    } else {
        echo "<p class='text-danger'>Error al enviar el correo.</p>"; // Mensaje de error
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Enviar Correo</title>
    <!-- Estilos personalizados y Bootstrap -->
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Creepster&display=swap" rel="stylesheet">
</head>

<body class="bg-dark text-white">
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-opacity-50">
        <div class="container-fluid">
            <!-- Logo y enlace de inicio -->
            <a class="navbar-brand" href="index.html">
                <img class="logo ms-3" src="../img/logo3.png" alt="Logo" style="height: 50px;">
            </a>
    
            <!-- Botón de colapso para el menú en dispositivos móviles -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <!-- Enlaces de navegación -->
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <div class="d-flex justify-content-center w-100">
                    <ul class="navbar-nav">
                        <!-- Enlaces a secciones principales del sitio -->
                        <li class="nav-item mx-2">
                            <a class="nav-link active text-uppercase" href="../html/index.html" style="font-family: 'Creepster', cursive; color: #ff0000;">Inicio</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link text-uppercase" href="../html/recetas.html" style="font-family: 'Creepster', cursive; color: #ff0000;">Recetas</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link text-uppercase" href="../html/minijuegos.html" style="font-family: 'Creepster', cursive; color: #ff0000;">Minijuegos</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link text-uppercase" href="../html/about.html" style="font-family: 'Creepster', cursive; color: #ff0000;">About Us</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <!-- Enlace de correo -->
                    <ul class="navbar-nav">
                        <li class="nav-item mx-2">
                            <a class="nav-link me-3 text-uppercase" href="login.html" style="font-family: 'Creepster', cursive; color: #ff0000;">Correo</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenedor principal del formulario de envío de correo -->
    <div class="main-container d-flex align-items-center justify-content-center vh-100 position-relative">
        <div class="overlay position-fixed top-0 start-0 w-100 h-100"></div>

        <!-- Banner decorativo con imágenes de arañas -->
        <section class="banner position-absolute top-0 w-100 h-100 d-flex justify-content-center align-items-center">
            <img src="../img/spider.png" class="spider position-absolute">
            <img src="../img/spider.png" class="spider2 position-absolute">
            <img src="../img/spider.png" class="spider3 position-absolute">
        </section>

        <!-- Formulario de envío de correo -->
        <div class="form-container p-4 text-center bg-black bg-opacity-75 rounded-4 shadow-lg" style="width: 400px;">
            <p class="title fs-2 text-warning" style="font-family: 'Creepster', cursive;">Correo Terrorifico</p>

            <form action="correo.php" method="POST">
                <!-- Campo de asunto -->
                <div class="mb-3">
                    <label for="asunto" class="form-label text-warning">Asunto:</label>
                    <input type="text" name="asunto" id="asunto" class="form-control bg-dark text-light border-warning rounded-3" placeholder="Asunto" required>
                </div>
                
                <!-- Campo de mensaje -->
                <div class="mb-3">
                    <label for="mensaje" class="form-label text-warning">Mensaje:</label>
                    <textarea name="mensaje" id="mensaje" rows="4" class="form-control bg-dark text-light border-warning rounded-3" placeholder="Escribe tu mensaje aquí" required></textarea>
                </div>
                
                <!-- Botón para enviar el formulario -->
                <input type="submit" value="Enviar" class="btn btn-warning w-100 rounded-3">
            </form>
        </div>
    </div>

    <!-- Footer con enlaces a redes sociales y secciones principales -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <!-- Sección de redes sociales -->
            <div class="mb-3">
                <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i></a>
                <a href="#" class="text-white me-3"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-white"><i class="bi bi-youtube"></i></a>
            </div>
            
            <!-- Enlaces principales del sitio -->
            <div class="d-flex flex-wrap justify-content-center mb-3">
                <a href="../html/index.html" class="text-white text-decoration-none mx-2">Inicio</a>
                <a href="../html/recetas.html" class="text-white text-decoration-none mx-2">Recetas</a>
                <a href="../html/minijuegos.html" class="text-white text-decoration-none mx-2">Minijuegos</a>
                <a href="../html/about.html" class="text-white text-decoration-none mx-2">About Us</a>
                <a href="correo.php" class="text-white text-decoration-none mx-2">Correo</a>
            </div>

            <!-- Derechos de autor -->
            <div>
                <p class="mb-0">&copy; 2024 Halloween. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
</body>
</html>
