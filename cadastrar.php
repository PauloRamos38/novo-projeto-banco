<?php

$mensagem = '';
$erro = '';

try {
    require_once __DIR__ . '/conexao.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = trim($_POST['nome'] ?? '');
        $sexo = $_POST['sexo'] ?? '';
        $dtnascimento = $_POST['dtnascimento'] ?? '';
        $email = trim($_POST['email'] ?? '');

        if ($email === '') {
            $email = null;
        }

        $sql = 'INSERT INTO aluno (nome, sexo, dtnascimento, email)
                VALUES (:nome, :sexo, :dtnascimento, :email)';

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome' => $nome,
            ':sexo' => $sexo,
            ':dtnascimento' => $dtnascimento,
            ':email' => $email
        ]);

        $mensagem = 'Aluno cadastrado com sucesso!';
    }
} catch (Throwable $e) {
    error_log($e->getMessage());
    $erro = 'Não foi possível cadastrar o aluno. Verifique o terminal do PHP.';
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Aluno</title>
</head>
<body>

<h1>Cadastrar Aluno</h1>

<?php if ($mensagem !== ''): ?>
    <p><?= htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>

<?php if ($erro !== ''): ?>
    <p><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>

<form method="POST">
    <label for="nome">Nome:</label><br>
    <input type="text" id="nome" name="nome" required maxlength="90">
    <br><br>

    <label for="sexo">Sexo:</label><br>
    <select id="sexo" name="sexo" required>
        <option value="">Selecione</option>
        <option value="M">Masculino</option>
        <option value="F">Feminino</option>
    </select>
    <br><br>

    <label for="dtnascimento">Data de nascimento:</label><br>
    <input type="date" id="dtnascimento" name="dtnascimento" required>
    <br><br>

    <label for="email">E-mail:</label><br>
    <input type="email" id="email" name="email" maxlength="30">
    <br><br>

    <button type="submit">Cadastrar</button>
</form>

</body>
</html>