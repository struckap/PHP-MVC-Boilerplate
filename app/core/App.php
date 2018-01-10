<?php 

/**
* Class called from /web/index.php
*/
class App
{
    protected $controller = 'home';
    protected $method = 'index'; 
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        if (file_exists('../app/controllers/' . $url[0] . '.php')) 
        {
            $this->controller = $url[0];
            unset($url[0]);

            require_once '../app/controllers/' . $this->controller . '.php';
            $this->controller = new $this->controller();

            if (isset($url[1])) 
            {
                if (method_exists($this->controller, $url[1])) {
                    $this->method = $url[1];
                    unset($url[1]);
                }
                else
                {
                    require_once '../app/controllers/err.php';
                    $this->controller = new Err();
                    $this->method = 'notFound';
                }
            }
        }
        else
        {
            require_once '../app/controllers/home.php';
            $this->controller = new Home();

            if (isset($url[0])) 
            {
                if (method_exists($this->controller, $url[0])) {
                    $this->method = $url[0];
                    unset($url[0]);
                }
                else
                {
                    require_once '../app/controllers/err.php';
                    $this->controller = new Err();
                    $this->method = 'notFound';
                }
            }
        }        

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    protected function parseUrl()
    {
        if (isset($_GET['url'])) 
        {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}