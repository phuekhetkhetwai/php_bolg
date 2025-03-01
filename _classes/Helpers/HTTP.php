<?php

namespace Helpers;

class HTTP {
    
    static $base = "http://localhost/blog/";

    static function redirect($page, $q = "") {
        $url = static::$base . $page;

        if($q) $url .= "?$q";

        header("location: $url");
        exit();
    }
}
