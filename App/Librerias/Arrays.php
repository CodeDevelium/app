<?php
/**
 * Arrays.php
 *
 * @version     1.0
 * @author      Code Develium
 */

namespace App\Librerias;


/**
 * Manipulación de arrays
 * Class Arrays
 *
 * @package App\Controladores
 */
abstract class Arrays
{

    /**
     * Elimina toda una columna por si posición de un array. (0 es la primera)
     *
     * @param $array
     * @param $position
     *
     * @return mixed
     */
    public static function delete_column_by_position($array, $position)
    {
        array_walk(
            $array,
            function (&$arr) use ($position) {
                array_splice($arr, $position, 1);
            }
        );

        return $array;
    }

}
