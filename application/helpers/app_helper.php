<?php

function env($key = null)
{
    $separator = DIRECTORY_SEPARATOR;

    $file = __DIR__ . "$separator..$separator..$separator.env";
    
    $arr_env = file($file);

    $env = [];
    
    foreach($arr_env as $str){
    
        if ($str != '' && mb_strpos($str, '=') !== false){
            list($env_key, $env_val) = explode('=', $str);
            $env[trim($env_key)] = trim($env_val);
        }
    }
    if($key == null){
        
        return $env;
    }else{

        return $env[$key];
    }

}

function dd()
{
    
    $args = func_get_args();

    echo "
        <!DOCTYPE html>
        <html>
            <head>
                <title>Debug</title>
            </head>
            <body style='background-color: #3a3a3a; color: #bdbdbd'>";

            foreach($args as $arg){
                echo "  <pre>";
                print_r($arg);
                echo "  </pre>";
            }


    echo    "</body>
        </html>
    ";
}