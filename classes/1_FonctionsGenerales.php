<?php

function strCheck($str){
    $str = str_replace("'", "''", $str);
    $str = str_replace("\\", "\\\\", $str);
    return $str;
}