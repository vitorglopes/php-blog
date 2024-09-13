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
        // Divide a URI em segmentos e remove parâmetros de consulta
        $this->uri = explode('/', explode('?', trim($requestUri, '/'))[0]);

        // Verifica se o primeiro segmento é "api"
        if ($this->uri[0] == 'api') {
            return $this->handleApiRequest();
        }

        return $this->handleWebRequest();
    }

    private function handleApiRequest()
    {
        $class = ucfirst($this->uri[1]) . 'Controller';
        $toInstantiate = $this->namespaceApi . "\\" . $class;

        if (!class_exists($toInstantiate)) {
            require "src/views/404.php";
            exit;
        }

        $newClass = new $toInstantiate();

        $method = $this->uri[2] ?? 'index';

        if (method_exists($newClass, $method)) {
            $params = array_slice($this->uri, 3);
            return call_user_func_array([$newClass, $method], $params);
        }

        http_response_code(404);
        print json_encode(['data' => [], 'error' => true, 'msg' => '404'], JSON_UNESCAPED_UNICODE);
        exit;
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
