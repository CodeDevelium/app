<?php
/**
 * Dispositivo.php
 *
 * @version     1.0
 * @author      Code Develium
 */

namespace App\Librerias;


/**
 * Características del dispositivo usado
 * Class Dispositivo
 *
 * @package App\Controladores
 */
abstract class Dispositivo
{
    /**
     * Devuelve el idioma configurado en al dispowitivo HTTP_ACCEPT_LANGUAGE
     *
     * @param $idioma_default
     *
     * @return string
     */
    public static function get_detectar_idioma($idioma_default)
    {
        $http_accept = Str::to_lower_case(Server::get_value('HTTP_ACCEPT_LANGUAGE'));
        if (Valid::is_empty($http_accept)) {
            return $idioma_default;
        }

        // dividir los posibles idiomas en un array
        $array_accept = explode(",", $http_accept);

        $idiomas = [];
        foreach ($array_accept as $val) {

            // comprovar el valor q y crear un array asociativo. Si no existe el valor q, es por defecto 1
            if (preg_match("/(.*);q=([0-1]{0,1}.\d{0,4})/i", $val, $matches)) {

                $idiomas[ $matches[ 1 ] ] = (float)$matches[ 2 ];
            } else {

                $idiomas[ $val ] = 1.0;
            }
        }

        // Eel idioma por defecto el cual es el valor q más alto
        $qval = 0.0;

        foreach ($idiomas as $key => $value) {

            if ($value > $qval) {
                $qval = (float)$value;

                $idioma_default = $key;
            }
        }

        return Str::to_lower_case($idioma_default);
    }

    /**
     * Devuelve la variable UserAgent del $_SERVER
     *
     * @return mixed
     */
    public static function get_user_agent()
    {
        return strtolower(filter_input(INPUT_SERVER, 'HTTP_USER_AGENT'));
    }

    /**
     * Devuelve el Dominio Http del servidor
     *
     * @return string
     */
    public static function get_dominio_http_actual()
    {
        $http_host = Server::get_value('HTTP_HOST');
        if (Valid::is_empty($http_host)) {
            return '';
        }
        $https = Server::get_value('HTTPS');
        if (Valid::is_empty($https)) {
            $protocol = 'http';
        } else {
            $protocol = ($https != "off") ? "https" : "http";
        }

        return $protocol."://".$http_host;
    }

    /**
     * Devuelve la ip del cliente
     *
     * @return string
     */
    public static function get_ip(): string
    {
        foreach (
            array(
                'HTTP_CLIENT_IP',
                'HTTP_X_FORWARDED_FOR',
                'HTTP_X_FORWARDED',
                'HTTP_X_CLUSTER_CLIENT_IP',
                'HTTP_FORWARDED_FOR',
                'HTTP_FORWARDED',
                'REMOTE_ADDR'
            ) as $key
        ) {

            $value = Server::get_value($key);

            if ( ! Valid::is_empty($value)) {
                foreach (explode(',', $value) as $ip) {
                    $ip = trim($ip);

                    if (filter_var($ip, FILTER_VALIDATE_IP,
                                   FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {

                        return $ip;
                    }
                }
            }

            return '';
        }
    }

    /**
     * Función que devuelve el nombre del navegador utilizado por el cliente
     *
     * @return string
     */
    public static function get_navegador(): string
    {

        $user_agent = self::get_user_agent();

        if (strpos($user_agent, 'opera') || strpos($user_agent, 'opr/')) {
            return 'Opera';

        } elseif (stripos($user_agent, 'edge') !== false) {
            return 'Edge';

        } elseif (stripos($user_agent, 'chrome') !== false) {
            return 'Chrome';

        } elseif (stripos($user_agent, 'safari') !== false) {
            return 'Safari';

        } elseif (stripos($user_agent, 'firefox') !== false) {
            return 'Firefox';

        } elseif (stripos($user_agent, 'msie') !== false || stripos($user_agent, 'trident/7') !== false) {
            return 'IE';

        } elseif (stripos($user_agent, 'ipod') !== false) {
            return 'iPod';

        } elseif (stripos($user_agent, 'iphone') !== false) {
            return 'iPhone';

        } elseif (stripos($user_agent, 'ipad') !== false) {
            return 'iPad';

        } elseif (stripos($user_agent, 'android') !== false) {
            return 'Android';

        } elseif (stripos($user_agent, 'webos') !== false) {
            return 'WebOS';

        } elseif (stripos($user_agent, 'blackberry') !== false) {
            return 'Blackberry';
        }

    }

    /**
     * Devuelve el sistema opeativo si no es undisporitivo móvil
     *
     * @return string
     */
    public static function get_sistema_operativo(): string
    {
        $user_agent = self::get_user_agent();

        if (preg_match('/linux/i', $user_agent)) {
            $platform = 'linux';

        } elseif (preg_match('/macintosh|mac os x/i', $user_agent)) {
            $platform = 'mac';

        } elseif (preg_match('/windows|win32/i', $user_agent)) {
            $platform = 'windows';

        } else {
            $platform = 'Otro';
        }

        return $platform;
    }

}
