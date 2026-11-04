<?php
$erro = "";
$imcFormatado = "";
$classe = "";

$peso = (float) str_replace(",", ".", $_GET["peso"] ?? "0");
$altura = (float) str_replace(",", ".", $_GET["altura"] ?? "0");

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["peso"], $_GET["altura"])) {
    if ($peso <= 0 || $altura <= 0) {
        $erro = "Informe peso e altura maiores que zero.";
    } else {
        $imc = $peso / ($altura * $altura);
        $imcFormatado = number_format($imc, 1, ",", ".");

        if ($imc < 18.5) {
            $classe = "Abaixo do peso";
        } elseif ($imc < 25) {
            $classe = "Peso normal";
        } elseif ($imc < 30) {
            $classe = "Sobrepeso";
        } elseif ($imc < 35) {
            $classe = "Obesidade Grau I";
        } elseif ($imc < 40) {
            $classe = "Obesidade Grau II";
        } else {
            $classe = "Obesidade Grau III";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Calculadora de IMC</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 2rem auto; padding: 0 1rem; }
        form { background: #f5f5f5; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; }
        label { display: block; margin: 0.8rem 0 0.2rem; }
        input { padding: 0.5rem; width: 100%; border: 1px solid #ccc; border-radius: 4px; }
        button { margin-top: 1rem; padding: 0.7rem 1.5rem; background: #2980b9; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 1rem; }
        .erro { color: #d63031; background: #ffebee; padding: 1rem; border-radius: 6px; }
        .sucesso { color: #2d3436; background: #e8f5e9; padding: 1rem; border-radius: 6px; }
    </style>
</head>
<body>
    <h1>Calculadora de IMC</h1>

    <form method="get">
        <label for="peso">Peso (kg):</label>
        <input type="text" id="peso" name="peso" placeholder="Ex: 70 ou 70,5" value="<?= htmlspecialchars($_GET["peso"] ?? "") ?>">

        <label for="altura">Altura (m):</label>
        <input type="text" id="altura" name="altura" placeholder="Ex: 1.75 ou 1,75" value="<?= htmlspecialchars($_GET["altura"] ?? "") ?>">

        <button type="submit">Calcular</button>
    </form>

    <?php if ($erro): ?>
        <div class="erro"><?= $erro ?></div>
    <?php elseif ($imcFormatado): ?>
        <div class="sucesso">
            <p>Peso: <strong><?= $peso ?></strong> kg</p>
            <p>Altura: <strong><?= $altura ?></strong> m</p>
            <p>IMC: <strong><?= $imcFormatado ?></strong></p>
            <p>Classificação: <strong><?= $classe ?></strong></p>
        </div>
    <?php endif; ?>
</body>
</html>
