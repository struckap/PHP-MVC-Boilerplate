<?php
/** 
*  Main home controller
*/

class Err extends Controller
{
    public function index()
    {
        $this->view('templates/header');            

        $this->view('pages/home', ['simpleMessage' => 'Basic Error page']);

        $this->view('templates/footer');
    }

    public function mailNotSent()
    {        
        $this->view('pages/home', ['simpleMessage' => 'Mail not sent!']);
    }

    public function notFound()
    {        
        $this->view('pages/home', ['simpleMessage' => '404!']);
    }
}