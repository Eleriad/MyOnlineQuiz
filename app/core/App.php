<?php

class App
{
    public $controller = "HomeController";
    public $method = "index";
    public $params = [];

    /**
     * Function that parses the url into an array and then looks to each element to compare it with a Controller class and a method within it.
     */
    public function __construct()
    {
        $url = $this->parseURL();

        if (isset($url[0]) && file_exists('app/controllers/' . $url[0] . 'Controller.php')) {
            $this->controller = $url[0] . 'Controller';
            unset($url[0]);
        }
        require_once 'app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller();

        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * Function that parses the URL to verify if any parameter exists in it.
     * @return array
     */
    public function parseURL()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}
