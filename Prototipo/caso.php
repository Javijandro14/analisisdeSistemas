<?php

//include 'conexion.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if (isset($_POST['new'])) {

    $correo = $_POST['correo'];
    $service = $_POST['option'];
    $comments = $_POST['comments'];
    $sql = "SELECT COUNT(CASEID)+1 FROM TBLCASE";
    $case = sqlsrv_fetch_array(sqlsrv_query($con, $sql), SQLSRV_FETCH_NUMERIC);
    $sql = "INSERT INTO TBLCASE VALUES((SELECT COUNT(CASEID)+1 FROM TBLCASE),(SELECT U.ID_USER FROM TBLUSER U WHERE U.EMAIL = '" . $correo . "')," . $service . ",'" . $comments . "','" . date("Y-m-d") . " " . date("H:i:s") . "')";
    $stmt = sqlsrv_query($con, $sql);

    //mail("jdiazp11@miumg.edu.gt","Creacion de caso No. " . $case ,$comments);


?>


    <body>

        <div id="success" style="background-color: rgb(236, 242, 245); width: 60%;height: auto;margin-top: 1%;margin-left: auto;margin-right: auto;margin-bottom: 0%;padding-bottom: 3px;">
            <nav style="background-color: #6CC1FF; text-align:center;">
                <h2 style="font-weight: 600;">Su caso ha sido creado</h2>
            </nav>

            <p>
                Numero de Caso: <strong><?php echo $case[0] ?></strong><br>
                Se le enviara una notificacion de su caso a este correo: <strong> <?php echo $correo ?> </strong><br>
                Creado por:<strong> <?php echo sqlsrv_fetch_array(sqlsrv_query($con, "SELECT U.USERNAME FROM TBLUSER U WHERE U.EMAIL = '" . $correo . "'"), SQLSRV_FETCH_NUMERIC)[0]; ?> </Strong>
                <br> Fue creado en esta fecha y hora: <strong><?php echo date("d-m-Y") . " " . date("H:i:s") ?> </strong>
            </p>

            <a type="Button" onclick="success()" class="btn btn-outline-dark">Cerrar</a>
        </div>


    </body>

    <script>
        function success() {
            var div = document.querySelector("#success");
            div.innerHTML="";
            div.style.backgroundColor = "white";
            div.style.height = "0px";
        }
    </script>

<?php
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function

    $message = '<div id="success" style="background-color: lightblue;width: 80%;height: auto;margin-top: 1%;margin-left: auto;margin-right: auto;margin-bottom: 0%;padding-bottom: 3px;">'.
    '<nav style="background-color: #3C99DC; text-align:center;"> <h2 style="font-weight: 600;">Su caso ha sido creado</h2>'.
    '</nav> <p>Numero de Caso: <strong>'. $case[0].'</strong><br>'.
    'Se le enviara una notificacion de su caso a este correo: <strong>'.  $correo .' </strong><br>'.
    'Creado por:<strong>'. sqlsrv_fetch_array(sqlsrv_query($con, "SELECT U.USERNAME FROM TBLUSER U WHERE U.EMAIL = '" . $correo . "'"), SQLSRV_FETCH_NUMERIC)[0] .'</Strong>'.
    '<br> Fue creado en esta fecha y hora: <strong>'.  date("d-m-Y") . " " . date("H:i:s") .' </strong></p></div>';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_CONNECTION;
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'soportefreshsrv@gmail.com';                     //SMTP username
        $mail->Password   = 'dpbernnqnkkmunwa';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('soportefreshsrv@gmail.com', 'javier diaz');
        $name = sqlsrv_fetch_array(sqlsrv_query($con, "SELECT U.NAMES FROM TBLUSER U WHERE U.EMAIL = '" . $correo . "'"), SQLSRV_FETCH_NUMERIC)[0];
        $mail->addAddress($correo, $name);     //Add a recipient
        //$mail->addAddress('ellen@example.com');               //Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Numero de Caso: '. $case[0];
        $mail->Body    = $message;
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        //$mail->send();
        //echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>