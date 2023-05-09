<?php

namespace Hacknet\Core;

class Config{
    private $data;

    public function __construct($filePath){
        if (!file_exists($filePath)) {
            throw new \Exception("Configuration file not found: $filePath");
        }

        $json = file_get_contents($filePath);
        $this->data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Failed to parse configuration file. Invalid JSON.');
        }
    }

    public function get($key, $default = null){
        $keys = explode('.', $key);

        $data = $this->data;
        foreach ($keys as $key) {
            if (!isset($data[$key])) {
                return $default;
            }

            $data = $data[$key];
        }

        return $data;
    }
}