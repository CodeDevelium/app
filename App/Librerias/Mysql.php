<?php
/**
 * Mysql.php
 *
 * @version     1.0
 * @author      Code Develium
 */

namespace App\Librerias;

/**
 * Funciones de manipulación de valores para MySql
 * Class Mysql
 *
 * @package App\Librerias
 */
abstract class Mysql
{
    /**
     * Indica si es un número de mysql tiny int unsigned (0,255)
     * Todos los tinyint numeros son unsigned
     *
     * @param int  $num
     * @param bool $obligatorio
     * @param bool $es_id
     *
     * @return bool
     */
    public static function is_tiny_int($num, $obligatorio = false, $es_id = false)
    {
        /* Si es ID, no puede ser cero */
        if ($es_id && ($num === 0 || $num == '0')) {
            return false;
        }
        if (Valid::is_empty($num)) {
            return ! $obligatorio;
        }

        return valid::is_between_num($num, 0, 255);
    }

    /**
     * Indica si es un número de mysql small int unsigned (0,65535)
     * Todos los snallint numeros son unsigned
     *
     * @param int  $num
     * @param bool $obligatorio
     * @param bool $es_id
     *
     * @return bool
     */
    public static function is_small_int($num, $obligatorio = false, $es_id = false)
    {
        /* Si es ID, no puede ser cero */
        if ($es_id && ($num === 0 || $num == '0')) {
            return false;
        }
        if (Valid::is_empty($num)) {
            return ! $obligatorio;
        }

        return valid::is_between_num($num, 0, 65535);
    }

    /**
     * Indica si es un número de mysql medium int unsigned (0,16777215)
     *
     * @param      $num
     * @param bool $obligatorio
     * @param bool $es_id
     *
     * @return bool
     */
    public static function is_medium_int($num, $obligatorio = false, $es_id = false)
    {
        /* Si es ID, no puede ser cero */
        if ($es_id && ($num === 0 || $num == '0')) {
            return false;
        }
        if (Valid::is_empty($num)) {
            return ! $obligatorio;
        }

        return Valid::is_between_num($num, 0, 16777215);
    }

    /**
     * Indica si es un número de mysql int unsigned (0,4294967295)
     *
     * @param      $num
     * @param bool $obligatorio
     * @param bool $es_id
     *
     * @return bool
     */
    public static function is_int($num, $obligatorio = false, $es_id = false)
    {
        /* Si es ID, no puede ser cero */
        if ($es_id && ($num === 0 || $num == '0')) {
            return false;
        }
        if (Valid::is_empty($num)) {
            return ! $obligatorio;
        }

        return Valid::is_between_num($num, 0, 4294967295);
    }


}