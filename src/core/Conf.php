<?php

namespace src\core;

use Exception;

class Conf
{
    private $documentRoot;
    private $pathToConfIni;

    public function __construct()
    {
        $this->setDocumentRoot();
        $this->readConfig();
        $this->bootstrap();
    }

    public function setDocumentRoot()
    {
        $this->documentRoot = filter_var($_SERVER['DOCUMENT_ROOT']);
        $this->pathToConfIni = $this->documentRoot . DIRECTORY_SEPARATOR . "conf.ini";

        if ($this->pathToConfIni == "\conf.ini" || empty($this->pathToConfIni)) {
            $this->documentRoot = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR;
            $this->pathToConfIni = $this->documentRoot . "conf.ini";
        }
        define('DOCUMENT_ROOT', $this->documentRoot);
    }

    public function readConfig()
    {
        if (!file_exists($this->pathToConfIni)) {
            throw new Exception("File not found: " . $this->pathToConfIni);
        }

        $config = parse_ini_file($this->pathToConfIni);

        if ($config === false) {
            throw new Exception("Error reading configuration file: " . $this->pathToConfIni);
        }
        define('CONF', $config);
        return $config;
    }

    public function bootstrap()
    {
        require_once "bootstrap.php";
    }
}
