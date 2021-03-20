<?php
    //TODO CORREO QUE ENS CONFIRMA EL REGISTRE I QUE ENS FACILITA PER VERIFICAR LA COMPTE
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
    $mail->SetFrom('welcome@imaginest.com','Imaginest');
    $mail->Subject = 'Benvingut a Imaginest';
    $mail->addEmbeddedImage('./img/logov2.png','logomail');
    $mail->MsgHtml("<h1 style='text-align: center;'>BENVINGUT A IMAG<strong style='color:#0f7ef1'>INEST</strong></h1><div style='text-align: center;'><img width='800' height='160' src='cid:logomail'/></div></p><h2 style='text-align: center;'>Si us plau <strong style='color:#0f7ef1'>verifica</strong> la teva compta: <a style='color:#0f7ef1' href=' http://localhost/ExercicisClasse/Practicas/Testing/Imaginest_Final/lib/mailCheckAccount.php?code=$codi_hash&mail=$email'>Activa-la ara!</a></h2> ");
    
    //Destinatari
    $address = 'welachiri2021@educem.net';
    $mail->AddAddress($address, 'Test');

    //Enviament
    $result = $mail->Send();
    if(!$result){
        echo 'Error: ' . $mail->ErrorInfo;
    }