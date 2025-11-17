<?php
// src/cardapio_novo.php

// 1. Lógica PRIMEIRO
require_once(__DIR__ . '/includes/auth_check.php');
require_once(__DIR__ . '/includes/db_connect.php');

$nome = "";
$descricao = "";
$preco = "";
$disponivel = 1; // Padrão é disponível
$errors = [];

// 2. Processamento do POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);
    $preco = trim($_POST['preco']);
    $disponivel = isset($_POST['disponivel']) ? 1 : 0;
    
    // --- ADICIONADO ---
    // Variável para guardar o caminho da imagem no banco
    $imagem_url_db_path = null; 

    if (empty($nome)) { $errors[] = "O nome do prato é obrigatório."; }
    if (empty($preco) || !is_numeric($preco)) { $errors[] = "O preço é obrigatório e deve ser um número."; }

    // --- ADICIONADO: LÓGICA DE UPLOAD DA IMAGEM ---
    // Verifica se um arquivo foi enviado E se não houve erro no upload
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        
        $target_dir_relative = "uploads/cardapio/"; // Caminho relativo que salvaremos no DB
        $target_dir_full = __DIR__ . '/' . $target_dir_relative; // Caminho completo no servidor

        // Garante que a pasta de uploads exista
        if (!is_dir($target_dir_full)) {
            mkdir($target_dir_full, 0755, true);
        }

        // Cria um nome de arquivo único para evitar conflitos
        $file_name = uniqid() . '-' . basename($_FILES["imagem"]["name"]);
        $target_file = $target_dir_full . $file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Lista de tipos de imagem permitidos
        $allowed_types = ['jpg', 'jpeg', 'png', 'webp'];
        if (!in_array($imageFileType, $allowed_types)) {
            $errors[] = "Apenas arquivos .jpg, .jpeg, .png, e .webp são permitidos.";
        } else {
            // Verifica se é uma imagem real
            if (getimagesize($_FILES["imagem"]["tmp_name"])) {
                // Tenta mover o arquivo da pasta temporária do PHP para nossa pasta
                if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
                    // Sucesso! Guarda o caminho relativo para o banco
                    $imagem_url_db_path = $target_dir_relative . $file_name;
                } else {
                    $errors[] = "Erro ao salvar o arquivo de imagem no servidor.";
                }
            } else {
                $errors[] = "O arquivo enviado não é uma imagem válida.";
            }
        }
    }
    // --- FIM DA LÓGICA DE UPLOAD ---


    // Só tenta salvar no banco se não houver erros (nem de campos, nem de upload)
    if (empty($errors)) {
        try {
            // --- MODIFICADO: Adicionada a coluna 'imagem_url' ---
            $sql = "INSERT INTO cardapio_pratos (nome, descricao, preco, imagem_url, disponivel) 
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            
            // --- MODIFICADO: Adicionada a variável $imagem_url_db_path ---
            if ($stmt->execute([$nome, $descricao, $preco, $imagem_url_db_path, $disponivel])) {
                header("Location: cardapio_admin.php?feedback=" . urlencode("Prato cadastrado com sucesso!"));
                exit;
            } else {
                $errors[] = "Erro ao cadastrar o prato.";
            }
        } catch (PDOException $e) {
            $errors[] = "Erro ao cadastrar: " . $e->getMessage();
        }
    }
}

// 3. HTML SÓ AGORA
include(__DIR__ . '/includes/header.php');
echo "<title>Novo Prato do Cardápio</title>";
?>

<main>
    <div class="form-container" style="max-width: 600px;">
        <h1>Novo Prato do Cardápio</h1>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <form action="cardapio_novo.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nome">Nome do Prato *</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" rows="4" style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;"><?php echo htmlspecialchars($descricao); ?></textarea>
            </div>
            <div class="form-group">
                <label for="preco">Preço * (Ex: 12.50)</label>
                <input type="number" step="0.01" id="preco" name="preco" value="<?php echo htmlspecialchars($preco); ?>" required>
            </div>
            <div class="form-group">
                 <label for="imagem">Imagem do Prato</label>
                <input type="file" id="imagem" name="imagem" accept="image/jpeg, image/png, image/webp">
                <small>Envie apenas .jpg, .png ou .webp</small>
            </div>
            <div class="form-group" style="display: flex; align-items: center; gap: 10px;">
                <input type="checkbox" id="disponivel" name="disponivel" value="1" <?php echo $disponivel ? 'checked' : ''; ?>>
                <label for="disponivel" style="margin-bottom: 0; font-weight: normal;">Disponível no cardápio público</label>
            </div>
            
            <button type="submit" class="btn">Cadastrar Prato</button>
            <a href="cardapio_admin.php" style="margin-left: 15px;">Cancelar</a>
        </form>
    </div>
</main>

<?php
include(__DIR__ . '/includes/footer.php');
?>