<?php
function pNumeroCheck($numero_a_modifier)
{
    $numero = $numero_a_modifier;
    if (strlen($numero) == 1) {
        return "000" . $numero;
    } elseif (strlen($numero) == 2) {
        return "00" . $numero;
    } elseif (strlen($numero) == 3) {
        return "0" . $numero;
    }
}

function pNumeroUncheck($numero_a_modifier)
{
    $numero = $numero_a_modifier;
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

function str_replace_comma($string)
{
    $newString = str_replace(".", ",", $string);
    return $newString;
}

function gen_token($unique)
{
    $rand = bin2hex(random_bytes(32));
    $id = base64_encode($unique);
    return $id . $rand;
}

function token_exp($hours = 12)
{
    $exp = ($hours * 60 * 60);
    return date('Y-m-d H:i:s', time() + $exp);
}

function testInput($data)
{
    $data = trim($data);
    $data = strip_tags($data);
    return $data;
}


function getEvolutionChain($id, $db)
{
    $chain = [];
    $query = "SELECT p.*, GROUP_CONCAT(t.type_name ORDER BY t.type_name SEPARATOR ', ') as types
        FROM pokemon p LEFT JOIN pokemon_types pt ON p.id = pt.pokemon_id LEFT JOIN types t ON pt.type_id = t.id
        WHERE p.id = :id GROUP BY p.id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $chain[] = $row;
        if ($row['evolves_from']) {
            $chain = array_merge(getEvolutionChain($row['evolves_from'], $db), $chain);
        }
    }
    return $chain;
}
