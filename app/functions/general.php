<?php

// sanitácia dát na výstupe aby vracalo html tagy ako text
function echoEsc($string)  
{
    echo htmlentities(trim($string), ENT_QUOTES, 'UTF-8');
}

function returnEsc($string)
{
    return htmlentities(trim($string), ENT_QUOTES, 'UTF-8');
}