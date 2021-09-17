<?php
/**
 * @author fawkescreatives created on 16/09/2021
 */

namespace ApiResponse\Formatter\Helpers;

class ArrayService
{
    public static function isArray($value)
    {
        return is_array($value) || $value instanceof \ArrayAccess;
    }

    public static function isMultiDimensional($array): bool
    {
        if(!self::isArray($array)) {
            return false;
        }

        if (isset($array[0])) {
            return self::isArray($array[0]);
        }

        return false;
    }

    /**
     * @param array|null $value
     * @param string|null $key
     * @param null $default
     * @return mixed|null
     */
    public static function get($value, string $key = null, $default = null)
    {
        if (!self::isArray($value)) {
            return $value ?: $default;
        }

        if (is_null($key)) {
            return $value ?: $default;
        }

        if (array_key_exists($key, $value)) {
            if (is_bool($value[$key])) {
                return $value[$key];
            }
            return $value[$key] ?: $default;
        }

        return $default;
    }
}
