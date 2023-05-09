<?php

namespace Hacknet\Base;
use Hacknet\Core\Config;
use PDODb\Database;

class BaseModel{

    private Config $config;
    public Database $database;

    public function __construct(){
        $this->config = new Config(__DIR__ . '/../../config.json');

        $host = $this->config->get('Databases.Mysql.Host');
        $user = $this->config->get('Databases.Mysql.User');
        $pass = $this->config->get('Databases.Mysql.Pass');
        $db = $this->config->get('Databases.Mysql.Database');

        $this->database = new Database($user, $pass, $host, $db);
    }
}