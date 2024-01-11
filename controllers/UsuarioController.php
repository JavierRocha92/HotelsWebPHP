<?php

require './views/UsuarioView.php';
require './models/UsuarioModel.php';


class UsuarioController {

    function __construct() {
        $this->usuarioView = new UsuarioView();
        $this->usuarioModel = new UsuarioModel();
    }
    
    function listUsuarios() {
        $allUsers = $this->usuarioModel->getUsuarios();
        $this->usuarioView->showUsers($allUsers);
    }
    /**
     * Function to create UsuarioView object and call it specifuc funtion  showForm() to show a login form
     */
    function getForm() {
        $this->usuarioView->showForm();
    }
    /**
     * Funtion to porcess credential from a user are correct by calling other function and create session and cookies by calling other functions
     * and finally redirect user to the next step (private area)
     */
    function checkCredentials() {
//Conditional to check if variables form post exist
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $postValues = $this->processPost($_POST);
//Calling function to check if user exist in database
            if ($this->usuarioModel->existsInDb('nombre', $postValues['username'], 'Usuarios')) {
                //Create new user object by calling function to get a user if password and username match
                $user = $this->usuarioModel->getUser($postValues['username'], $postValues['password']);
//Conditional to check is user has values
                if ($user) {
                    //Callign function to hcnadel successful login for user
                    $this->handleSuccessfulLogin($user);
                } else {
                    $this->handleWrongLogin();
//Mostrar un mensaje de error cuando la contraseña no coincida con la del user facilitado
                }
            } else {
                $this->handleWrongLogin();
//mostar mensaje de error cuando el usuario no se encuentre en la base de datos
            }
        }
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
    public function createSessionCookie($user){
        setcookie(hash('sha256',$user->getId()),'sessionCookie', time() + 3, '/');
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
    
    function handleWrongLogin(){
        header('Location:' . $_SERVER['PHP_SELF'] . '?controller=Usuario&action=showForm&error');
    }
    
    //funtions about porcessing data******************************************************************************************************************************
    //************************************************************************************************************************************************************

    /**
     * Function to filter all values from post array and call function hash to encrypt password from Usuario
     * 
     * @param Array $post array $_POST global variable
     * @return Array storage all values from $_POST already porcessed
     */
    function processPost($post) {
        //Filtering values
        $postValues = filter_input_array(INPUT_POST, $_POST);
        //Convert password by hash function
        $postValues['password'] = hash('sha256', $postValues['password']);
        return $postValues;
    }
}
