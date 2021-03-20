$(document).ready(function(){
  $("#like, #dislike").click(function(){
      var idPhoto = $(".mostr_img").attr("id");
      var urlPath = $(".mostr_img").attr("src").split("./uploads/").join("");

      var type = this.id;
      
      var dataString = 'idPhoto=' + idPhoto + '&urlPath=' + urlPath + '&tipo=' + type;
    $.ajax({
          url: 'randomImatge.php',
          type: 'post',
          data: dataString,
          dataType: 'json',
          success: function(data){
              console.log(data)
              $(".mostr_img").attr("id",data.idPhoto);
              $(".mostr_img").attr("src","./uploads/"+data.urlPath);
              $(".gallery-title").text(data.title);
              $(".gallery-descr").html(data.description);
              $("#comments_much").html(data.comentaris);
              $(".gallery-tags").html(data.hashtags);
              $("#rating").html(data.rating);
              $("#likes").html(data.likes);
              $("#dislikes").html(data.dislikes);
              $("#usuari").html(data.username);
              console.log("El estatus es:"+data.estatus)
              var check = data.estatus;              

              if(check=='L'){
                $('#cora').removeClass('far fa-heart').addClass('fas fa-heart');
                $('#cora_break').css("color","#000000");
              }else if(check=='D'){
                $('#cora_break').css("color","#1A8CF4");
                $('#cora').removeClass('fas fa-heart').addClass('far fa-heart');
              }else{
                $('#cora').removeClass('fas fa-heart').addClass('far fa-heart');
                $('#cora_break').css("color","#000000");
              }
          }
      });
  });

  //NOTE S'ENCARREGA DE ACTUALITZAR O INSERIR LIKES O DISLIKES
  $("#like, #dislike").click(function(){
      var idPhoto = $(".mostr_img").attr("id");
      var type = this.id;
      var dataString = 'idPhoto=' + idPhoto + '&tipo=' + type;
    $.ajax({
          url: 'actualitzarLikesDislikes.php',
          type: 'post',
          data: dataString,
          dataType: 'json',
          success: function(data){
            console.log("funciona");
          }
      });
  });})