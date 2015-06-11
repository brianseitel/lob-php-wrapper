<?php

class Config {

    public static function get($key, $default = "") {
        $settings = include(__DIR__.'/../config/app.php');

        return self::getKey($settings, $key, $default);
    }

    public static function getKey($settings, $key, $default = "") {
        $current = $settings;
        $item = strtok($key, '.');

        while ($item !== false) {
            if (!isset($current[$item])) {
                return $default;
            }
            $current = $current[$item];
            $item = strtok('.');
        }
        return $current;
    }

}