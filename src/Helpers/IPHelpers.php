<?php

namespace Hacknet\Helpers;

class IPHelpers{

    public static function generateRandomIPV4() {
        return rand(1, 254) . '.' . rand(0, 254) . '.' . rand(0, 254) . '.' . rand(1, 254);
    }    

}