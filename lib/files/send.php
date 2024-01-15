
<?php
//Adding needing libraries
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Using requires to lad needing files
require './lib/files/phpmailer/src/Exception.php';
require './lib/files/phpmailer/src/PHPMailer.php';
require './lib/files/phpmailer/src/SMTP.php';

//Conditonal to check if POST['send'] exists

if (isset($_POST['username']) && isset($_POST['subject']) && isset($_POST['content'])) {
    echo 'hemos entrado en el condicional';
    //Filtering and storing post values into a variable
    $postValues = filter_input_array(INPUT_POST);
    //Inicialize variable by creating new PHPMailer object
    $email = new PHPMailer(true);
    //calling method to build a mail body sending
    //Get protocol
    $email->isSMTP();
    //Get gmail host for this case
    $email->Host = 'smtp.gmail.com';
    //Tell something
    $email->SMTPAuth = true;
    //Origin mail email
    $email->Username = 'j1992prueba1992@gmail.com';
    //Password applicacion
    $email->Password = 'divhxvdleamcmplm';
    //Get secure protocol
    $email->SMTPSecure = 'ssl';
    //Inidicate smtp standard port
    $email->Port = 465;
    //Origin mail email
    $email->setFrom('j1992prueba1992@gmail.com');
    //Destiny email send
    $email->addAddress('javierrg1992@gmail.com');//Debes escribir aqui un email para recibir los correos de los usuarios
    //Content type
    $email->isHTML(true);
    //set email subject
    $email->Subject = $postValues['subject'];
    //set email content
    $email->Body = $postValues['content'];
    //Calling fucntion to send email
    $email->send();
    //Redirection to the last page
    header('Location:'.$_SERVER['PHP_SELF'].'?controller=Usuario&action=confirmationEmail');
    
}
