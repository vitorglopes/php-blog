<?php

namespace src\core;

class Router
{
    private array $uri;
    private string $namespaceController = 'src\\controller';
    private string $namespaceApi = 'src\\api';

    public function __construct(string $requestUri)
    {
        $this->initialize($requestUri);
    }

    public function initialize(string $requestUri)
    {
        $this->uri = explode('/', explode('?', trim($requestUri, '/'))[0]);
        return $this->handleWebRequest();
    }

    private function handleWebRequest()
    {
        $this->uri[0] = empty($this->uri[0]) ? "Home" : $this->uri[0];
        $class = ucfirst($this->uri[0]) . 'Controller';
        $toInstantiate = $this->namespaceController . "\\" . $class;

        if (!class_exists($toInstantiate)) {
            require "src/views/404.php";
            exit;
        }

        $newClass = new $toInstantiate();
        $method = $this->uri[1] ?? 'index';

        if (method_exists($newClass, $method)) {
            $params = array_slice($this->uri, 2);
            return call_user_func_array([$newClass, $method], $params);
        }

        require "src/views/404.php";
        exit;
    }
}
