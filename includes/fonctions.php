<?php
function pNumeroCheck($numero)
{
    if (strlen($numero) == 1) {
        return "000" . $numero;
    } elseif (strlen($numero) == 2) {
        return "00" . $numero;
    } elseif (strlen($numero) == 3) {
        return "0" . $numero;
    }
}

function pNumeroUncheck($numero)
{
    if (substr($numero, 0, 3) == "000") {
        return substr($numero, 3);
    } elseif (substr($numero, 0, 2) == "00") {
        return substr($numero, 2);
    } elseif (substr($numero, 0, 1) == "0") {
        return substr($numero, 1);
    } else {
        return $numero;
    }
}
