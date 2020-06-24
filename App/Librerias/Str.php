<?php
/**
 * Str.php
 *
 * @version     1.0
 * @author      Code Develium
 */

namespace App\Librerias;


/**
 * Manipulación de strings
 * Class Str
 *
 * @package App\Librerias
 */
abstract class Str
{
    /**
     * Devuelve el texto delimitado entre otros dos textos
     *
     * @param $txt
     * @param $str_ini
     * @param $str_fin
     *
     * @return string
     */
    function get_between_str($txt, $str_ini, $str_fin)
    {
        $ret = '';
        if (stripos($txt, $str_ini) !== false) {
            $pi  = stripos($txt, $str_ini) + strlen($str_ini);
            $lon = stripos($txt, $str_fin) - $pi;
            $ret = substr($txt, $pi, $lon);
            if (false === $ret) {
                return '';
            }
        }

        return $ret;
    }

    /**
     * Reemplaza sólo la primera ocurrencia de un string por otro.
     * Es insensible a mayúsculas i minúsculas pero no a los acentos.
     * Si no existe la ocurrencia, devuelve el mismo string
     *
     * @param string $txt
     * @param string $origen
     * @param string $destino
     *
     * @return string
     */

    public static function replace_first($txt, $origen, $destino)
    {
        $origen = '/'.preg_quote(''.$origen, '/').'/i';

        return ''.preg_replace($origen, ''.$destino, ''.$txt, 1);
    }

    /**
     * Devuelve true si los dos strings son iguales
     *
     * @param $str1
     * @param $str2
     *
     * @return bool
     */
    public static function are_equals($str1, $str2)
    {
        return self::to_lower_case($str1) == self::to_lower_case($str2);
    }

    /**
     * Convierte a minúsculas un texto
     *
     * @param $txt
     *
     * @return string
     */
    public static function to_lower_case($txt)
    {
        if (function_exists('mb_strtolower')) {
            return mb_strtolower($txt); // Convierte carcateres especiales
        }

        return strtolower($txt);
    }

    /**
     * Convierte a mayúsculas un texto
     *
     * @param $txt
     *
     * @return string
     */
    public static function to_upper_case($txt)
    {
        if (function_exists('mb_strtoupper')) {
            return mb_strtoupper($txt); // Convierte carcateres especiales
        }

        return strtolower($txt);
    }

    /**
     * Reemplaza todas las ocurrencias.
     * Es insensible a mayúsculas y minúsculas pero no a loa acentos
     * Devuelve el numero de ocurrencias sustiruidas
     *
     * @param string   $texto
     * @param string   $origen
     * @param string   $destino
     * @param int|null $num_reemplazos
     *
     * @return string|string[]
     */
    function replace_all($texto, $origen, $destino, &$num_reemplazos = null)
    {
        return str_ireplace(''.$origen, ''.$destino, ''.$texto, $num_reemplazos);
    }

    /**
     * Genera un número aleatorio de N digitos
     *
     * @param int $numDigitos
     *
     * @return string
     */
    public static function generar_numero_aleatorio(int $numDigitos = 6): string
    {
        $random = '';
        for ($n = $numDigitos; $n > 0; $n--) {
            $generado = "".mt_rand();
            $posicion = mt_rand(1, strlen($generado) - 1);
            $random   .= $generado[ $posicion ];
        }

        return strval($random);
    }


}
