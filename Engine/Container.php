<?php
/**
 * @author rimom.costa <rimomcosta@gmail.com>
 * Date: 2019-01-24
 * @version 1.0
 */

namespace Engine;

class Container
{
    private const KEY_NOT_ATTACHED = 'Key not attached in the container';

    protected static $container = [];

    /**
     * @param $key
     * @param $value
     */
    public static function attach($key, $value): void
    {
        static::$container[$key] = $value;
    }

    /**
     * @param $key
     * @return mixed
     * @throws \Exception
     */
    public static function get($key)
    {
        if (array_key_exists($key, static::$container)) {

            return static::$container[$key];
        }

        throw new \Exception(self::KEY_NOT_ATTACHED);
    }
}