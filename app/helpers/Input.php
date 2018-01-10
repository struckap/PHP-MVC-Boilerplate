<?php

class Input 
{
    public static function exists($type = 'post')
    {
        switch ($type) {
            case 'post':
                    return (!empty($_POST)) ? true : false;
                break;
            
            case 'get';
                    return (!empty($_GET)) ? true : false;
                break;

            default:
                return false;
            break;
        }
    }

    public static function get($item)
    {
        if (isset($_POST[$item])) 
        {
            return $_POST[$item];
        }
        else if (isset($_GET[$item])) 
        {
            return $_GET[$item];
        }
        else 
        {
            return '';
        }
    }

    public static function echo($item)
    {
        if (isset($_POST[$item])) 
        {
            echoEsc($_POST[$item]);
        }
        else if (isset($_GET[$item])) 
        {
            echoEsc($_GET[$item]);
        }
        else 
        {
            return '';
        }
    }

    public static function keepSelected($selectName, $optionValue, $default = false)
    {
        if ($default == true) 
        {
            if (!self::exists()) 
            {
                echo 'selected';
            }
            else
            {
                if (self::get($selectName) == $optionValue) 
                {
                    echo 'selected';
                }                
            }
        }

        if (self::exists()) 
        {
            if (self::get($selectName) == $optionValue) 
            {
                echo 'selected';
            }
        }
    }
}