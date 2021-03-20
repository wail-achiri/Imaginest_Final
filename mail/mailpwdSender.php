<?php
    use PHPMailer\PHPMailer\PHPMailer;
    require 'vendor/autoload.php'; ///error
    $mail = new PHPMailer();
    $mail->IsSMTP();

    //Configuració del servidor de Correu
    //Modificar a 0 per eliminar msg error
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ));
     


    $mail->Username = 'welachiri2021@educem.net';
    $mail->Password = '';

    //Dades del correu electrònic
    $mail->SetFrom('reset@imaginest.com','Imaginest');
    $mail->Subject = 'Resetejar contrasenya Imaginest';
    $mail->addEmbeddedImage('./img/logov2.png','logomail');
    
    if(filter_var($email_user,FILTER_VALIDATE_EMAIL)){ //NOTE COMPROBARA SI ES CORREO
        $mail->MsgHtml("<h1 style='text-align: center;'>IMAG<strong style='color:#0f7ef1'>INEST</strong></h1><div style='text-align: center;'><img width='800' height='160' src='cid:logomail'/></div><h3 style='text-align: center;'>Per resetejar la seva contrasenya dóna-li click: </strong><a style='color:#0f7ef1' href=' http://localhost/ExercicisClasse/Practicas/Testing/Imaginest_Final/resetPassword.php?code=$codi_hash&mail=$email_user'>Vull restablir la meva contrasenya!</a></h3> ");
    }else{
        $mail->MsgHtml("<h1 style='text-align: center;'>IMAG<strong style='color:#0f7ef1'>INEST</strong></h1><div style='text-align: center;'><img width='800' height='160' src='cid:logomail'/></div><h3 style='text-align: center;'>Per resetejar la seva contrasenya dóna-li click: </strong><a style='color:#0f7ef1' href=' http://localhost/ExercicisClasse/Practicas/Testing/Imaginest_Final/resetPassword.php?code=$codi_hash&user=$email_user'>Vull restablir la meva contrasenya!</a></h3> ");
    }
    
    //Destinatari
    $address = 'welachiri2021@educem.net';
    $mail->AddAddress($address, 'Test');

    //Enviament
    $result = $mail->Send();
    if(!$result){
        echo 'Error: ' . $mail->ErrorInfo;
    }