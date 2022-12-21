<?php

namespace San\Crud\Utils;

class RouteUtils {
    public static function makeRoute($name, $vars) {
        //check route exists
        if (\Route::has($name)) {
            return sprintf("route('%s', %s)", $name, $vars);
        } else {
            return "'#'";
        }
    }
}