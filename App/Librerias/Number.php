<?php
/**
 * Number.php
 *
 * @version     1.0
 * @author      Code Develium
 */

namespace App\Librerias;

/**
 * Manipualción de números
 * Class Number
 *
 * @package App\Librerias
 */
abstract class Number
{

    /**
     * Devuelve un string de una caontidad en fomarto del pais locale
     *
     * @param        $number
     * @param string $simbolo
     *
     * @return string
     */
    public static function display_money($number, $simbolo = ''): string
    {
        $expresion_regular = '/%((?:[\^!\-]|\+|\(|\=.)*)([0-9]+)?'.'(?:#([0-9]+))?(?:\.([0-9]+))?([in%])/';
        if (setlocale(LC_MONETARY, 0) == 'C') {
            setlocale(LC_MONETARY, '');
        }

        $locale = localeconv();
        $format = '%i';
        preg_match_all($expresion_regular, $format, $matches, PREG_SET_ORDER);

        foreach ($matches as $fmatch) {

            $value = floatval($number);
            $flags = array(
                'fillchar'  => preg_match('/\=(.)/', $fmatch[ 1 ], $match) ? $match[ 1 ] : ' ',
                'nogroup'   => preg_match('/\^/', $fmatch[ 1 ]) > 0,
                'usesignal' => preg_match('/\+|\(/', $fmatch[ 1 ], $match) ? $match[ 0 ] : '+',
                'nosimbol'  => preg_match('/\!/', $fmatch[ 1 ]) > 0,
                'isleft'    => preg_match('/\-/', $fmatch[ 1 ]) > 0
            );
            $width = trim($fmatch[ 2 ]) ? (int)$fmatch[ 2 ] : 0;
            $left  = trim($fmatch[ 3 ]) ? (int)$fmatch[ 3 ] : 0;
            $right = trim($fmatch[ 4 ]) ? (int)$fmatch[ 4 ] : $locale[ 'int_frac_digits' ];

            $conversion     = $fmatch[ 5 ];
            $valor_positivo = true;

            if ($value < 0) {
                $valor_positivo = false;
                $value          *= -1;
            }
            $letter = $valor_positivo ? 'p' : 'n';

            $prefijo = $sufijo = $cprefix = $csuffix = $signo = '';

            $signo = $valor_positivo ? $locale[ 'positive_sign' ] : $locale[ 'negative_sign' ];

            switch (true) {
                case $locale[ "{$letter}_sign_posn" ] == 1 && $flags[ 'usesignal' ] == '+':
                    $prefijo = $signo;
                    break;
                case $locale[ "{$letter}_sign_posn" ] == 2 && $flags[ 'usesignal' ] == '+':
                    $sufijo = $signo;
                    break;
                case $locale[ "{$letter}_sign_posn" ] == 3 && $flags[ 'usesignal' ] == '+':
                    $cprefix = $signo;
                    break;
                case $locale[ "{$letter}_sign_posn" ] == 4 && $flags[ 'usesignal' ] == '+':
                    $csuffix = $signo;
                    break;
                case $flags[ 'usesignal' ] == '(':
                case $locale[ "{$letter}_sign_posn" ] == 0:
                    $prefijo = '(';
                    $sufijo  = ')';
                    break;
            }
            if ( ! $flags[ 'nosimbol' ]) {
                $currency = $cprefix.($conversion == 'i' ? $locale[ 'int_curr_symbol' ] : $locale[ 'currency_symbol' ]).$csuffix;
            } else {
                $currency = $cprefix.$csuffix;
            }
            $currency = ' '.$simbolo.' '; // Eliminamos el texto de la moneda

            $espacio = $locale[ "{$letter}_sep_by_space" ] ? ' ' : '';

            $value = number_format($value, $right, $locale[ 'mon_decimal_point' ],
                                   $flags[ 'nogroup' ] ? '' : $locale[ 'mon_thousands_sep' ]);
            $value = @explode($locale[ 'mon_decimal_point' ], $value);

            $n = strlen($prefijo) + strlen($currency) + strlen($value[ 0 ]);
            if ($left > 0 && $left > $n) {
                $value[ 0 ] = str_repeat($flags[ 'fillchar' ], $left - $n).$value[ 0 ];
            }
            $value = implode($locale[ 'mon_decimal_point' ], $value);
            if ($locale[ "{$letter}_cs_precedes" ]) {
                $value = $prefijo.$currency.$espacio.$value.$sufijo;
            } else {
                $value = $prefijo.$value.$espacio.$currency.$sufijo;
            }
            if ($width > 0) {
                $value = str_pad($value, $width, $flags[ 'fillchar' ],
                                 $flags[ 'isleft' ] ? STR_PAD_RIGHT : STR_PAD_LEFT);
            }

            $format = str_replace($fmatch[ 0 ], $value, $format);
        }
        $format = trim(str_replace('  ', ' ', $format));

        return $format;
    }

}
