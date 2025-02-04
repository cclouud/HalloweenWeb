const canvas = document.getElementById('juegos');
const ctx = canvas.getContext('2d');
const sonidosusto = new Audio('../audio/susto.mp3');



// Cargar las imágenes de la cesta, calabaza y caramelo
let cestaimg = new Image();
cestaimg.src = '../img/cesta.png';




let calabazaImg = new Image();
calabazaImg.src = '../img/calabaza.png';

let carameloImg = new Image();
carameloImg.src = '../img/caramelo.png';

let susto = new Image();
susto.src = '../img/susto.webp'; // Asegúrate de que la ruta sea correcta

let jugando = true; // Variable que indica si el juego está en curso
let notificaciones = [];
let calab = [];
let caram = [];
let punt = 0;
let izq = false;
let der = false;
let cesta = {
    x: canvas.width / 2 - 40,
    y: canvas.height - 30,
    height: 30,
    width: 70,
    dx: 2,
    hitboxOffsetX: 10,  // Reducción del tamaño de la hitbox desde los bordes laterales
    hitboxOffsetY: 5    // Reducción del tamaño de la hitbox desde la parte superior
};

function cestas() {
    ctx.drawImage(cestaimg, cesta.x, cesta.y, cesta.width, cesta.height);
}

function teclapul(event) {
    if (event.key === 'ArrowLeft') {
        izq = true;
    } else if (event.key === 'ArrowRight') {
        der = true;
    }
}

function teclale(event) {
    if (event.key === 'ArrowLeft') {
        izq = false;
    } else if (event.key === 'ArrowRight') {
        der = false;
    }
}

document.addEventListener('keydown', teclapul);
document.addEventListener('keyup', teclale);


function mover() {
    if (izq && cesta.x > 0) {
        cesta.x -= cesta.dx;
    } else if (der && cesta.x + cesta.width <= canvas.width) {
        cesta.x += cesta.dx;
    }
}


function agregarNotificacion(texto, x, y, color) {
    notificaciones.push({
        texto: texto,
        x: x,
        y: y,
        color: color,
        duracion: 60 // Duración en fotogramas (~1 segundo si tenemos 60 FPS)
    });
}


function crearCalab() {
    let newCalab = {
        x: Math.random() * (canvas.width - 30),
        y: 0,
        width: 30,
        height: 30,
        dy: 1
    };
    calab.push(newCalab);
}

function crearCaram() {
    let newCaram = {
        x: Math.random() * (canvas.width - 30),
        y: 0,
        width: 20,
        height: 20,
        dy: 1
    };
    caram.push(newCaram);
}

function aparecerCalab() {
    calab.forEach(pumpkin => {
        ctx.drawImage(calabazaImg, pumpkin.x, pumpkin.y, pumpkin.width, pumpkin.height);
    });
}

function aparecerCaram() {
    caram.forEach(candy => {
        ctx.drawImage(carameloImg, candy.x, candy.y, candy.width, candy.height);
    });
}

function moverCalab() {
    calab.forEach(pumpkin => {
        pumpkin.y += pumpkin.dy;
    });
}

function moverCaram() {
    caram.forEach(candy => {
        candy.y += candy.dy;
    });
}

function checkCollisions() {
    // Detectar colisiones con calabazas
    calab = calab.filter(pumpkin => {
        if (
            pumpkin.y + pumpkin.height > cesta.y + cesta.hitboxOffsetY &&
            pumpkin.x < cesta.x + cesta.width - cesta.hitboxOffsetX &&
            pumpkin.x + pumpkin.width > cesta.x + cesta.hitboxOffsetX
        ) {
            punt -= 5; // Restar 5 puntos
            agregarNotificacion('-5', pumpkin.x, pumpkin.y, 'red'); // Añadir notificación para la calabaza
            return false;
        }
        return pumpkin.y + pumpkin.height <= canvas.height;
    });

    // Detectar colisiones con caramelos
    caram = caram.filter(candy => {
        if (
            candy.y + candy.height > cesta.y + cesta.hitboxOffsetY &&
            candy.x < cesta.x + cesta.width - cesta.hitboxOffsetX &&
            candy.x + candy.width > cesta.x + cesta.hitboxOffsetX
        ) {
            punt += 10; // Sumar 10 puntos
            agregarNotificacion('+10', candy.x, candy.y, 'green'); // Añadir notificación para el caramelo
            return false;
        }
        return candy.y + candy.height <= canvas.height;
    });
}


function mostrarNotificaciones() {
    notificaciones.forEach((notificacion, index) => {
        // Dibujar el texto
        ctx.fillStyle = notificacion.color;
        ctx.font = '20px Arial';
        ctx.fillText(notificacion.texto, notificacion.x, notificacion.y);

        // Actualizar la posición y la duración
        notificacion.y -= 1; // Subir el texto para darle un efecto animado
        notificacion.duracion--;

        // Eliminar la notificación si la duración ha llegado a cero
        if (notificacion.duracion <= 0) {
            notificaciones.splice(index, 1);
        }
    });
}

function mostrarPuntuacion() {
    ctx.font = '15px Arial';          // Ajustar el tamaño de la fuente a un valor razonable
    ctx.fillStyle = 'white';           // Cambiar 'ctx.color' a 'ctx.fillStyle' para definir el color del texto
    ctx.fillText('Puntahe: ' + punt, 10, 20);  // Cambiar 'puntuacion' a 'punt' si esta es la variable correcta
}


var sustillo = document.getElementById('suhtto');


// Elemento del botón
const botonJugar = document.getElementById('botonJugar');

// Define la puntuación máxima
const puntajeMeta = 70; // Ajusta este valor a la meta deseada









// Variable para controlar el bucle de animación
let bucleActivo = false;



// Función para inicializar o reiniciar el juego
function iniciarJuego() {
    if (bucleActivo) return; // Evitar iniciar múltiples bucles de animación

    // Reiniciar variables del juego
    punt = 0;
    calab = [];
    caram = [];
    notificaciones = [];
    jugando = true;
    bucleActivo = true;
    ctx.clearRect(0, 0, canvas.width, canvas.height); // Limpiar el canvas antes de empezar

    // Desactivar el botón mientras el juego está en curso
    botonJugar.disabled = true;

    // Iniciar el bucle del juego desde cero
    requestAnimationFrame(funcionar);
}


function funcionar() {
    if (!jugando || !bucleActivo) return; // Salimos de la función si el juego está detenido

    if (punt >= puntajeMeta) {
        detenerJuego();
        return;
    }

    ctx.clearRect(0, 0, canvas.width, canvas.height); // Limpiar cada fotograma
    cestas();
    mover();
    moverCalab();
    moverCaram();
    aparecerCalab();
    aparecerCaram();
    checkCollisions();
    mostrarNotificaciones();
    mostrarPuntuacion();

    requestAnimationFrame(funcionar); // Continuar el bucle solo si es necesario
}



// Función para detener el juego y mostrar un mensaje
function detenerJuego() {
    
    jugando = false; // Detenemos el juego actualizando la variable
    bucleActivo = false; // Indicamos que el bucle ha finalizado
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    sustillo.style.zIndex = 100;
    sustillo.style.opacity = 1;
    sustillo.play();

    setTimeout(() => {
        sustillo.style.opacity = 0;
        sustillo.style.zIndex =-10;
    }, 1000);
   

    // Reactivar el botón después de terminar el juego
    botonJugar.disabled = false;
}

// Evento para iniciar el juego al hacer clic en el botón "Jugar"
botonJugar.addEventListener('click', () => {
    if (!jugando) {
        iniciarJuego();
    }
});

// Intervalos para crear calabazas y caramelos mientras el juego está activo
setInterval(() => { if (jugando) crearCalab(); }, 1000); // Cada segundo
setInterval(() => { if (jugando) crearCaram(); }, 1500); // Cada 1.5 segundos
