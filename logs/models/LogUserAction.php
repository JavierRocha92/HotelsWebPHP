<?php

class LogUserAction {

    private $username;
    private $path;

    public function __construct($username) {
        $this->username = $username;
        $this->path = './logs/files/logUser.csv';
        $this->initializeFile();
    }

    private function initializeFile() {

        if (!file_exists($this->path)) {
            //Calign function to create a file based on object path
            touch($this->path);
            //Conditional to check if file exists
            if (file_exists($this->path)) {
                //Callign function to write info into file
                $this->writeFile('Username;Action;Date;Success', 'w');
            }
        }
    }

    public function getUsername() {
        return $this->username;
    }

    public function getFile() {
        return $this->file;
    }

    public function setUsername($username): void {
        $this->username = $username;
    }

    public function setFile($file): void {
        $this->file = $file;
    }

    function loadUserAction($action,  $success) {
        //Create date
        $date = date('Y-m-d h:i:s');
        //Process content value
        $content = "\n$this->username;$action;$date;$success";

        $this->writeFile($content, 'a');
    }

    public function writeFile($content, $mode) {
        //Consitional to check if file exists
        if (file_exists($this->path)) {
            //Constional to check if value return from rhis function is set
            $resource = fopen($this->path, $mode);
            if ($resource) {
                //Calling function to write info into file
                fwrite($resource, $content);
                //Calling function to close pointer
                fclose($resource);
            }
        }
    }
}
