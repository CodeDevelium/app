<?php
/**
 * Archivo.php
 *
 * @version     1.0
 * @author      Code Develium
 */

namespace App\Librerias;


/**
 * Manipulación de archivos
 * Class Archivo
 *
 * @package App\Controladores
 */
abstract class Archivo
{
    /**
     * Descarrega un array como un archivo CSV
     *
     * @param array  $array
     * @param string $nombre_archivo
     */
    public static function descargar_archivo_csv(array $array, string $nombre_archivo): void
    {
        // Desactivamos cache
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2010 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

        // Forzamos la descarga
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

        // Descripción y encode
        header("Content-Disposition: attachment;filename={$nombre_archivo}");
        header("Content-Transfer-Encoding: binary");

        ob_start();
        $df = fopen("php://output", 'w');
        foreach ($array as $row) {
            fputcsv($df, $row);
        }
        fclose($df);
        echo ob_get_clean();
    }

}
