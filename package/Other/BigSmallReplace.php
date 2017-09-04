<?php

/**
 * BigSmallReplace
 *
 * @author   Pu ShaoWei <marco0727@gamil.com>
 * @date     2017/8/12
 * @license  Mozilla
 *
 * segmentFault： https://segmentfault.com/q/1010000010627229
 *
 * @param    $str
 * @return   string
 */
function BigSmallReplace( $str )
{
    // Cutting words
    $first  = preg_split("/[\s]+/", $str);
    $result = [];

    // Start
    foreach ( $first as $f_value ) {
        $str_len = strlen($f_value) - 1; $i = 0; $temp   = '';
        while ( $str_len >= 0 ) {
            if ( ord($f_value[$str_len]) > 64 && ord($f_value[$str_len]) < 91 ) {
                $temp   .=  strtoupper($f_value[$i]);
            }else if ( ord($f_value[$str_len]) > 96 && ord($f_value[$str_len]) < 123 ) {
                $temp   .=  strtolower($f_value[$i]);
            }
            $i++; $str_len--;
        }
        array_push($result, strrev($temp));
    }
    return implode(' ',$result);
}

var_dump(BigSmallReplace('Hello World'));
// Olleh Dlrow


/*
Hello World 输出 Olleh Dlrow

SWAT 输出 TAWS

I am A sTudent 输出 I ma A tNeduts
*/

