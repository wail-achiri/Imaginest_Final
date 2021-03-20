let divs = document.querySelectorAll(".item"); // esto selecciona todas las fotos (divs classe item)
let com = document.querySelectorAll(".itemo");

// Función para mover slider adelante o atrás, recibiendo evento como parámetro
function sliderMove(e) {
  // Obtener elemento activo
  let active = document.querySelector(".item.active");
  
  active.classList.remove("active");
  let actual = Array.from(divs).indexOf(active);
  // Saber la acción que se debe realizar, obteniendo clase del botón
  if (e.target.closest("div").className == "left-slide") {
    actual = actual == 0 ? divs.length - 1 : actual - 1;
  } else {
    // Calcular siguiente elemento
    actual = actual < divs.length - 1 ? actual + 1 : 0;
  }
  // Mostrar anterior o siguiente
  divs[actual].classList.add('active');
}

// Asignar evento a botones
document.querySelector(".left-slide").addEventListener("click", sliderMove);
document.querySelector(".right-slide").addEventListener("click", sliderMove);
