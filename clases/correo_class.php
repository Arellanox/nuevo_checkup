<?php
include_once("miscelaneus.php");
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
include_once("credenciales_access/email_connect.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Correo
{
    private $emailCred;
    public $correo_seleccionado;

    function Correo()
    {
        $this->emailCred = new EmailConnect();
    }

    function sendLinkByEmail($email, $token)
    {
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

        try {
            # server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
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
                    <div id="contenido" style="background-color:#f6fdff">
                        <div style="overflow:auto;text-align:left;background-color:rgb(000,078,089);padding:5px;color:white">
                            <img src="https://bimo-lab.com/archivos/sistema/bimo_banner.png" alt="img" style="border-radius:15px;height:55px;float:left;padding:8px" class="CToWUd a6T" data-bit="iit" tabindex="0">
                            <p style="font-size:20px">Laboratorio Biologia Molecular</p>
                        </div>
                        <div style="padding:5px 20px 15px 20px;color:black;font-size:14px;background-color:#f6fdff">
                            <h2>
                                ¡Buenas tardes!
                            </h2>
                            <p align="justify">
                                Se ha generado un nuevo token para su Pre-registro en bimo:
                            </p>
                            <p>
                                <a href="https://bimo-lab.com/nuevo_checkup/vista/registro/?token=' . $token . '" target="_blank"> Registrar aqui </a>
                            </p>
                            <!-- <p> 
                                Guarde su nuevo prefolio de identificación (<strong>("FOLIO")</strong>) para el ingreso a _bimo checkup_
                            </p> -->

                            <div style="text-align:right">
                            <p>Atentamente</p>
                            <p>Laboratorio de Biología Molecular</p>
                            </div>
                        </div>
                    </div>
                </body>
            </html>';

            # send email
            $mail->send();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getCorreoSeleccionado()
    {
        return $this->correo_seleccionado;
    }

    private function setCorreoSeleccionado($correo)
    {
        $this->correo_seleccionado = $correo;
    }

    function sendEmail(
        $bodySelected,
        $subject,
        $emails = array(),
        $token = null,
        $reportes = array(),
        $resultados = 0,
        $paciente = null,
        # estas variables son para insertar en la tabla de correos.
        $id_turno = null,
        $area_id = null,
        $master = null
    )
    # $bodyselected indica el cuerpo que se envia en el correo.
    # $emails, direcciones de correo electronico de destino.
    # $token, se usa para enviar el link de prerregistro.
    # $reportes, todos los archivos a enviar como imagenes o los resultados de las distintas areas.
    # $resultados, indicica si lo que se envia es un resultado [enviar 1]
    {
        #creamos un objeto de la clase phpmailer
        $mail = new PHPMailer(true);
        $mis = new Miscelaneus();

        #configuramos el correo de donde saldran los mensajes, la cabecer, etc
        if ($resultados == 0) {
            $username = 'hola@bimo-lab.com';
            $this->setCorreoSeleccionado($username);
            $password = $this->emailCred->hola;
            $fromName = 'bimo';
        } else if ($resultados == 1) {
            $username = 'soporte@bimo-lab.com';
            $this->setCorreoSeleccionado($username);
            $password = $this->emailCred->soporte;
            $fromName = 'Resultados [bimo]';
        } else {
            $username = 'resultados@bimo-lab.com';
            $this->setCorreoSeleccionado($username);
            $password = $this->emailCred->resultados;
            $fromName = 'Resultados [bimo]';
        }


        $img = 'bimo.png';
        $descripcion = 'Laboratorio de Biología Molecular';
        // $fromName = utf8_decode('Biologia Molecular | Diagnóstico Biomolecular');
        // $descripcion = 'Laboratorio de Biología Molecular';

        try {
            # server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.hostinger.com';                   //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $username;                              //SMTP username
            $mail->Password   = $password;                              //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;

            # recipients
            $mail->setFrom($username, $fromName);
            foreach ($emails as $email) {
                $mail->addAddress($email);
            }

            #$mail->addBCC('josue.delacruz@bimo.com.mx');
            $mail->addBCC("hola@bimo.com.mx");
            #$mail->addBCC("luis.cuevas@bimo.com.mx");
            $mail->addBCC("confirmacion_resultados@bimo-lab.com");
            // $mail->addBCC("sucursal.mendez@bimo.com.mx");
            // $mail->addBCC("marthita.acopa@bimo.com.mx");
            //$mail->addBCC("sucursal.mendez@bimo.com.mx");

            #MEDIANTE EL TURNO SE ENVIAN LOS CORREOS DE FRANQUICIA QUE ESTAN REGISTRADOS
            # EN EL SISTEMA MEDIANTE UN CLIENTE_ID, QUE ES OBTENIDO MEDIANTE EL TURNO.
            if (isset($id_turno) && isset($master)) {
                $emails_franquicia = $this->obtenerCorreoFranquiciaParaResultados($master, $id_turno);

                if (!empty($emails_franquicia)) {
                    foreach ($emails_franquicia as $email) {
                        $mail->addBCC($email['CORREO_DESTINO']);
                    }
                }
            }

            # attach files
            foreach ($reportes as $file) {
                $f = explode("nuevo_checkup", $file);
                if (!$mail->addAttachment(".." . $f[1])) {
                    $mis->setLog("No se adjunto el archivo.", basename($file));
                }
            }

            # content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = utf8_decode($subject);

            switch ($bodySelected) {
                case "token":
                    $mail->Body = $this->cuerpoCorreoToken($token);
                    break;
                case "resultados":
                    $mail->Body = $this->cuerpoCorreoLaboratorio();
                    break;
                case "password":
                    $mail->Body = $this->cuerpoRecuperarPassword($token);
                    break;
                case "fastck":
                    $f = str_replace("_", " ", $paciente);
                    $mail->Body = $this->cuerpoCorreoFastCheckup($f);
                    break;
                case 'cotizacion':
                    $mail->Body = $this->cuerpoCotizaciones();
                    break;
                case "formularioContacto":
                    $mail->Body = $this->cuerpoFormularioContacto($token);
                    break;
                case "botOrdenMedica":
                    $mail->Body = $this->cuerpoOrdenMedica($token);
                    break;    
                case "landings":
                    $mail->Body = $this->cuerpoLandings($token);
                    break;
                case "landings_2":
                    $mail->Body = $this->cuerpoLandings2($token);
                    break;
                case 'corroborarCorreos':
                    $mail->Body = $this->cuerpoCorroborarDatos($token);
                    break;
                case 'heartbeat': 
                    $mail->Body = $this->cuerpoHeartbeat();
                    break;
            }

            # send email
            $mail->send();

            if (isset($id_turno)) {
                $response = $master->insertByProcedure("sp_correos_g", [
                    $id_turno,
                    $area_id,
                    $this->getCorreoSeleccionado(),
                    json_encode($emails),
                    null,
                    "CORRECTO",
                    1
                ]);
            }

            return true;
        } catch (Exception $e) {

            if (isset($id_turno)) {

                $response = $master->insertByProcedure("sp_correos_g", [
                    $id_turno,
                    $area_id,
                    $this->getCorreoSeleccionado(),
                    json_encode($emails),
                    null,
                    "ERROR",
                    0
                ]);
            }

            $mis->setLog($e, "Clase correo [sendMail]");
            return false;
        }
    }

    private function obtenerCorreoFranquiciaParaResultados($master, $turno){
        return $master->getByProcedure("sp_correos_franquicia_para_resultado_b", [$turno]);
    }

    private function cuerpoHeartbeat(){
        $html = '<!doctype html>
                    <html>
                    <head>
                    <meta charset="utf-8">
                    </head>
                    <body style="font-family: Arial, sans-serif; background: #f9f9f9; padding: 20px;">
                    <div style="max-width: 500px; margin: auto; background: #ffffff; border: 1px solid #ddd; border-radius: 6px; padding: 20px; text-align: center;">
                        <h2 style="color: #d9534f; margin-bottom: 10px;">⚠️ Alerta de servidor</h2>
                        <p style="font-size: 15px; color: #333;">
                        El servidor <strong>BIMO</strong> ya no está en línea.
                        </p>
                        <p style="font-size: 13px; color: #777; margin-top: 20px;">
                        Mensaje generado automáticamente por el sistema de monitoreo.
                        </p>
                    </div>
                    </body>
                    </html>
                    ';

        return $html;
    }

    # cuerpo corroborar datos
    private function cuerpoCorroborarDatos($data){
        $html = '<!DOCTYPE html>
        <html lang="es">
        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Corroboración de datos</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }
            .container {
                max-width: 600px;
                margin: 20px auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }
            h1 {
                color: #333;
                text-align: center;
            }
            p {
                color: #666;
                line-height: 1.6;
            }
            .logo {
                text-align: center;
                margin-bottom: 20px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }
            th, td {
                padding: 10px;
                border-bottom: 1px solid #ddd;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
        </style>
        </head>
        <body>
        <div class="container">
            <div class="logo">
                <img src="https://bimo-lab.com/archivos/sistema/bimo_banner.png" alt="Logo de la empresa" width="200">
            </div>
            <h1>Corroboración de datos</h1>
            <p>Estimado/a '.$data['NOMBRE'].',</p>
            <p>Hemos recibido los siguientes datos y estamos en proceso de corroboración:</p>
            <table>
                <tr>
                    <th>Información</th>
                    <th>Valor</th>
                </tr>
                <tr>
                    <td>Nombre</td>
                    <td>' . $data['NOMBRE'] . ' ' . $data['PATERNO'] . ' ' .$data['MATERNO'] . '</td>
                </tr>
                <tr>
                    <td>Correo 1</td>
                    <td>' . $data['CORREO'] . '</td>
                </tr>
                <tr>
                    <td>Correo 2</td>
                    <td>' . $data['CORREO_2'] . '</td>
                </tr>
                <tr>
                    <td>Teléfono</td>
                    <td>' . $data['CELULAR'] . '</td>
                </tr>
                <tr>
                    <td>Fecha de nacimiento</td>
                    <td>' . $data['NACIMIENTO'] . '</td>
                </tr>
                <tr>
                    <td>CURP</td>
                    <td>' . $data['CURP'] . '</td>
                </tr>
                <tr>
                    <td>Pasaporte</td>
                    <td>' . $data['PASAPORTE'] . '</td>
                </tr>
                <tr>
                    <td>RFC</td>
                    <td>' . $data['RFC'] . '</td>
                </tr>
                <!-- Agrega más filas según los datos -->
            </table>
            <p>Por favor, asegúrese de que la información proporcionada sea correcta y esté actualizada.</p>
            <p>Si tiene alguna pregunta o necesita proporcionar información adicional, no dude en ponerse en contacto con nosotros.</p>
            <p>Gracias por su colaboración.</p>
            <p>Saludos cordiales,</p>
            <p>bimo Checkups</p>
        </div>
        </body>
        </html>
        ';
        return $html;
    }

    # cuerpo landiungs 2
    private function cuerpoLandings2($data){
        $html = '<!DOCTYPE html>
        <html lang="es">
        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>¡Quiero una radiografía!!!</title>
        <style>
          body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            text-align: center;
          }
          
          .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
          }
          
          h1 {
            color: #333;
            font-size: 32px;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
          }
          
          p {
            color: #666;
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 30px;
          }
          
          table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
          }
          
          th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
          }
          
          th {
            background-color: #f2f2f2;
            color: #333;
          }
          
          td {
            background-color: #fff;
            color: #666;
          }
        </style>
        </head>
        <body>
          <div class="container">
            <h1>¡¡¡Nuevo <strong>lead</strong> captado!!!</h1>
            <p>Recibimos los datos de contacto de una persona interesada en nuestros servicios y estamos ansiosos por conectarnos con ella. ¡Espero que te sientas tan entusiasmado/a como yo! Recuerda mantener tu energía positiva y tu sonrisa lista, porque juntos haremos que esta experiencia sea inolvidable para nuestro nuevo contacto.</p>
        
            <p>¡Gracias por tu dedicación y entusiasmo en hacer crecer nuestro negocio!</p>
            <table>
              <tr>
                <th>Nombre Completo</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Producto Interesado</th>
              </tr>
              <tr>
                <td>'.$data['nombre'].'</td>
                <td>'.$data['telefono'].'</td>
                <td>'.$data['email'].'</td>
                <td>'.$data['clave'].'</td>
              </tr>
              
              <!-- Puedes agregar más filas según sea necesario -->
            </table>
          </div>
        </body>
        </html>';
        return $html;
    }

    # cuerpo de las landings
    private function cuerpoLandings($data){
        $html = '<!DOCTYPE html>
        <html lang="es">
        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>¡Quiero una radiografía!!!</title>
        <style>
          body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            text-align: center;
          }
          
          .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
          }
          
          h1 {
            color: #333;
            font-size: 32px;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
          }
          
          p {
            color: #666;
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 30px;
          }
          
          table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
          }
          
          th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
          }
          
          th {
            background-color: #f2f2f2;
            color: #333;
          }
          
          td {
            background-color: #fff;
            color: #666;
          }
        </style>
        </head>
        <body>
          <div class="container">
            <h1>¡¡¡Quiero una radiografía!!!</h1>
            <p>Recibimos los datos de contacto de una persona interesada en nuestros servicios y estamos ansiosos por conectarnos con ella. ¡Espero que te sientas tan entusiasmado/a como yo! Recuerda mantener tu energía positiva y tu sonrisa lista, porque juntos haremos que esta experiencia sea inolvidable para nuestro nuevo contacto.</p>
        
            <p>¡Gracias por tu dedicación y entusiasmo en hacer crecer nuestro negocio!</p>
            <table>
              <tr>
                <th>Nombre Completo</th>
                <th>Teléfono</th>
                <th>Email</th>
              </tr>
              <tr>
                <td>'.$data['nombre'].'</td>
                <td>'.$data['telefono'].'</td>
                <td>'.$data['email'].'</td>
              </tr>
              
              <!-- Puedes agregar más filas según sea necesario -->
            </table>
          </div>
        </body>
        </html>'
        ;
        return $html;
    }

    private function cuerpoFormularioContacto($data)
    {
        $html = "<!DOCTYPE html>
        <html>
        
        <head>
            <meta charset=d\"UTF-8\">
            <title>Datos de Contacto</title>
            <style>
                /* Estilos para dar formato al correo */
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f2f2f2;
                    margin: 0;
                    padding: 0;
                }
        
                .container {
                    max-width: 600px;
                    background-color: #fff;
                    margin: 20px auto;
                    padding: 20px;
                    border-radius: 5px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
        
                h1 {
                    color: #00785e;
                    text-align: center;
                }
        
                .info p {
                    margin-bottom: 10px;
                    color: #333;
                }
        
                .mensaje {
                    background-color: #00bbb9;
                    padding: 20px;
                    border-radius: 5px;
                    margin-top: 20px;
                }
        
                .mensaje p {
                    font-size: 16px;
                    color: #fff;
                }
            </style>
        </head>
        
        <body>
            <div class=\"container\">
                <h1>Datos de Contacto</h1>
                <div class=\"info\">
                    <p><strong>Nombre:</strong> " . $data['nombre'] . "</p>
                    <p><strong>Email:</strong> " . $data['email'] . "</p>
                    <p><strong>Número de Teléfono:</strong> " . $data['telefono'] . "</p>
                    <p><strong>Asunto:</strong>" . $data['asunto'] . "</p>
                    <p><strong>Política de privacidad:</strong> " . $data['politica'] . "</p>
                </div>
                <div class=\"mensaje\">
                    <p><strong>Mensaje:</strong></p>
                    <p>" . $data['comentario_ayuda'] . " ?></p>
                </div>
            </div>
        </body>
        
        </html>
        ";
        return $html;
    }
    private function cuerpoCorreoFastCheckup($nombre)
    {
        $html = '<!DOCTYPE html>
        <html lang="es">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>bimo checkups</title>
        </head>

   <body>
        <div id="contenido" style="background-color:#f6fdff">
            <div style="overflow:auto;text-align:left;background-color:rgb(000,078,089);padding:5px;color:white">
                <img src="https://bimo-lab.com/nuevo_checkup/archivos/sistema/icono_administrativo.jpeg" alt="img"
                style="border-radius:15px;height:55px;float:left;padding:8px">
                <p style="font-size: 20px; color:white">Diagnóstico Biomolecular S.A. de C.V.</p>
            </div>
            <div style="padding:5px 20px 15px 20px;color:black;font-size:14px;background-color:#f6fdff">
                <h2>
                    ¡Hola ' . $nombre . '!
                </h2>
                <p>
                    En este correo encontrarás los resultados de tu “Fast Checkup” realizado el día de hoy por bimo.
                </p>
                <p>
                    Te invitamos a que conozcas nuestros servicios de laboratorio clínico, laboratorio de biología molecular, ultrasonografía, rayos X, espirometría, audiometría, valoración visual, electrocardiograma y nutrición.
                </p>
                <p>
                    Visítanos de lunes a sábado de 07:00 a 14:30 horas. en Avenida Pagés Llergo No. 150 interior 1, Col. Arboledas, Villahermosa Tabasco C.P. 86079. Teléfonos de contacto: 9936341483, 9936340250, 9936341469. Correo electrónico: hola@bimo.com.mx
                </p>

                <div style="text-align:right">
                    <p>Atentamente</p>
                    <p>bimo<br>Checkup Clinico y Preventivo</p>
                </div>
            </div>
        </div>
    </body>
        </html>';
        return $html;
    }
    private function cuerpoCorreoLaboratorio()
    {


        $html = '<!DOCTYPE html>
                    <html lang="es">

                    <head>
                        <meta charset="UTF-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>bimo checkups</title>
                    </head>

               <body>
                    <div id="contenido" style="background-color:#f6fdff">
                        <div style="overflow:auto;text-align:left;background-color:rgb(000,078,089);padding:5px;color:white">
                            <img src="https://bimo-lab.com/nuevo_checkup/archivos/sistema/icono_administrativo.jpeg" alt="img"
                            style="border-radius:15px;height:55px;float:left;padding:8px">
                            <p style="font-size: 20px; color:white">Diagn&oacute;stico Biomolecular S.A. de C.V.</p>
                        </div>
                        <div style="padding:5px 20px 15px 20px;color:black;font-size:14px;background-color:#f6fdff">
                            <h2>
                                &iexcl;Buenas tardes!
                            </h2>
                            <p>
                                Se adjuntan resultados.
                            </p>

                            <div style="text-align:right">
                                <p>Atentamente</p>
                                <p>bimo<br>Checkup Clinico y Preventivo</p>
                            </div>
                        </div>
                    </div>
                </body>
                    </html>';
        return $html;
    }

    private function cuerpoCorreoToken($token)
    {
        $html = '<!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
            </head>
            <body>
                <div id="contenido" style="background-color:#f6fdff">
                    <div style="overflow:auto;text-align:left;background-color:rgb(000,078,089);padding:5px;color:white">
                        <img src="https://bimo-lab.com/nuevo_checkup/archivos/sistema/icono_administrativo.jpeg" alt="img"
                        style="border-radius:15px;height:55px;float:left;padding:8px">
                        <p style="font-size: 20px; color:white">Diagnóstico Biomolecular S.A. de C.V.</p>
                    </div>
                    <div style="padding:5px 20px 15px 20px;color:black;font-size:14px;background-color:#f6fdff">
                        <h2>
                            ¡Buenas tardes!
                        </h2>
                        <p align="justify">
                            Se ha generado un nuevo token para su Pre-registro en bimo:
                        </p>
                        <p>
                            <a href="https://bimo-lab.com/nuevo_checkup/vista/registro/?token=' . $token . '" target="_blank"> Registrar aqui </a>
                        </p>
                        <!-- <p> 
                            Guarde su nuevo prefolio de identificación (<strong>("FOLIO")</strong>) para el ingreso a _bimo checkup_
                        </p> -->

                        <div style="text-align:right">
                        <p>Atentamente</p>
                        <p>Laboratorio de Biología Molecular</p>
                        </div>
                    </div>
                </div>
            </body>
        </html>';

        return $html;
    }

    private function cuerpoRecuperarPassword($token)
    {

        $token = base64_encode($token);
        $html = '<!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
            </head>
            <body>
                <div id="contenido" style="background-color:#f6fdff">
                    <div style="overflow:auto;text-align:left;background-color:rgb(000,078,089);padding:5px;color:white">
                        <img src="https://bimo-lab.com/nuevo_checkup/archivos/sistema/icono_administrativo.jpeg" alt="img"
                        style="border-radius:15px;height:55px;float:left;padding:8px">
                        <p style="font-size: 20px; color:white">Diagnóstico Biomolecular S.A. de C.V.</p>
                    </div>
                    <div style="padding:5px 20px 15px 20px;color:black;font-size:14px;background-color:#f6fdff">
                        <h2>
                            ¡Buenas tardes!
                        </h2>
                        <p align="justify">
                            Se ha generado un nuevo token para su Pre-registro en bimo:
                        </p>
                        <p>
                            <a href="https://bimo-lab.com/nuevo_checkup/reset-password/?token=' . $token . ' target="_blank">Cambia tu password aquí</a>
                        </p>
                        <!-- <p> 
                            Guarde su nuevo prefolio de identificación (<strong>("FOLIO")</strong>) para el ingreso a _bimo checkup_
                        </p> -->

                        <div style="text-align:right">
                        <p>Atentamente</p>
                        <p>Laboratorio de Biología Molecular</p>
                        </div>
                    </div>
                </div>
            </body>
        </html>';
        return $html;
    }

    private function cuerpoCotizaciones()
    {

        $html = '<!DOCTYPE html>
                    <html lang="es">

                    <head>
                        <meta charset="UTF-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>bimo checkups</title>
                    </head>

               <body>
                    <div id="contenido" style="background-color:#f6fdff">
                        <div style="overflow:auto;text-align:left;background-color:rgb(000,078,089);padding:5px;color:white">
                            <img src="https://bimo-lab.com/nuevo_checkup/archivos/sistema/icono_administrativo.jpeg" alt="img"
                            style="border-radius:15px;height:55px;float:left;padding:8px">
                            <p style="font-size: 20px; color:white">Diagnóstico Biomolecular S.A. de C.V.</p>
                        </div>
                        <div style="padding:5px 20px 15px 20px;color:black;font-size:14px;background-color:#f6fdff">
                            <h2>
                                ¡Buenas tardes!
                            </h2>
                            <p>
                              Espero que este mensaje le encuentre bien. Le adjunto la cotización detallada de nuestros servicios clínicos. Estamos seguros de que nuestra experiencia y dedicación nos permitirán brindarle una atención de calidad para cubrir todas sus necesidades de salud.</p>

                           <p> Si tiene alguna consulta o necesita más información, no dude en ponerse en contacto con nosotros. Estamos a su disposición para ayudarle en lo que necesite.</p>

                           <p> Agradecemos la oportunidad de servirle y esperamos poder colaborar juntos en su bienestar.</p>

                            <p>Quedamos atentos a cualquier comentario o inquietud.
                            </p>
                            <div style="text-align:right">
                                <p>Atentamente</p>
                                <p>bimo<br>Checkup Clinico y Preventivo</p>
                            </div>
                        </div>
                    </div>
                </body>
                    </html>';

        return $html;
    }
    private function cuerpoOrdenMedica($data)
    {
        $html = '<!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Información del Paciente</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 20px;
                    padding: 20px;
                }
        
                h1 {
                    color: #054d60; /* Azul oscuro para el título */
                }
        
                .patient-info {
                    border: 1px solid #ccc;
                    padding: 10px;
                    border-radius: 5px;
                    background-color: #fff;
                    margin-top: 20px;
                }
        
                img {
                    max-width: 100%;
                    height: auto;
                    border-radius: 5px;
                }
        
                strong {
                    color: #1699c7; /* Azul claro para los elementos resaltados */
                }
            </style>
        </head>
        <body>
            <h1>Información del Paciente</h1>
        
            <div class="patient-info">
                <img src="' . $data['ordenMedica'] . '" alt="Imagen del Paciente">
                <p><strong>Nombre:</strong> ' . $data['nombrePaciente'] . '</p>
                <p><strong>Teléfono:</strong> ' . $data['telefono'] . '</p>
                <p><strong>Fecha de Nacimiento:</strong> ' . $data['fechaNacimiento'] . '</p>
            </div>
        </body>
        </html>
        ';

        return $html;
    }
}
