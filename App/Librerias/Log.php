<?php
/**
 * Log.php
 *
 * @version     1.0
 * @author      Code Develium
 */

namespace App\Librerias;


use Exception;

/**
 * Class Log
 *
 * @package App\Controladores
 */
abstract class Log
{
    /**
     * Guardamos un error en una rchivo
     *
     * @param string         $error_texto
     * @param Exception|null $ex
     */
    public static function save_error(string $error_texto, Exception $ex = null): void
    {
        $archivo_logs = ''; // TODO App::$Config->getPathLogs();

        error_log('>>> '.date('h:i:s').' ERR: '.$error_texto.PHP_EOL, 3, $archivo_logs);

        if (!empty($ex)) {
            error_log('>>> '.date('h:i:s').' EXC: '.$ex->getMessage().PHP_EOL, 3, $archivo_logs);
            error_log('>>> '.date('h:i:s').' EXC: '.$ex->getTraceAsString().PHP_EOL, 3, $archivo_logs);
        }
    }

    /**
     * Guardamos una traza en un archivo
     *
     * @param string $texto
     */
    public static function save_trace(string $texto): void
    {
        $archivo_logs = ''; // TODO App::$Config->getPathLogs();

        error_log('>>> '.date('h:i:s').' ' .$texto.PHP_EOL, 3, $archivo_logs);
    }

}
