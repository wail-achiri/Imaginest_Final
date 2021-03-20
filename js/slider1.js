/*$(document).ready(function() {
     var default_color = $(".chars-counter").css("color");
   
     $("#comment-input").on('keydown keyup', function() {
       var comment_len = $(this).val().length;
       
       $("#chars-current").html(comment_len);
       
       if(comment_len == 60)
         $(".chars-counter").css("color", "red");
       
       if(comment_len < 60 && $('.chars-counter').css("color") != default_color)
         $(".chars-counter").css("color", default_color);
     });
     
     
     // Gallery slider
     let next = $('.fa-angle-right');
     let previous = $('.fa-angle-left');
     let counter = 1;
   
     setInterval(function(){
       $('.gallery-images p').html(counter + '/' + $('.gallery-images .gallery-image').length);
     },1);
   
     next.click(function(){
         counter++;
         $('.img-' + (counter - 1)).stop().fadeOut(0);
         $('.img-' + counter).stop().fadeIn(160);
   
         if(counter > $('.gallery-images .gallery-image').length) {
           counter = 1;
           $('.img-' + counter).fadeIn(160);
         }
     });
   
     previous.click(function(){
         counter--;
         $('.img-' + (counter + 1)).stop().fadeOut(0);
         $('.img-' + counter).stop().fadeIn(160);
   
         if (counter < 1) {
           counter = $('.gallery-images .gallery-image').length;
           $('.img-' + counter).fadeIn(160);
       }
     });
   
     // Gallery - show all
     let click = 0;
     $('.showAll').click(function(){
       click++;
       if (click % 2) {
           $('.gallery-image').css('display', 'inline');
           $('.arrow, .gallery-images p').hide(0);
           $(this).html('<i class="far fa-image"></i> Show slider');
           $('.gallery-image').animate({
               'width': '33%',
               'height': '33%'
           },200);
           $('.gallery-images').css('overflow-y', 'scroll');
         
          for(let i = 1; i <= $('.gallery-images div').length; i++) {
           $('.img-' + i).click(function(){
             $('.gallery-image').hide(0);
             $(this).css({
               'width': '100%',
               'height': '100%',
               'display': 'block'
             });
             $('.gallery-images').css('overflow-y', 'hidden');
           });
         }
         
         
       } else {
           $('.gallery-image').css('display', 'block');
           $('.arrow, .gallery-images p').show(0);
           $(this).html('<i class="fas fa-th"></i> All pictures');
           $('.gallery-image').animate({
               'width': '100%',
               'height': '100%'
           },200);
           $('.gallery-images').css('overflow-y', 'hidden');
         counter = 1;
       }
     });
   
   });*/

$(document).ready(function () {
  // AQUESTA FUNCIO ENS PERMETRA CONTAR QUANTES IMATGES HI HAN
  let next = $(".right-slide");
  let previous = $(".left-slide");
  let counter = 1;

  setInterval(function () {
    $(".gallery-images p").html(
      counter + "/" + $(".gallery-images .slider-items .item").length
    );
  }, 1);

  next.click(function () {
    counter++;

    if (counter > $(".gallery-images .slider-items .item").length) {
      counter = 1;
    }
  });

  previous.click(function () {
    counter--;

    if (counter < 1) {
      counter = $(".gallery-images .slider-items .item").length;
    }
  });
});

//ENS PERMETRA MOURE EL SLIDER
var slides = document.querySelector(".slider-items").children;
// var gallery = document.querySelector(".gallerys").children;
var nextSlide = document.querySelector(".right-slide");
var prevSlide = document.querySelector(".left-slide");
var totalSlides = slides.length;
// var totalGallery = gallery.length;
var index = 1;
var index2 = 1;

nextSlide.onclick = function () {
  next("next");
};
prevSlide.onclick = function () {
  next("prev");
};

function next(direction) {
  if (direction == "next") {
    index++;
    // index2++;
    if (index == totalSlides) {
      index = 0;
    }
    // if (index2 == totalGallery) {
    //   index2 = 0;
    // }
  } else {
    if (index == 0) {
      index = totalSlides - 1;
    } else {
      index--;
    }
    // if (index2 == 0) {
    //   index2 = totalGallery - 1;
    // } else {
    //   index2--;
    // }
  }

  for (i = 0; i < slides.length; i++) {
    slides[i].classList.remove("active");
  }
  slides[index].classList.add("active");
  // for (i = 0; i < gallery.length; i++) {
  //   gallery[i].classList.remove("active");
  // }

  // gallery[index2].classList.add("active");
}


// let divs = document.querySelectorAll('.item');

// // Función para mover slider adelante o atrás, recibiendo evento como parámetro
// function sliderMove(e) {
//     // Obtener elemento activo
//     let active = document.querySelector('.active');
//     // Quitar clase
//     active.classList.remove('active');

//     // ¿Necesitas ID de la foto?
//     // Obtener desde el primer div del elemento activo
//     let id = active.querySelector('img').id;
    
//     // Obtener posición del elemento actual
//     let actual = Array.from(divs).indexOf(active);
    
//     // Saber la acción que se debe realizar, obteniendo clase del botón
//     if(e.target.closest('div').className == 'left-slide') {
//         // Clic en anterior
//         // ***** AQUI GUARDAS EL LIKE *****
//         //like_update(id);
//         console.log('Ha hecho like en la foto: ' + id);
//         // Calcular elemento anterior
//         actual = (actual == 0) ? divs.length - 1 : actual - 1;
//     } else {
//         // Clic en siguiente
//         // ***** AQUI GUARDAS EL DISLIKE *****
//         console.log('Ha hecho dislike en la foto: ' + id);
//         // Calcular siguiente elemento
//         actual = (actual < divs.length - 1) ? actual + 1 : 0;
//     }
//     // Mostrar anterior o siguiente
//     divs[actual].classList.add('active');
// }

// // Asignar evento a botones
// document.querySelector('.left-slide').addEventListener('click', sliderMove);
// document.querySelector('.right-slide').addEventListener('click', sliderMove);
