<?php declare(strict_types=1);
/**
 * @author rimom.costa <rimomcosta@gmail.com>
 * Date: 2019-01-24
 * @version 1.0
 */

namespace Engine;

class Validations
{
    /**
     * @param string $input
     * @return string
     */
    public static function sanitize(string $input): string
    {
        $input = trim($input);
        $input = stripcslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }
}