<?php

require './views/UsuarioView.php';
require './models/UsuarioModel.php';

/**
 * Class to represente usuario controller object to manage control app
 */
class UsuarioController {

    /**
     * Function to contruct object
     */
    function __construct() {
        $this->usuarioView = new UsuarioView();
        $this->usuarioModel = new UsuarioModel();
    }

    /**
     * Function to create UsuarioView object and call it specifuc funtion  showForm() to show a login form
     */
    function getForm() {
        global $user;
        if($user == null){
            $this->usuarioView->showForm();
        }else{
            $this->usuarioView->showVisor();
        }
        
    }

    /**
     * Function to create a view and callign method showEmailForm()
     */
    function emailForm() {
        require_once './lib/files/sessionManagement.php';
        require_once './lib/files/cookiesManagement.php';
        $this->usuarioView->showEmailForm();
    }

    /**
     * Function to take control about sending emails
     */
    function sendEmail() {
        require_once './lib/files/send.php';
    }

    /**
     * Functoin to take control to show confirmation email form
     */
    function confirmationEmail() {
        $this->usuarioView->showConfirmationEmail();
    }

    /**
     * Fucntion take control about fecth a specific Usuario
     * 
     * @param $_POST $postValues
     * @return bool or Usuario
     */
    function getUser($postValues) {
        $user = $this->usuarioModel->getUser($postValues['username'], $postValues['password']);
        if (!is_array($user)) {
            return $user;
        } else {
            $this->ususarioView->showError($user);
            return false;
        }
    }

    /**
     * Function to take control about if user exists in database
     * 
     * @param $_POST $postValues
     * @return bool
     */
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
        }
    }

    /**
     * Fucntion to filter values from $_POST 
     * 
     * @param $_POST $post
     * @return Array
     */
    function filterPostValues($post) {
        if (isset($post['username']) && isset($post['password'])) {
            $post = filter_input_array(INPUT_POST, $post);
            return $post;
        } else {
            heeader('Location:' . $_SERVER['PHP_SELF']);
        }
    }

    /**
     * Function to take control about login for a usuario obejct by calling other function 
     */
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

    /**
     * Function to destroy session  and cookie session created and redirect user to index
     */
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

    /**
     * Fucntion to handle and redirect user to index if an error has occured in login
     */
    function handleWrongLogin() {
        header('Location:' . $_SERVER['PHP_SELF'] . '?controller=Usuario&action=getForm&error');
    }
}
