<?php
session_start();

$GLOBALS['baseDir'] = substr((__dir__), 0, -3);

$GLOBALS['enviro'] = 'local';


$domain = 'http://boiler.com/'; // rewite also .htaccess in web directory
$domainPublic = 'www.boiler.com';

$GLOBALS['config'] = [
    'cookie' => [
        'cookie_name' => 'nK2rsvjHH0',
        'cookie_expiry' => 604800,
        ],
    'session' => [
        'session_name' => '0TeuRcC2qM',
        ],
    'domain' => $domain, // full path to domain including '/' at the end. 
    'domainPublic' => $domainPublic,
    ];

$GLOBALS['mails'] = [
    'smtp' => 'smtp.boiler.com',
    'port' => 465,
    'secure_type' => 'ssl',
    'accounts' => [
        'no-reply' => [
            'login' => 'login',
            'password' => 'password'
            ],
        ],
    ];

require_once 'core/App.php';
require_once 'core/Controller.php';
require_once 'functions/general.php';
require_once 'libs/PHPMailer/PHPMailerAutoload.php';


spl_autoload_register(function($class)
{
    require_once 'helpers/' . $class . '.php';
});

ob_start();
