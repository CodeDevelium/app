<?php
/**
 * Server.php
 *
 * @version     1.0
 * @author      Code Develium
 */

namespace App\Librerias;


/**
 * Manipulación de variables del Servidor
 * Class Server
 *
 * @package App\Librerias
 */
abstract class Server
{

    /**
     * Devuelve el valor de una variable del array superglobal $_SERVER
     * NOTA: filter_input para las opciones INPUT_SERVER y INPUT_ENV no funcionan para FASTCGI
     * Si la variable no existe, devuelve '' (string vacío)
     *
     * @param string $key
     *
     * @return string
     */
    public static function get_value($key)
    {
        if (filter_has_var(INPUT_SERVER, $key)) {

            $value = filter_input(INPUT_SERVER, $key, FILTER_SANITIZE_STRING);

        } else {

            $value = '';
            if (array_key_exists($key, $_SERVER)) {
                $value = filter_var($_SERVER[ $key ], FILTER_SANITIZE_STRING, null);
            }

            return $value;
        }
        if ($value === false || is_null($value)) {
            return '';

        }

        return $value;
    }


}