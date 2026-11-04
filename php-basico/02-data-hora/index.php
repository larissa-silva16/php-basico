<?php
date_default_timezone_set("America/Sao_Paulo");

$data = date("d/m/Y");
$hora = date("H:i:s");

$hora_do_dia = (int)date("H");

if ($hora_do_dia >= 5 && $hora_do_dia < 12) {
    $saudacao = "Bom dia!";
} elseif ($hora_do_dia >= 12 && $hora_do_dia < 18) {
    $saudacao = "Boa tarde!";
} else {
    $saudacao = "Boa noite!";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Data e Hora</title>
</head>
<body>
    <h1>Data e Hora do Servidor</h1>

    <p><?= $saudacao ?></p>

    <p>Hoje é <strong><?= $data ?></strong>.</p>
    
    <p>Agora são <strong><?= $hora ?></strong>.</p>
</body>
</html>
