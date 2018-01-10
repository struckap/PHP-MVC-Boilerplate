<?php
/** 
*  Main home controller
*/
class Home extends Controller
{
    public function index()
    {
        $headerData = [
            'title' => 'Home Page Title',
        ];

        $this->view('templates/header', $headerData);    

        $pageData = [

        ];        

        $this->view('pages/home', $pageData);

        $footerData = [
            
        ];

        $this->view('templates/footer', $footerData);

    }
}