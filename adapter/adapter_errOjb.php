<?php

/**
 * php 设计模式一书上的设计方法
 * Class errorObject
 */
class errorObject{
    private $_error;
    public function __construct($error)
    {
        $this->_error = $error;
    }

    public function getError(){
        return $this->_error;
    }
}

class logToClose{
    private $_errorObject;

    public function __construct($errorObject)
    {
        $this->_errorObject = $errorObject;
    }

    public function write(){
        fwrite(STDERR,$this->_errorObject->getError());
    }
}

$error = new errorObject("404:Not found");
$log = new logToClose($error);
$log->write();

class logToCSV{
    const CSV_LOCATION = 'log.csv';

    private $__errorObject;

    public function __construct($errorObject)
    {
        $this->__errorObject = $errorObject;
    }

    public function write(){
        $line = $this->__errorObject->getErrornumber();
        $line .= ',';
        $line .= $this->__errorObject->getErrorText();
        $line .= ',';
        file_put_contents(self::CSV_LOCATION,$line,FILE_APPEND);
    }
}

class LogToCSVAdapter extends errorObject{
    private $__errorNumber,$__errorText;

    public function __construct($error)
    {
        parent::__construct($error);
        $parts = explode(':',$this->getError());

        $this->__errorNumber = $parts[0];
        $this->__errorText   = $parts[1];
    }

    public function getErrorNumber(){
        return $this->__errorNumber;
    }

    public function getErrorText(){
        return $this->__errorText;
    }
}

$error = new LogToCSVAdapter("404:Not found");
$log = new logToCSV($error);
$log->write();




















