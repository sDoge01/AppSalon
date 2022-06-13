<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

    class Email{
        public $nombre;
        public $email;
        public $token;

        public function __construct($nombre, $email, $token)
        {
            $this->nombre = $nombre;
            $this->email = $email;
            $this->token = $token;
        }


        public function enviarConfirmacion(){
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = '4f74c28f521e8c';
            $mail->Password = '7583a7f1f175d0';

            //Paràmetros de envio:
            $mail->setFrom('sevasdoge.01@gmail.com');
            $mail->addAddress('sevasdoge.01@gmail.com');
            $mail->Subject = 'Un paso más!';

            //PONER EL CORREO COMO UN HTML:
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            $contenido = "<html>";
            $contenido .= "<p>Hola " . $this->nombre ."! Ya casi terminamos de crear tu cuenta!</p>";
            $contenido .=  "<p>Para confirmar tu cuenta simplemente dale click al enlace de aquí al lado ->";
            $contenido .= "<a href='localhost:3000/confirmar-cuenta?token=" . $this->token ."'> Dame click!</a> </p>";
            $contenido .= "</html>";

            $mail->Body = $contenido;


            //Enviar el email:
            $mail->send();

        }

        public function enviarInstrucciones(){
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = '4f74c28f521e8c';
            $mail->Password = '7583a7f1f175d0';

            //Paràmetros de envio:
            $mail->setFrom('sevasdoge.01@gmail.com');
            $mail->addAddress('sevasdoge.01@gmail.com');
            $mail->Subject = 'Reestablece tu contraseña';

            //PONER EL CORREO COMO UN HTML:
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            $contenido = "<html>";
            
            $contenido .= "<p>Hola <strong>" . $this->nombre ."</strong>! Sigue las instrucciones para reestablecer tu contraseña</p>";
            $contenido .=  "<p>Presiona en el siguiente enlace de aquí al lado ->";
            $contenido .= "<a href='localhost:3000/recuperar?token=" . $this->token ."'> Reestablecer contraseña</a> </p>";
            $contenido .= "</html>";
            
            
            $mail->Body = $contenido;


            //Enviar el email:
            $mail->send();
        }
    }

?>