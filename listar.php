<?php

$alunos = [];
$erro = '';

try {
    require_once __DIR__ . '/conexao.php';

    $sql = 'SELECT codigoaluno, nome, sexo, dtnascimento, email
            FROM aluno
            ORDER BY codigoaluno';

    $stmt = $pdo->query($sql);
    $alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Throwable $e) {
    error_log($e->getMessage());
    $erro = 'Não foi possível listar os alunos. Verifique o terminal do PHP.';
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Alunos</title>
</head>
<body>

<h1>Alunos cadastrados</h1>

<?php if ($erro !== ''): ?>
    <p><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></p>
<?php elseif (count($alunos) === 0): ?>
    <p>Nenhum aluno cadastrado.</p>
<?php else: ?>
    <table border="1" cellpadding="6">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Sexo</th>
                <th>Nascimento</th>
                <th>E-mail</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($alunos as $aluno): ?>
                <tr>
                    <td><?= htmlspecialchars((string) $aluno['codigoaluno'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($aluno['nome'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($aluno['sexo'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($aluno['dtnascimento'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($aluno['email'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

</body>
</html>