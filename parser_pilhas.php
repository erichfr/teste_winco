<?php

function calcula_expressao($exp) {
    // Verifica se a expressão contém apenas caracteres válidos
    if (!preg_match('/^[0-9\(\)\+\-\s]+$/', $exp)) {
        return false;
    }

    $resultado = 0;
    $operador = '+';
    $pilha = [];

    for ($i = 0; $i < strlen($exp); $i++) {
        $caractere = $exp[$i];
        if ($caractere === '(') {
            // Empilha o estado atual do resultado e operador
            array_push($pilha, $resultado, $operador);
            $resultado = 0;
            $operador = '+';
        } elseif ($caractere === ')') {
            // Desempilha o último operador e resultado
            $prevOperador = array_pop($pilha);
            $prevResultado = array_pop($pilha);
            // Calcula o resultado do parêntese
            if ($prevOperador === '+') {
                $resultado = $prevResultado + $resultado;
            } else {
                $resultado = $prevResultado - $resultado;
            }
        } elseif ($caractere === '+' || $caractere === '-') {
            $operador = $caractere;
        } elseif (ctype_digit($caractere)) {
            $num = intval($caractere);
            // Enquanto o próximo caractere for um dígito, construa o número
            while ($i + 1 < strlen($exp) && ctype_digit($exp[$i + 1])) {
                $num = $num * 10 + intval($exp[$i + 1]);
                $i++;
            }
            // Aplica o operador ao número
            if ($operador === '+') {
                $resultado += $num;
            } else {
                $resultado -= $num;
            }
        }
    }

    // Verifica se a pilha está vazia, indicando que a expressão está bem formada
    return empty($pilha) ? $resultado : false;
}

// Exemplos de uso
echo calcula_expressao("1+2") . "\n";    
echo calcula_expressao("(5+5)-3") . "\n";   
echo calcula_expressao("(7-(5+5))") . "\n"; 
echo calcula_expressao("(7+2))-3") . "\n";  