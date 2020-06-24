<?php
/**
 * Datetime.php
 *
 * @version     1.0
 * @author      Code Develium
 */

namespace App\Librerias;


/**
 * Manipulación de fecha y hora
 * Class DateTime
 *
 * @package App\Controladores
 */
abstract class DateTime
{
    /**
     * Devuelve el dia actual y hora formato yyyy-mm-dd hh:mm:ss
     *
     * @return string
     */
    public static function get_today_gmt()
    {
        return gmdate('Y-m-d H:i:s');
    }

    /**
     * Sumar minutos a una fecga STD. Devuelve una fecha STD
     *
     * @param $date
     * @param $minutos
     *
     * @return false|string
     */
    public static function sumar_minutos($date, $minutos)
    {
        return date('Y-m-d H:i:s', strtotime($date.' + '.$minutos.' minute'));
    }

    /**
     * Indica que fecha/hora es manor
     * > 1 => dt1 > dt2
     * < 1 => dt1 < dt2
     * = 0 => dt1 = dt2
     *
     * @param $str_fecha_hora1
     * @param $str_fecha_hora2
     *
     * @return int
     */
    public static function get_diff($str_fecha_hora1, $str_fecha_hora2): int
    {
        list($d1, $h1) = explode(' ', $str_fecha_hora1);
        list($d2, $h2) = explode(' ', $str_fecha_hora2);

        list($nDia1, $nMes1, $nAny1) = explode('-', $d1);
        list($nDia2, $nMes2, $nAny2) = explode('-', $d2);

        list($nh1, $nm1, $na1) = explode(':', $h1);
        list($nh2, $nm2, $na2) = explode(':', $h2);

        return mktime($nh1, $nm1, $na1, $nMes1, $nDia1, $nAny1) - mktime($nh2, $nm2, $na2, $nMes2, $nDia2, $nAny2);
    }

    /**
     * Muestra la fecha y hora en función de un formato. Si no existe time_zone utiliza cookies['tzo'] si existe
     *
     * @param        $date_yyyymmd_hhmmss
     * @param string $formato
     * @param string $time_zone
     * @param bool   $mostrar_segundos
     *
     * @return string
     * @throws \Exception
     */
    public static function display($date_yyyymmd_hhmmss, $formato = 'dd/mm/yyyy', $mostrar_segundos = true, $time_zone = 'Europe/Madrid')
    {

        if (Valid::is_empty($date_yyyymmd_hhmmss)) {
            return '';
        }

        if (strlen($date_yyyymmd_hhmmss) == 16) {
            $date_yyyymmd_hhmmss .= ':00';
        }

        // TODO $time_zone

        list($dt, $tm) = explode(' ', $date_yyyymmd_hhmmss);

        $dt = Date::display($dt, $formato);

        if ($mostrar_segundos) {
            return "$dt $tm";
        } else {
            list($h, $m,) = explode(':', $tm);

            return "$dt $h:$m";
        }

    }

}
