<?php

/**
 * Class to representa usuarioView obsject to show information
 */
class UsuarioView {

    /**
     * Function to show a login form on screen
     */
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
     * Function to show a visor images on screen
     */
    function showVisor() {
        ?>
        <h1 class="mb-2">You chose whenever, whatever and wherever</h1>
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./assets/images/visor_hotel_1.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <a class="text-decoration-none text-light" href="<?= $_SERVER['PHP_SELF'] . '?controller=Hotel&action=listHotels' ?>">
                            <h5>Hotels available all over the world</h5></a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="./assets/images/visor_room_1.webp" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <a class="text-decoration-none text-light" href="<?= $_SERVER['PHP_SELF'] . '?controller=Hotel&action=listHotels' ?>">
                            <h5>Pick rooms which providing what you need</h5></a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="./assets/images/visor_tranfer.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <a class="text-decoration-none text-light" href="<?= $_SERVER['PHP_SELF'] . '?controller=Usuario&action=emailForm' ?>">
                            <h5>Faster, cheaper and easier than others companies</h5></a>

                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
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
     * Function to print a card out screen to shoe information abour any problem occured
     * 
     * @param array $data contains error = true and code error number
     */
    function showError($data) {
        showDatabaseError($data);
    }
}
