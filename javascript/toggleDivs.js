document.addEventListener("DOMContentLoaded", function() {
    // Función para mostrar/ocultar el div y desplazarlo a la vista
    function mostrarjuego(id) {
        const juegoDiv = document.getElementById(id);
        if (juegoDiv.style.display === "none" || juegoDiv.style.display === "") {
            juegoDiv.style.display = "block";
            juegoDiv.scrollIntoView({ behavior: "smooth" }); // Desplazamiento suave al div
        } else {
            juegoDiv.style.display = "none";
        }
    }

    // Asigna el evento a cada botón para mostrar el div correspondiente
    document.getElementById("botonJugar").addEventListener("click", function(event) {
        event.preventDefault();
        mostrarjuego('juegos');
        iniciarJuego(); // Inicia el juego de 'Catch the Candy'
    });

    document.getElementById("botonJugar2").addEventListener("click", function(event) {
        event.preventDefault();
        mostrarjuego('juegos2');
    });
});
