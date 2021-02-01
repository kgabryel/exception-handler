<?php

namespace Frankie\ExceptionHandler;

class ArgInfo
{

    public static function get($arg): string
    {
        $result = '';
        if (\is_string($arg)) {
            $result = '\'' . $arg . '\'';
        } elseif (is_numeric($arg)) {
            $result = $arg;
        } elseif (\is_bool($arg)) {
            if ($arg) {
                $result = 'TRUE';
            } else {
                $result = 'FALSE';
            }
        } elseif ($arg === null) {
            $result = 'NULL';
        } elseif (\is_array($arg)) {
            $result = 'Array';
        } elseif (\is_object($arg)) {
            $result = \get_class($arg);
        } elseif (\is_resource($arg)) {
            $result = get_resource_type($arg) . ' resource';
        }
        return $result;
    }
}
