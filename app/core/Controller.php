<?php

/**
* 
*/
class Controller
{
    protected $landing = false;

    public function __construct()
    {
        if (Input::exists('get') && Input::get('r') != '') 
        {
            Cookie::putRefferal(Input::get('r'));
        }
    }

    protected function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }

    protected function header($data = [])
    {
        require $this->view('templates/header');
    }

    protected function footer($data = [])
    {
        require $this->view('templates/footer');
    }

    protected function repeatedView($view, $data = [])
    {
        require '../app/views/' . $view . '.php';
    }

    protected function multiViews($views = [])
    {
        foreach ($views as $view) 
        {
            if (isset($view['data']) && !empty($view['data'])) 
            {
                $this->view($view['view'], $view['data']);
            }
            else
            {
                $this->view($view['view']);
            }
        }
    }

    protected function controllerName()
    {
        return get_class($this);
    }
}