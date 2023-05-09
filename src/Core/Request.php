<?php

namespace Hacknet\Core;

class Request
{
    public function getUri()
    {
        if (php_sapi_name() === 'cli') {
            $options = getopt('', ['uri::']);

            if (isset($options['uri'])) {
                return $options['uri'];
            } else {
                echo "Missing --uri option.\n";
                exit(1);
            }
        } else {
            return $_SERVER['REQUEST_URI'];
        }
    }

    public function getHttpMethod()
    {
        return $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }
}