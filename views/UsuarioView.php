<?php

class UsuarioView {

    function showUsers($allUsers) {
        foreach ($allUsers as $user) {
            echo "$user<br>";
        }
    }

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
            <form action = "<?= $_SERVER['PHP_SELF'].'?controller=Usuario&action=checkCredentials' ?>" method = "post" class = "center_column form form--login">
                <input type = "text" name = "username" required class = "form__input--index" placeholder = "Type your username">
                <input type = "password" name = "password" required class = "form__input--index" placeholder = "Type your password">
                <div class = "center_row checkbox">
                    <input type = "checkbox" name = "terms" class = "form__input--index form__input--checkbox">
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

        </div>
        <?php
    }
}