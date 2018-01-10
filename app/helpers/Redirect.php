<?php

class Redirect
{
    public static function to($location = null, $second = '')
    {   
        if ($location == 'err/1001') 
        {
            $domain = Config::get('domain');
            header('Location: '. $domain . $location . '/?e=' . $second);
            exit();
        }
        else
        {
            $domain = Config::get('domain');
            header('Location: '. $domain . $location);
            exit();
        }
    }

    public static function toUrl($url)
    {
        header('Location: ' . $url);
        exit();
    }
}