<?php

namespace Lob;

class Config {

    /**
     * Fetch a specific config value from config files. If not found, return $default.
     *
     * @param $key String  The key to search
     * @param $default mixed The default value to return
     **/
    public static function get($key, $default = "") {
        $settings = include(__DIR__.'/../config/app.php');

        return self::getKey($settings, $key, $default);
    }

    /**
     * Accepts dot-notation to track down the value in a nested array.
     * 
     * @param $settings Array An array containing all of the settings, possibly nested
     * @param $key String The key to search, possibly dot-notation: e.g. lob.api_key
     * @param $default String The default value to return if no hits
     **/
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