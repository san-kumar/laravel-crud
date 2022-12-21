<?php

namespace San\Crud;

class Crud {
    public static function routes() {
        $routeDir = base_path("routes/crud");

        foreach (glob("$routeDir/*.php") as $file) {
            require $file;
        }
    }
}