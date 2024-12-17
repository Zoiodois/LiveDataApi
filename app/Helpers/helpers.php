<?php

if (! function_exists('format_epoch')) {

    function format_epoch($epoch) {
        // Cria um objeto Carbon a partir do timestamp
        $dateTime = \Carbon\Carbon::createFromTimestamp($epoch);

        // Retorna um array com a data e a hora separadas
        return [
            'data' => $dateTime->format('d-m-Y'),  // Exemplo de formato de data
            'time' => $dateTime->format('H:i:s'),  // Exemplo de formato de hora
        ];
    }
}
