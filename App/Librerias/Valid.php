<?php
/**
 * Valid.php
 *
 * @version     1.0
 * @author      Code Develium
 */

namespace App\Librerias;

/**
 * Valiaciones de valroes
 * Class Valid
 *
 * @package App\Librerias
 */
abstract class Valid
{

    /**
     * Comprueva si un valor esta vacío.
     * Se consideran vacios: Espacios en blanco y fechas a cero (formato yyyy-mm-dd).
     * No vacio: valor 0, true o false.
     *
     * @param mixed $valor
     *
     * @return bool
     */
    public static function is_empty($valor): bool
    {
        if ($valor === false) {
            return false;
        }
        if (is_object($valor)) {
            return false;
        }
        if (is_array($valor) && count($valor) === 0) {
            return true;
        }
        if (is_array($valor) && count($valor) !== 0) {
            return false;
        }
        $tmp = strtolower(trim(''.$valor));
        if ($tmp === '0') {
            return false;
        }
        if ($tmp === '0000-00-00' || $tmp === '0000-00-00 00:00:00' || $tmp === 'null') {
            return true;
        }

        return ($tmp === "");
    }


    /**
     * Devuelve la dirección de correo pasado como parámetro si es válida, o false si no es válida
     *
     * @param string $sEmail
     *
     * @return bool
     * @version 1.0
     */
    public static function is_email(?string $sEmail): bool
    {
        /* Si NO es email devuelve false, si es correcto devuelve el mismo email */
        return ! (filter_var($sEmail, FILTER_VALIDATE_EMAIL) === false);
    }

    /**
     * Indica si una fecha yyyy-mm-dd es una fecha válida
     *
     * @param $fecha
     *
     * @return bool
     */
    public static function is_date($fecha): bool
    {
        // yyyy-mm-dd
        if (strlen($fecha) != 10) {
            return false;
        }
        if ($fecha[ 4 ] != '-' || $fecha[ 7 ] != '-') {
            return false;
        }
        list($anio, $mes, $dia) = explode('-', $fecha);
        $dt = date('Y-m-d', mktime(0, 0, 0, $mes, $dia, $anio));

        return ($fecha == $dt);
    }

    /**
     * Comprueba si una fecha i hora STD (dd/mm/yyyy hh:mm:ss) es correcta
     *
     * @param $datetime
     *
     * @return bool
     */

    public static function is_date_time($datetime): bool
    {
        // yyyy-mm-dd hh:mm:ss
        if (strlen($datetime) != 19) {
            return false;
        }
        if ($datetime[ 4 ] != '-' || $datetime[ 7 ] != '-' || $datetime[ 10 ] != ' ' || $datetime[ 13 ] != ':' || $datetime[ 16 ] != ':') {
            return false;
        }
        list($fecha, $hora) = explode(' ', $datetime);
        list($anio, $mes, $dia) = explode('-', $fecha);
        list($hora, $min, $sec) = explode(':', $hora);
        $dt = date('Y-m-d H:i:s', mktime($hora, $min, $sec, $mes, $dia, $anio));

        return ($datetime == $dt);
    }

    /**
     * Indica si existe una clave en un array
     *
     * @param $arr
     * @param $key
     *
     * @return bool
     */
    public static function exists_key($arr, $key)
    {
        $arrayTmp = Convert::to_array($arr);

        return array_key_exists($key, $arrayTmp);
    }

    /**
     * Indica si un valor esta comprendido entre otros dos
     *
     * @param int  $num
     * @param int  $min
     * @param int  $max
     * @param bool $entorno_cerrado
     *
     * @return bool
     */
    public static function is_between_num($num, $min, $max, $entorno_cerrado = true)
    {
        if ($entorno_cerrado) {
            return ($num >= $min && $num <= $max);
        } else {
            return ($num > $min && $num < $max);
        }
    }
}

/*
$e   = empty('');              // true
$e   = empty('    ');          // false
$e   = empty("");              // true
$e   = empty("    ");          // false
$e   = empty(null);            // true
$e   = empty(0);               // true
$e   = empty('0');             // true
$e   = empty("0");             // true
$e   = empty(true);            // false
$e   = empty(false);           // true
$e   = empty($ClassObject);    // false
$arr = array();
$e   = empty($arr);            // true
$arr = array('0');
$e   = empty($arr);            // false
$arr = array(0);
$e   = empty($arr);            // false

$e = Valid::is_empty('');             // true
$e = Valid::is_empty('    ');         // true
$e = Valid::is_empty("");             // true
$e = Valid::is_empty("    ");         // true
$e = Valid::is_empty(null);           // true
$e = Valid::is_empty(0);              // false
$e = Valid::is_empty('0');             // false
$e = Valid::is_empty("0");             // false
$e = Valid::is_empty(true);           // false
$e = Valid::is_empty(false);          // false

$arr = array();
$e   = Valid::is_empty($arr);          // true
$arr = array('0');
$e   = Valid::is_empty($arr);          // false
$arr = array(0);
$e   = Valid::is_empty(($arr);          // false
*/