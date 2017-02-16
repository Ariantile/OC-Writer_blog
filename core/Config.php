<?php

namespace Core;

class Config {
    
    private $setting = [];
    private static $_instance;
    
    public static function getInstance($file)
    {
        if (is_null(self::$_instance))
        {
            self::$_instance = new Config();
        }
        return self::$_instance;
    }
    
    public function __contruct($file)
    {
        $this->settings = require($file);
    }
    
    public function get($key)
    {
        if (!isset($this->setting[$key]))
        {
            return null;
        }
        return $this->settings[$key];
    }
}