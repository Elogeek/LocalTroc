<?php

class Dumper {

    /**
     * Duper for tests purpose.
     * @param $var
     */
    public static function dieAndDump($var, $die = false) {
        echo "<pre>";
        print_r($var);
        echo "</pre>";
        if($die) {
            die();
        }
    }
}