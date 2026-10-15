<?php

$archivoEnv = dirname(__DIR__) . '/.env';

if (file_exists($archivoEnv)) {
    $lineas = file($archivoEnv, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lineas as $linea) {
        $linea = trim($linea);

        if ($linea === '' || str_starts_with($linea, '#')) {
            continue;
        }

        $partes = explode('=', $linea, 2);

        if (count($partes) === 2) {
            $clave = trim($partes[0]);
            $valor = trim($partes[1]);
            $_ENV[$clave] = trim($valor, "\"'");
        }
    }
}

function env(string $clave, string $predeterminado = ''): string
{
    return $_ENV[$clave] ?? $predeterminado;
}