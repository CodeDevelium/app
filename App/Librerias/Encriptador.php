<?php
/**
 * Encriptador.php
 *
 * @version     1.0
 * @author      Code Develium
 */

namespace App\Librerias;



/**
 * Urtilidades de encriptación
 */
abstract class Encriptador
{
    /**
     * Devuelve un parametro encriptado si ENCRIPTAR_URL = true, sinó devuelve el mismo parámetro
     *
     * @param string|null $parametro
     *
     * @return string
     */
    public static function get_valor_encriptado(?string $parametro): string
    {
        // TODO
        return self::encriptar_aleatorio($parametro);
    }

    /**
     * Devuelve un parametro deencriptado si ENCRIPTAR_URL = true, sinó devuelve el mismo parámetro
     *
     * @param string|null $parametro
     *
     * @return string
     */
    public static function get_valor_desencriptado(?string $parametro): ?string
    {
        // TODO
        return self::desencriptar_aleatorio($parametro);
    }

    /**
     * Encripta un valor integer de parametro
     *
     * @param string|null $parametro_plano
     *
     * @return string
     */
    private static function encriptar_aleatorio(?string $parametro_plano): ?string
    {
        $url            = $parametro_plano.'#'.Str::generar_numero_aleatorio();
        $url_encriptada = Encriptador::get_encriptado($url);

        // Sustituimos en el Base64 los caracteres +=/ ya que pueden dar problemas en la url
        return str_replace(array('+', '=', '/'), array('-', ',', '_'), $url_encriptada);
    }

    /**
     * Desencripta un valor integer de parametro
     *
     * @param string $parametro_encriptado
     *
     * @return string
     */
    private static function desencriptar_aleatorio(?string $parametro_encriptado): ?string
    {
        // Restablecemos los caracteres +=/
        $url_encriptada = str_replace(array('-', ',', '_'), array('+', '=', '/'), ''.$parametro_encriptado);
        $url_plano      = Encriptador::get_desencriptado($url_encriptada);
        // Devolvemos hasta el separador
        return substr($url_plano, 0, strpos($url_plano, '#'));
    }

    /**
     * Desencriptación por trasposición
     *
     * @param string $str_encriptado
     *
     * @return string
     */
    public static function get_desencriptado(string $str_encriptado): string
    {
        $str_encriptado = base64_decode($str_encriptado);

        $len_str_message = strlen($str_encriptado);

        $str_encrypted_message = "";

        for ($position = 0; $position < $len_str_message; $position++) {

            $key_to_use = (($len_str_message + $position) + 1);
            $key_to_use = (255 + $key_to_use) % 255;

            $byte_to_be_encrypted = substr($str_encriptado, $position, 1);

            $ascii_num_byte_to_encrypt = ord($byte_to_be_encrypted);

            $xored_byte = $ascii_num_byte_to_encrypt ^ $key_to_use;

            $encrypted_byte = chr($xored_byte);

            $str_encrypted_message .= $encrypted_byte;
        }
        return $str_encrypted_message;
    }

    /**
     * Encriptación por trasposición
     *
     * @param string $str_plano
     *
     * @return string
     */
    public static function get_encriptado(string $str_plano): string
    {

        $len_str_message       = strlen($str_plano);
        $str_encrypted_message = "";

        for ($position = 0; $position < $len_str_message; $position++) {

            $key_to_use = (($len_str_message + $position) + 1);
            $key_to_use = (255 + $key_to_use) % 255;

            $byte_to_be_encrypted = substr($str_plano, $position, 1);

            $ascii_num_byte_to_encrypt = ord($byte_to_be_encrypted);

            $xored_byte = $ascii_num_byte_to_encrypt ^ $key_to_use;

            $encrypted_byte = chr($xored_byte);

            $str_encrypted_message .= $encrypted_byte;
        }

        return base64_encode($str_encrypted_message);
    }

}
