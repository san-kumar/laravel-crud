<?php

namespace San\Crud\Utils;


use Illuminate\Support\Facades\Route;

class RouteUtils {
    public static function makeRoute(?string $name, string|array|null $vars, ?string $prefix) {
        //check route exists
        if (Route::has($name)) {
            $args = is_scalar($vars) ? $vars : sprintf("compact(%s)", join(', ', array_map(fn($var) => sprintf("'%s'", $var), (array) $vars)) ?: '[]');
            return sprintf("route('%s', %s)", $name, $args);
        } else { //fallback code to handle undefined routes to prevent errors
            $parts = explode('.', $name);
            $values = array_values((array) $vars);

            $path = [sprintf("'%s'", rtrim("/" . trim($prefix ?: '', '/'), '/'))];

            for ($i = 0; $i < count($parts); $i++) {
                if ($parts[$i] === 'index') continue;

                if ($parts[$i] !== 'show') {
                    $path[] = sprintf("'%s'", $parts[$i]);
                }

                if (!empty($values[$i])) {
                    $path[] = is_scalar($vars) ? $values[$i] : sprintf("$%s?->id ?: 0", $values[$i]);
                }
            }

            return sprintf("implode('/', [%s])", join(',', $path));
        }
    }
}