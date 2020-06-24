<?php
/**
 * Imagen.php
 *
 * @version     1.0
 * @author      Code Develium
 */

namespace App\Librerias;


/**
 * Manipulación de imágenes
 * Class Imagen
 *
 * @package App\Librerias
 */
abstract class Imagen
{
    /**
     * Genera una imagna de captcha. Devuelve el texto generado
     *
     * @param string $nombreImagen nombre de la imagen a generar.
     *
     * @return string
     */
    public static function crear_captcha($nombreImagen)
    {
        $image            = imagecreatetruecolor(200, 50);
        $background_color = imagecolorallocate($image, 255, 255, 255);
        imagefilledrectangle($image, 0, 0, 200, 50, $background_color);

        $line_color      = imagecolorallocate($image, 64, 64, 64);
        $number_of_lines = 0;//rand(3, 7);

        for ($i = 0; $i < $number_of_lines; $i++) {
            imageline($image, 0, rand() % 50, 250, rand() % 50, $line_color);
        }

        $pixel = imagecolorallocate($image, 0, 0, 255);
        for ($i = 0; $i < 800; $i++) {
            imagesetpixel($image, rand() % 200, rand() % 50, $pixel);
        }

        //$allowed_letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $allowed_letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length          = strlen($allowed_letters);
        //$letter = $allowed_letters[rand(0, $length-1)];
        $word       = '';
        $text_color = imagecolorallocate($image, 0, 0, 0);
        $cap_length = 6;// No. of character in image
        for ($i = 0; $i < $cap_length; $i++) {
            $letter = $allowed_letters[ rand(0, $length - 1) ];
            imagestring($image, 5, 5 + ($i * 30), 20, $letter, $text_color);
            $word .= $letter;
        }

        imagepng($image, $nombreImagen);

        return $word;
    }
}