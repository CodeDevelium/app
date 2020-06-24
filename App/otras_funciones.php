<?php



/**
 * Mostra un alert pel navegador
 *
 * @param String
 */
function alert($texto)
{
    echo "<script>alert('".addslashes($texto)."');</script>";
}

/**
 * Muestra un variable o estructura por una nueva ventana del navegador
 *
 * @param $texto
 */
function pr($texto)
{
    $texto_salida = '<pre>'.addslashes(nl2br(print_r($texto, true))).'</pre>';
    $texto_salida = str_replace(array("\r", "\n", "\r\n"), array('', '', ''), $texto_salida);

    echo '<script type="text/javascript">';
    echo 'w=window.open("","_blank","toolbar=yes, location=yes, directories=no, status=yes, menubar=yes, scrollbars=yes, resizable=yes, copyhistory=yes" );';
    echo 'w.document.write("<html lang=\"es\"><head><title>debug</title></head><body>'.$texto_salida.'</body>");';
    echo 'w.document.close();';
    echo '</script>';

}

