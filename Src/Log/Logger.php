<?php

namespace Logger;

class Logger {
   
    public function __construct(private $logFilePath){}

    public function log($msg){

        $logMessage = "[" . date('Y-m-d H:i:s') . "] " . 
        $msg . PHP_EOL;

        file_put_contents($this->logFilePath, $logMessage, FILE_APPEND);
    }
}