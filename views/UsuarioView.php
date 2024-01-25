<?php

/**
 * Class to representa usuarioView obsject to show information
 */
class UsuarioView {

    function showForm() {
        ?>
        <!--container for login form-->
        <div class = "center_column container__form container__form--login" id = "login">
            <!--form title-->
            <div class = "form__title_container">
                <h2 class = "form__title">Type your account
                </h2>
                <i class = "fa-solid fa-circle-xmark icon"></i>
            </div>
            <!--contianer for accounts google and facebook-->
            <div class = "center_column form__others_account">
                <div class = "form__others_container">
                    <a class = "form__icon" href = "" target = "_blank">
                        <i class = "fa-brands fa-google form__icon--red"></i>
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        Log in with Google
                    </a>
                </div>
                <div class = "form__others_container">
                    <a class = "form__icon" href = "" target = "_blank">
                        <i class = "fa-brands fa-facebook-f form__icon--blue"></i>
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        Log in with Facebook
                    </a>
                </div>
            </div>
            <!--form to enter your data-->
            <form action = "<?= $_SERVER['PHP_SELF'] . '?controller=Usuario&action=logIn' ?>" method = "post" class = "center_column form form--login">
                <?php
                if (isset($_GET['error'])) {
                    echo "<p class=error>El usuario y/o la contraseñ no son válidos";
                }
                ?>
                <input type = "text" name = "username" required class = "form__input--index" placeholder = "Type your username">
                <input type = "password" name = "password" required class = "form__input--index" placeholder = "Type your password">
                <div class = "center_row checkbox">
                    <input type = "checkbox" id="terms" name = "terms" class = "form__input--index form__input--checkbox">
                    <label class = "form__label" for = "terms">Remember me</label>
                </div>
                <button class = "form__input--index form__button--index" type = "submit">Log in</button>
            </form>
            <!--footer div for change form and password link support-->
            <div class = "form__change">
                <a class = "form__text--link">forget your password?</a>
                <a class = "form__text" href = "./index.php?register" id = "signup__button">Sign up</a>
            </div>
        </div>
        <?php
        
    }

    /**
     * Funtion show a HTML form to send email for admin
     */
    function showEmailForm() {
        ?>
        <h2 class="cards__title">Enviamos un email contándonos lo que te ocurre</h2>
        <form class="form" action="<?= $_SERVER['PHP_SELF'] . '?controller=Usuario&action=sendEmail' ?>" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Type your username">
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" name="subject" class="form-control" id="subject" placeholder="Indicate a subject">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea name="content" class="form-control" id="content" placeholder="Hi, my name is..."></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <?php
    }

    /**
     * Function to show confirmation email about the email send properly out
     */
    function showConfirmationEmail() {
        ?> 
        <p>El correo se ha enviado con exito</p>
        <a href="<?= $_SERVER['PHP_SELF'] . '?controller=Hotel&action=listHotels' ?>">Back To Hotels</a>
        <?php
    }

    /**
     * Fucntion to catch type of error given as prameter and return a properly message error
     * 
     * @param number $code error code
     * @return string error message to show to user
     */
    function getErrorMessage($code) {
        switch ($code) {

            case 1049 : //error databse attributes are wrong
                return "Lo sentimos, hubo un problema al acceder a la base de datos. Por favor, inténtalo de nuevo más tarde.";
            case 42000://sintaxis sql error
                return "Lo sentimos, ocurrió un error al procesar tu solicitud. Por favor, contacta al soporte técnico para obtener ayuda.";
            case 23000://violation key
                return "Error al recuperar la información de las reservas. Por favor, intenta nuevamente más tarde.";
            case 2002 ://error connection databse
                return "Lo sentimos, hubo un problema al acceder a la base de datos. Por favor, inténtalo de nuevo más tarde.";
        }
    }

    /**
     * Function to print a card out screen to shoe information abour any problem occured
     * 
     * @param array $data contains error = true and code error number
     */
    function showError($data) {
        ?>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Disculpe las molestias.</h5>
            </div>
            <div class="card-body">
                <p class="card-text"><?= getErrorMessage($data['code']) ?>.</p>
                <a href="<?= $_SERVER['PHP_SELF'] . '?controller=Usuario&action=logOut' ?>" class="btn btn-primary">Go Back</a>
            </div>
        </div>
        <?php
    }
}
