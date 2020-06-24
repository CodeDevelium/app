<?php
/**
 * Date.php
 *
 * @version     1.0
 * @author      Code Develium
 */

namespace App\Librerias;


/**
 * Manipulación de fechas
 * Class Date
 *
 * @package App\Librerias
 */
abstract class Date
{

    /***
     * Devuelve el dia actual formato yyyy-mm-dd
     *
     * @return string
     */
    public static function get_today_gmt()
    {
        return gmdate('Y-m-d');
    }

    /**
     * Partiendo de una fecha en un foramto determinado, devuelve el dia, mes y año
     *
     * @param $value
     * @param $formato
     * @param $dia
     * @param $mes
     * @param $anio
     */
    public static function get_explode($value, $formato, &$dia, &$mes, &$anio)
    {
        $dia = $mes = $anio = 0;
        switch ($formato) {

            case 'dd/mm/yyyy':
                list($dia, $mes, $anio) = explode('/', $value);
                break;

            case 'mm/dd/yyyy':
                list($mes, $dia, $anio) = explode('/', $value);
                break;

            case 'yyyy/mm/dd':
                list($anio, $mes, $dia) = explode('/', $value);
                break;

            case 'dd-mm-yyyy':
                list($dia, $mes, $anio) = explode('-', $value);
                break;

            case 'mm-dd-yyyy':
                list($mes, $dia, $anio) = explode('-', $value);
                break;

            case 'yyyy-mm-dd':
                list($anio, $mes, $dia) = explode('-', $value);
                break;

            case 'dd.mm.yyyy':
                list($dia, $mes, $anio) = explode('.', $value);
                break;

            case 'mm.dd.yyyy':
                list($mes, $dia, $anio) = explode('.', $value);
                break;

            case 'yyyy.mm.dd':
                list($anio, $mes, $dia) = explode('.', $value);
                break;

            default:
                break;
        }
    }

    /**
     * Devuevle el pattern para un formato de fecha determinado.
     *
     * @param $formato
     *
     * @return string
     */
    public static function get_pattern($formato = 'dd/mm/yyyy')
    {
        switch ($formato) {

            case 'dd/mm/yyyy':
            case 'mm/dd/yyyy':
                return "\\d{2}/\\d{2}/\\d{4}";

            case 'yyyy/mm/dd':
                return "\\d{4}/\\d{2}/\\d{2}";

            case 'dd-mm-yyyy':
            case 'mm-dd-yyyy':
                return "\\d{2}\\-\\d{2}\\-\\d{4}";

            case 'yyyy-mm-dd':
                return "\\d{4}\\-\\d{2}\\-\\d{2}";

            case 'dd.mm.yyyy':
            case 'mm.dd.yyyy':
                return "\\d{2}\\.\\d{2}\\.\\d{4}";

            case 'yyyy.mm.dd':
                return "\\d{4}\\.\\d{2}\\.\\d{2}";

            default:
                return "";
                break;
        }
    }

    /**
     * Muestra la fecha en función de un formato
     *
     * @param        $date_yyyymmdd
     * @param string $formato
     *
     * @return string
     */
    public static function display($date_yyyymmdd, $formato = 'dd/mm/yyyy')
    {
        if (Valid::is_empty($date_yyyymmdd)) {
            return '';
        }
        list($y, $m, $d) = explode('-', $date_yyyymmdd);

        switch ($formato) {
            case 'dd/mm/yyyy':
                return "$d/$m/$y";

            case 'mm/dd/yyyy':
                return "$m/$d/$y";

            case 'yyyy/mm/dd':
                return "$y/$m/$d";

            case 'dd-mm-yyyy':
                return "$d-$m-$y";

            case 'mm-dd-yyyy':
                return "$m-$d-$y";

            case 'yyyy-mm-dd':
                return "$y-$m-$d";

            case 'dd.mm.yyyy':
                return "$d.$m.$y";

            case 'mm.dd.yyyy':
                return "$m.$d.$y";

            case 'yyyy.mm.dd':
                return "$y.$m.$d";

            default:
                return $date_yyyymmdd;
        }
    }


    /**
     * Devuevle un array con todos los tipos de formatos de fecha habalibles en la aplicación
     *
     * @return array
     */
    public static function get_formatos()
    {
        return [
            'dd/mm/yyyy',
            'mm/dd/yyyy',
            'yyyy/mm/dd',

            'dd-mm-yyyy',
            'mm-dd-yyyy',
            'yyyy-mm-dd',

            'dd.mm.yyyy',
            'mm.dd.yyyy',
            'yyyy.mm.dd'
        ];
    }
}
