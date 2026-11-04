<?php
function formatarPreco(float $valor): string {
    return "R$ " . number_format($valor, 2, ",", ".");
}
$produtos = [
    ["nome" => "Teclado mecânico", "preco" => 249.90, "estoque" => 12, "categoria" => "Periféricos"],
    ["nome" => "Mouse sem fio", "preco" => 79.50, "estoque" => 30, "categoria" => "Periféricos"],
    ["nome" => "Monitor LED 24pol", "preco" => 899.00, "estoque" => 5, "categoria" => "Monitores"],
    ["nome" => "Fone de ouvido com microfone", "preco" => 59.90, "estoque" => 0, "categoria" => "Áudio"]
];

$total = 0;
foreach ($produtos as $item) {
    $total += $item["preco"] * $item["estoque"];
}
$quantidade = count($produtos);

usort($produtos, fn($a, $b) => $a["preco"] <=> $b["preco"]);

$valorMinimo = 100;
$produtosFiltrados = array_filter($produtos, fn($p) => $p["preco"] > $valorMinimo);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Produtos</title>
    <style>
        .esgotado { color: red; font-weight: bold; }
        table { border-collapse: collapse; margin: 1rem 0; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>

<h1>Lista de Produtos</h1>

<p><?= $quantidade ?> produtos cadastrados. Valor total em estoque: <?= formatarPreco($total) ?></p>

<h2>Tabela completa (ordenada por preço)</h2>
<table>
  <thead>
    <tr>
      <th>Produto</th>
      <th>Preço</th>
      <th>Estoque</th>
      <th>Situação</th>
      <th>Categoria</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($produtos as $item): ?>
    <tr class="<?= $item["estoque"] > 0 ? "" : "esgotado" ?>">
      <td><?= htmlspecialchars($item["nome"]) ?></td>
      <td><?= formatarPreco($item["preco"]) ?></td>
      <td><?= $item["estoque"] ?></td>
      <td><?= $item["estoque"] > 0 ? "Disponível" : "Esgotado" ?></td>
      <td><?= htmlspecialchars($item["categoria"]) ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<h2>Produtos com preço acima de <?= formatarPreco($valorMinimo) ?></h2>
<ul>
<?php foreach ($produtosFiltrados as $item): ?>
  <li>
    <strong><?= htmlspecialchars($item["nome"]) ?></strong> —
    <?= formatarPreco($item["preco"]) ?> —
    <?= $item["estoque"] > 0 ? "Disponível" : "Esgotado" ?>
  </li>
<?php endforeach; ?>
</ul>

</body>
</html>
