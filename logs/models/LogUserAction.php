<?php
//
//class LogUserAction {
//
//    private $username;
//    private $path;
//
//    public function __construct($username) {
//        $this->username = $username;
//        $this->path = './logs/files/logUser.csv';
//        $this->initializeFile();
//    }
//
//    private function initializeFile() {
//
//        if (!file_exists($this->path)) {
//            //Calign function to create a file based on object path
//            touch($this->path);
//            //Conditional to check if file exists
//            if (file_exists($this->path)) {
//                //Callign function to write info into file
//                $this->writeFile('Username;Action;Date;Success', 'w');
//            }
//        }
//    }
//
//    public function getUsername() {
//        return $this->username;
//    }
//
//    public function getFile() {
//        return $this->file;
//    }
//
//    public function setUsername($username): void {
//        $this->username = $username;
//    }
//
//    public function setFile($file): void {
//        $this->file = $file;
//    }
//
//    function loadUserAction($action,  $success) {
//        //Create date
//        $date = date('Y-m-d h:i:s');
//        //Process content value
//        $content = "\n$this->username;$action;$date;$success";
//
//        $this->writeFile($content, 'a');
//    }
//
//    public function writeFile($content, $mode) {
//        //Consitional to check if file exists
//        if (file_exists($this->path)) {
//            //Constional to check if value return from rhis function is set
//            $resource = fopen($this->path, $mode);
//            if ($resource) {
//                //Calling function to write info into file
//                fwrite($resource, $content);
//                //Calling function to close pointer
//                fclose($resource);
//            }
//        }
//    }
//}



class LogUserAction {

    /**
     * @var string The username associated with the user action
     */
    private $username;

    /**
     * @var string The file path for logging user actions
     */
    private $path;

    /**
     * Constructor to initialize the object with a username and path
     *
     * @param string $username The username associated with the user action
     */
    public function __construct($username) {
        $this->username = $username;
        $this->path = './logs/files/logUser.csv';
        $this->initializeFile();
    }

    /**
     * Initialize the log file
     */
    private function initializeFile() {
        // Check if the file does not exist
        if (!file_exists($this->path)) {
            // Call the function to create a file based on the object path
            touch($this->path);
            // Check if the file exists after creation
            if (file_exists($this->path)) {
                // Call the function to write header info into the file
                $this->writeFile('Username;Action;Date;Success', 'w');
            }
        }
    }

    /**
     * Get the username associated with the user action
     *
     * @return string The username
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Get the file path for logging user actions
     *
     * @return string The file path
     */
    public function getFile() {
        return $this->file;
    }

    /**
     * Set the username associated with the user action
     *
     * @param string $username The username
     */
    public function setUsername($username): void {
        $this->username = $username;
    }

    /**
     * Set the file path for logging user actions
     *
     * @param string $file The file path
     */
    public function setFile($file): void {
        $this->file = $file;
    }

    /**
     * Log a user action with the specified action and success status
     *
     * @param string $action The action performed by the user
     * @param bool $success The success status of the action
     */
    function loadUserAction($action,  $success) {
        // Create date
        $date = date('Y-m-d h:i:s');
        // Process content value
        $content = "\n$this->username;$action;$date;$success";

        // Call the function to write the content into the file
        $this->writeFile($content, 'a');
    }

    /**
     * Write content into the log file with the specified mode
     *
     * @param string $content The content to be written into the file
     * @param string $mode The mode for file writing ('w' for write, 'a' for append)
     */
    public function writeFile($content, $mode) {
        // Conditional to check if the file exists
        if (file_exists($this->path)) {
            // Conditional to check if the value returned from this function is set
            $resource = fopen($this->path, $mode);
            if ($resource) {
                // Call the function to write the content into the file
                fwrite($resource, $content);
                // Call the function to close the file pointer
                fclose($resource);
            }
        }
    }
}
