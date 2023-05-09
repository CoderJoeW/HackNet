<?php

namespace Hacknet\Auth\Model;

use Hacknet\Base\BaseModel;

class UserModel extends BaseModel{

    public static function isUniqueUsername($username) {
        return self::isUniqueField('username', $username);
    }
    
    public static function isUniqueEmail($email) {
        return self::isUniqueField('email', $email);
    }
    
    public static function isUniqueIp($ip) {
        return self::isUniqueField('ip_address', $ip);
    }

    private static function isUniqueField($field, $value) {
        $params = [$field => $value];
    
        $query = "SELECT COUNT(*) FROM users WHERE $field=:$field";
    
        $results = self::$database->select($query, $params);
    
        return (count($results) < 1);
    }    

}