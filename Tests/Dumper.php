<?php

class Dumper {

    /**
     * Duper for tests purpose.
     * @param $var
     */
    public static function dieAndDump($var) {
        echo "<pre>";
        print_r($var);
        echo "</pre>";
    }
}