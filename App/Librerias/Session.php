<?php
/**
 * Session.php
 *
 * @version     1.0
 * @author      Code Develium
 */

namespace App\Librerias;


/**
 * Manipulación de variables guardadas en la sesión
 * Class Session
 *
 * @package App\Librerias
 */
abstract class Session
{
    /**
     * Devuelve un valor guardado en la sesión como un string.
     * Si no esta definido devuelve null.
     * El valor es guardado en la sesion de forma serializada
     *
     * @param string $clave
     *
     * @return string
     */
    public static function get_str($clave)
    {
        if ( ! isset($_SESSION[ $clave ])) {
            return null;
        }

        return strval(unserialize($_SESSION[ $clave ]));
    }

    /**
     * Devuelve un valor guardado en la sesión como un integer.
     * Si no esta definido devuelve null
     * El valor es guardado en la sesion de forma serializada.
     * Si no es un valor numérico, lanza una alert.
     *
     * @param string $clave
     *
     * @return int
     */
    public static function get_int($clave)
    {
        if ( ! isset($_SESSION[ $clave ])) {
            return null;
        }
        $tmp_int = unserialize($_SESSION[ $clave ]);
        if ( ! is_numeric($tmp_int)) {
            alert("Valor SESSION no es un integer: $clave = $tmp_int");

            return $tmp_int;
        }

        return intval($tmp_int);
    }

    /**
     * Devuelve un valor guardado en la sesión como un bool.
     * Si no esta definido devuelve null.
     * El valor es guardado en la sesion de forma serializada.
     * Si no es un valor bool, lanza una alert.
     *
     * @param string $clave
     *
     * @return bool
     */
    public static function get_bool($clave)
    {
        if ( ! isset($_SESSION[ $clave ])) {
            return null;
        }
        $tmp_bool = unserialize($_SESSION[ $clave ]);
        if ( ! is_bool($tmp_bool)) {
            alert("Valor SESSION no es un bool: $clave = $tmp_bool");

            return $tmp_bool;
        }

        return boolval($tmp_bool);
    }

    /**
     * Devuelve un valor guardado en la sesión.
     * Si no esta definido devuelve null.
     * El valor es guardado en la sesion de forma serializada.
     *
     * @param string $clave
     *
     * @return mixed
     */
    public static function get_value($clave)
    {
        if ( ! isset($_SESSION[ $clave ])) {
            return null;
        }

        return unserialize($_SESSION[ $clave ]);
    }

    /**
     * Guarda un valor en la sesión.
     * El valor es guardado en la sesion de forma serializada.
     *
     * @param string $clave
     * @param object $valor
     */
    public static function set_value($clave, $valor = null)
    {
        $_SESSION[ $clave ] = serialize($valor);
    }

    /**
     * Elimina un valor guardado en la sessión
     *
     * @param string $clave
     */
    public static function delete($clave)
    {
        unset($_SESSION[ $clave ]);
    }

    /**
     * Inicia una sessión. Establece la fecha horaria
     *
     * @param null $session_id
     */
    public static function init($session_id = null): void
    {
        // Comprobar que no haya una sesión ya iniciada
        if (session_status() == PHP_SESSION_NONE) {
            if ( ! empty($session_id)) {
                session_id($session_id);
            }
            session_start();

            return;
        }
        if ( ! empty($session_id) && $session_id != session_id()) {
            session_destroy();
            session_id($session_id);
            session_start();
        }
    }

    /**
     *  Destruye la sesion
     */
    public static function destroy(): void
    {
        // Comprobar si la sesión está iniciada
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
            session_unset();
        }
    }
}
