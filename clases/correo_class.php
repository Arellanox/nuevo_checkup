<?php 
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Correo {

    function Correo(){

    }

    function sendLinkByEmail($email,$token){
        #envia la liga con un token para permitir a los pacientes realizar el prerregistro.

        #creamos un objeto de la clase phpmailer
        $mail = new PHPMailer();

        #configuramos el correo de donde saldran los mensajes, la cabecer, etc
        $username = 'hola@bimo-lab.com';
        $password = 'Bimo&2022';
        $fromName = utf8_decode('Biologia Molecular | Diagnóstico Biomolecular');
        $descripcion = 'Laboratorio de Biología Molecular';

        try{
            # server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $username;                     //SMTP username
            $mail->Password   = $password;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;        
            
            # recipients
            $mail->addAddress($email);

            # content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = utf8_decode('Agende su cita en [bimo Checkups]');
            $mail->Body = '<!DOCTYPE html>
            <html lang="en">
            
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
            </head>
            
            <body>
                <div>
                    <div style="display:flex; justify-content:center;">
                        <img src="https://www.bimo-lab.com/archivos/sistema/LogoConFondoAppAndroid.png" />
                        <img style="max-height:100px;" src="https://cdn19.picsart.com/9896529016.png">
                    </div>
                    <br />
                    <br />
                    <div style="max-width:35%; min-width:500px; margin:auto;">
                        <div style="background-color:lightgray; border-radius:5px 5px 0px 0px; padding: 5px; display:block;">
                            <p style="text-align:center; padding:0; margin:0;">Gracias por contactartar con BIMO armas biológicas,
                                puede hacer su preregistro desde el siguiente link </p>
                        </div>
                        <div
                            style="border-width: 0 1px 1px 1px; border-color:lightgray; border-style:solid; padding:5px; display:flex; justify-content:center; border-radius: 0px 0px 5px 5px">
                            <a href="https://bimo-lab.com/nuevo_checkup/vista/registro/index.php?codigo=' . $token . '" style="text-decoration:none;">Registro en linea</a>
                        </div>
            
                    </div>
            
                </div>
            </body>
            
            </html>';
    
            # send email
            $mail->send();

            return true;

        } catch (Exception $e){
            return false;
        }

    }
}
?>