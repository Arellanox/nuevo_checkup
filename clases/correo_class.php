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
        $mail = new PHPMailer(true);

        #configuramos el correo de donde saldran los mensajes, la cabecer, etc
        $username = 'hola@bimo-lab.com';
        $password = 'Bimo&2022';
        $fromName = 'bimo';
        
        $img = 'bimo.png';
        $descripcion = 'Laboratorio de Biología Molecular';
        // $fromName = utf8_decode('Biologia Molecular | Diagnóstico Biomolecular');
        // $descripcion = 'Laboratorio de Biología Molecular';

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
            $mail->setFrom($username, $fromName);
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
                    <div class="" id="contenido" style="background-color: #BABABA;">
                                <div class="head" style="overflow: auto;text-align: left;background-color: #616A6B;padding: 5px;color:white;">
                                  <img src="https://bimo-lab.com/archivos/sistema/'.$img.'" alt="img" style="border-radius: 15px;height: 55px;float: left;padding: 8px;"/>
                                  <p style="font-size: 20px;">Resultados de análisis</p>
                                </div>
                                <div class="esqueleto" style="padding: 5px 20px 15px 20px;color: white;font-size: 14px;background-color: #424949;">
                                  <h2>¡Buenas Tardes!</h2>
                                  <p align="justify">Se adjuntan resultados de laboratorio</p>
                                  <div class="atentamente-text" style="text-align: right;">
                                    <p>Atentamente</p>
                                    <p>'.$descripcion.'</p>
                                  </div>
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