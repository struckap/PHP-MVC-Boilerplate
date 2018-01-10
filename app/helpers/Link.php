<?php 

class Link
{
    public static function path($link = '', $cache = 1)
    {    
        if ($cache == 1 ) 
        {
            $domain = Config::get('domain');
            return $domain . $link;
        }
        else
        {
            $domain = Config::get('domain');
            return $domain . $link . Hash::noCache();
        }
    }

    public static function toWeb($web)
    {
        return 'http://' . str_replace('www.', '', $web);
    }

    public static function params($params = [])
    {
        $string = '';

        if (!empty($params)) 
        {
            $string = '?';
            $i = 1;

            foreach ($params as $key => $val) 
            {
                $string .= urlencode($key) . '=' . urldecode($val);

                if ($i != count($params))
                {
                    $string = $string . '&';
                }

                $i++;
            }
        }

        return $string;
    }
}
