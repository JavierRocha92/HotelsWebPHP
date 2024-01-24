
<?php
//Adding needing libraries
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Using requires to lad needing files
require './lib/files/phpmailer/src/Exception.php';
require './lib/files/phpmailer/src/PHPMailer.php';
require './lib/files/phpmailer/src/SMTP.php';
require './config/config.php';

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
    $email->Host =  $phpmailler_parameters['host'];
    //Tell something
    $email->SMTPAuth = true;
    //Origin mail email
    $email->Username = $phpmailler_parameters['username'];
    //Password applicacion
    $email->Password = $phpmailler_parameters['password'];
    //Get secure protocol
    $email->SMTPSecure = $phpmailler_parameters['smtpsecure'];
    //Inidicate smtp standard port
    $email->Port = $phpmailler_parameters['port'];
    //Origin mail email
    $email->setFrom($phpmailler_parameters['setfrom']);
    //Destiny email send
    $email->addAddress($phpmailler_parameters['addaddress']);//Debes escribir aqui un email para recibir los correos de los usuarios
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
