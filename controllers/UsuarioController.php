<?php

require './views/UsuarioView.php';
require './models/UsuarioModel.php';

class UsuarioController {

    function __construct() {
        $this->usuarioView = new UsuarioView();
        $this->usuarioModel = new UsuarioModel();
    }

    /**
     * Function to create UsuarioView object and call it specifuc funtion  showForm() to show a login form
     */
    function getForm() {
        $this->usuarioView->showForm();
    }

    /**
     * Function to create a view and callign method showEmailForm()
     */
    function emailForm() {
        require_once './lib/files/sessionManagement.php';
        require_once './lib/files/cookiesManagement.php';
        $this->usuarioView->showEmailForm();
    }

    function sendEmail() {
        require_once './lib/files/send.php';
    }

    function confirmationEmail() {
        $this->usuarioView->showConfirmationEmail();
    }

    /**
     * Funtion to porcess credential from a user are correct by calling other function and create session and cookies by calling other functions
     * and finally redirect user to the next step (private area)
     */
//    function logIn() {
//        //Conditional to check if variables form post exist
//        if (isset($_POST['username']) && isset($_POST['password'])) {
//            $postValues = $this->processPost($_POST);
//            //Calling function to check if user exist in database
//            $exits = $this->usuarioModel->isExists($postValues['username']);
//            if (!isset($exists['error'])) {
//                //Create new user object by calling function to get a user if password and username match
//                $user = $this->usuarioModel->getUser($postValues['username'], $postValues['password']);
//                //Conditional to check is user has values
//                if (!isset($user['error'])) {
//                    if ($user) {
//                        //Callign function to hcnadel successful login for user
//                        $this->handleSuccessfulLogin($user);
//                    } else {
//                        $this->handleWrongLogin();
//                        //Mostrar un mensaje de error cuando la contraseña no coincida con la del user facilitado
//                    }
//                }
//            } else {
//                $this->handleWrongLogin();
//                //mostar mensaje de error cuando el usuario no se encuentre en la base de datos
//            }
//        }
//    }

    function getUser($postValues) {
        $user = $this->usuarioModel->getUser($postValues['username'], $postValues['password']);
        if (!is_array($user)) {
            return $user;
        } else {
            $this->ususarioView->showError($user);
            return false;
        }
    }

    function userExists($postValues) {
        $exists = $this->usuarioModel->isExists($postValues['username']);
        if (!isset($exists['error'])) {
            if ($exists) {
                return true;
            } else {
                return false;
            }
        } else {
            $this->usuarioView->showError($exists);
//            return false;
        }
    }

    function filterPostValues($post) {
        if (isset($post['username']) && isset($post['password'])) {
            $post = filter_input_array(INPUT_POST, $post);
            return $post;
        } else {
            heeader('Location:' . $_SERVER['PHP_SELF']);
        }
    }

    function logIn() {
        $postValues = $this->filterPostValues($_POST);
        $exists = $this->userExists($postValues);
        if ($exists) {
            $user = $this->getUser($postValues);
            if ($user) {
                $this->handleSuccessfulLogin($user);
            } else {
                $this->handleWrongLogin();
            }
        } else {
            if ($exists != null) {
                $this->handleWrongLogin();
            }
        }
    }

    function logOut() {
        session_start();
        setcookie(session_id(), '', time() - 100, '/');
        session_destroy();
        header('Location:' . $_SERVER['PHP_SELF']);
    }

//Funtions about cookies and sessions management***********************************************************************************************************
//*********************************************************************************************************************************************************

    /**
     * Function to create a session variable and set serialize Usuario object as value
     * 
     * @param type $user Uusario object
     */
    function createSessionUser($user) {
        session_start();
        $_SESSION['user'] = serialize($user);
        $this->createSessionCookie($user);
    }

    /**
     * Function to create session expiration cookie for a specific user
     * 
     * @param Usuario $user especific Usuario object on session
     */
    public function createSessionCookie($user) {
        setcookie(hash('sha256', $user->getId()), 'sessionCookie', time() + 600, '/');
    }

//Funtions about handle wrong and succes login***************************************************************************************************
//***********************************************************************************************************************************************

    /**
     * Function to call createSessionUser and redirect to index
     * 
     * @param type $user Usuario object
     */
    function handleSuccessfulLogin($user) {

        $this->createSessionUser($user);
        header('Location:' . $_SERVER['PHP_SELF'] . '?controller=Hotel&action=listHotels');
    }

    function handleWrongLogin() {
        header('Location:' . $_SERVER['PHP_SELF'] . '?controller=Usuario&action=getForm&error');
    }
}
