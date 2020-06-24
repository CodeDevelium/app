<?php
/**
 * Get.php
 * @version     1.0
 * @author      Code Develium
 */

namespace App\Librerias;

/**
 * Class Get
 * Manipulación de las variables provenientes del $_GET
 * @package App\Librerias
 */
abstract class Get
{

    /**
     * Devuelve una variable del GET como un string.
     * No contiene caracteres especiales HTML
     * @param string $clave
     * @return string
     */
    public static function get_str($clave)
    {
        return htmlspecialchars(filter_input(INPUT_GET, $clave));
    }

    /**
     * Devuelve un valor del GET como un int
     * Si no es un integer, devuelve false.
     * Max int: 2147483647
     * @param $clave
     * @return bool|int
     */
    public static function get_int($clave)
    {
        $str = filter_input(INPUT_GET, $clave);
        /* Max  2147483647 */
        $int = intval($str);
        if (strval($str) !== strval($int)) {
            return false;
        }
        return $int;
    }

    /**
     * Transforma un valor del GET formato SI/NO-YES/NO-Y/S-S/N-1/0 a bool.
     * Devuelve -1 si no se puede convertir a true o false
     *
     * @param $clave
     *
     * @return bool|int
     */
    public static function get_bool($clave)
    {
        return Convert::to_bool(''.filter_input(INPUT_GET, $clave));
    }
}