<?php
/**
 * Post.php
 *
 * @version     1.0
 * @author      Code Develium
 */

namespace App\Librerias;


/**
 * Manipulación de variables del POST
 * Class Post
 *
 * @package App\Librerias
 */
abstract class Post
{
    /**
     * Devuelve una variable del POST como un array.
     *
     * @param string $clave
     *
     * @return array
     * @see validar_is_empty()
     */
    public static function get_array($clave)
    {
        $array_tmp = filter_input(INPUT_POST, $clave, FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        if (Valid::is_empty($array_tmp)) {

            /* Puede que sólo haya un valor, con lo que no es un array */
            $tmp = filter_input(INPUT_POST, $clave);

            if (Valid::is_empty($tmp)) {
                return [];
            }

            return [$tmp];
        }

        return $array_tmp;
    }

    /**
     * Devuelve un string de fecha del POST.
     * No se comprueba el formato de la fecha.
     *
     * @param string $clave
     *
     * @return string
     */
    public static function get_date($clave)
    {
        /* Devuelve un string normal. El formato de fecha ha de ser comprobado desde afuera */
        /* ya que puede estar vacío */
        return ''.filter_input(INPUT_POST, $clave);
    }

    /**
     * Devuelve un string del POST.
     * No se comprueba el formato de la fecha.
     *
     * @param string $clave
     *
     * @return string
     */
    public static function get_datetime($clave)
    {
        /* Devuelve un string normal. El formato de fecha y hora ha de ser comprobado desde afuera */
        /* ya que puede estar vacío */
        return ''.filter_input(INPUT_POST, $clave);
    }

    /**
     * Devuelve una variable del POST como un string
     * No contiene carcatres heml especiales.
     *
     * @param string $clave
     *
     * @return string
     */
    public static function get_str($clave)
    {
        return htmlspecialchars(filter_input(INPUT_POST, $clave));
    }

    /**
     * Devuelve un texto swl POST con tags de formato html.
     *
     * @param string $clave
     *
     * @return string|null
     */
    public static function get_html($clave)
    {
        /* NO contiene htmlspecialchars() */
        return ''.filter_input(INPUT_POST, $clave);
    }

    /**
     * Devuelve el valor de una variable del POST como un integer.
     * Si no es un integer, devuelve false.
     * Max int: 2147483647
     *
     * @param string $clave
     *
     * @return int|bool
     */
    public static function get_int($clave)
    {
        /* Max  2147483647 */
        $ret = filter_input(INPUT_POST, $clave);
        if (strval($ret) !== strval(intval($ret))) {
            return false;
        }

        return intval($ret);
    }


    /**
     * Transforma un valor del POST formato SI/NO-YES/NO-Y/S-S/N-1/0 a bool.
     * Devuelve -1 si no se puede convertir a true o false
     *
     * @param $clave
     *
     * @return bool
     */
    public static function get_bool($clave)
    {
        return Convert::to_bool(''.filter_input(INPUT_POST, $clave));
    }

    /**
     * Devuelve el valor de una variable del POST como un double.
     * Si no es un integer o double, devuelve false.
     *
     * @param string $clave
     *
     * @return double|bool
     */
    public static function get_double($clave)
    {
        $value = str_replace(',', '.', filter_input(INPUT_POST, $clave));
        $ret   = filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        if (false === $ret) {
            return false;
        }

        /* No usar doubleval */

        return (float)($value);
    }
}
