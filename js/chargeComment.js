$(document).ready(function() {
    $("#form-comment").submit(function() {
        var idPhoto = $(".mostr_img").attr("id");
        var comment = $("#comment-say").val();
       
      
        $('#comment-say').val('');
        var dataString = 'idPhoto=' + idPhoto + '&comment=' + comment;
        console.log(dataString);
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "comentaris.php",
            data: dataString,
            success: function(response) {
              console.log(response);
              $("#comments_much").append(response.uno);
            }
        });
        return false;
    });
});