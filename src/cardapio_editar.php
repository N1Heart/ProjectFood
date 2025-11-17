<?php
// src/cardapio_editar.php

// 1. Lógica PRIMEIRO
require_once(__DIR__ . '/includes/auth_check.php');
require_once(__DIR__ . '/includes/db_connect.php');

$prato_id = $_GET['id'] ?? 0;
if (!$prato_id) {
    header("Location: cardapio_admin.php?feedback=" . urlencode("Erro: ID do prato não fornecido."));
    exit;
}

$nome = ""; $descricao = ""; $preco = ""; $disponivel = 1; $imagem_url_antiga = "";
$errors = [];

// 2. Processamento do POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);
    $preco = trim($_POST['preco']);
    $disponivel = isset($_POST['disponivel']) ? 1 : 0;
    // --- ADICIONADO: Pega o caminho da imagem antiga do formulário ---
    $imagem_url_antiga = $_POST['imagem_antiga'] ?? '';
    $imagem_url_db_path = $imagem_url_antiga; // Assume que a imagem não vai mudar

    if (empty($nome)) { $errors[] = "O nome do prato é obrigatório."; }
    if (empty($preco) || !is_numeric($preco)) { $errors[] = "O preço é obrigatório e deve ser um número."; }

    // --- ADICIONADO: LÓGICA DE UPLOAD (só se uma *nova* imagem for enviada) ---
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        
        $target_dir_relative = "uploads/cardapio/";
        $target_dir_full = __DIR__ . '/' . $target_dir_relative;
        $file_name = uniqid() . '-' . basename($_FILES["imagem"]["name"]);
        $target_file = $target_dir_full . $file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array($imageFileType, $allowed_types)) {
            $errors[] = "Apenas arquivos .jpg, .jpeg, .png, e .webp são permitidos.";
        } else {
            if (getimagesize($_FILES["imagem"]["tmp_name"])) {
                if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
                    // Sucesso! Define o *novo* caminho da imagem
                    $imagem_url_db_path = $target_dir_relative . $file_name;
                    
                    // --- ADICIONADO: Apaga a imagem antiga se ela existir ---
                    if (!empty($imagem_url_antiga) && file_exists(__DIR__ . '/' . $imagem_url_antiga)) {
                        unlink(__DIR__ . '/' . $imagem_url_antiga);
                    }
                } else {
                    $errors[] = "Erro ao salvar o novo arquivo de imagem.";
                }
            } else {
                $errors[] = "O novo arquivo enviado não é uma imagem válida.";
            }
        }
    }
    // --- FIM DA LÓGICA DE UPLOAD ---

    if (empty($errors)) {
        try {
            // --- MODIFICADO: Atualiza também a 'imagem_url' ---
            $sql = "UPDATE cardapio_pratos SET nome = ?, descricao = ?, preco = ?, imagem_url = ?, disponivel = ? 
                    WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            
            // --- MODIFICADO: Passa o $imagem_url_db_path (novo ou antigo) ---
            if ($stmt->execute([$nome, $descricao, $preco, $imagem_url_db_path, $disponivel, $prato_id])) {
                header("Location: cardapio_admin.php?feedback=" . urlencode("Prato atualizado com sucesso!"));
                exit;
            } else {
                $errors[] = "Erro ao atualizar o prato.";
            }
        } catch (PDOException $e) {
            $errors[] = "Erro ao atualizar: " . $e->getMessage();
        }
    }
}

// 3. Busca os dados (GET)
// --- MODIFICADO: Pega também a 'imagem_url' ---
if ($_SERVER["REQUEST_METHOD"] != "POST" || !empty($errors)) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM cardapio_pratos WHERE id = ?");
        $stmt->execute([$prato_id]);
        $prato = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($prato) {
            $nome = $prato['nome'];
            $descricao = $prato['descricao'];
            $preco = $prato['preco'];
            $disponivel = $prato['disponivel'];
            $imagem_url_antiga = $prato['imagem_url']; // --- ADICIONADO ---
        } else {
            header("Location: cardapio_admin.php?feedback=" . urlencode("Erro: Prato não encontrado."));
            exit;
        }
    } catch (PDOException $e) {
        header("Location: cardapio_admin.php?feedback=" . urlencode("Erro ao buscar prato: " . $e->getMessage()));
        exit;
    }
}

// 4. HTML SÓ AGORA
include(__DIR__ . '/includes/header.php');
echo "<title>Editar Prato</title>";
?>

<main>
    <div class="form-container" style="max-width: 600px;">
        <h1>Editar Prato</h1>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <form action="cardapio_editar.php?id=<?php echo $prato_id; ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="imagem_antiga" value="<?php echo htmlspecialchars($imagem_url_antiga); ?>">

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
                <label for="imagem">Trocar Imagem do Prato</label>
                <input type="file" id="imagem" name="imagem" accept="image/jpeg, image/png, image/webp">
                <small>Envie apenas se quiser alterar a imagem atual.</small>
                
                <?php if (!empty($imagem_url_antiga)): ?>
                    <div style="margin-top: 10px;">
                        <img src="/<?php echo htmlspecialchars($imagem_url_antiga); ?>" alt="Imagem Atual" style="width: 100px; height: auto; border-radius: 5px;">
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="form-group" style="display: flex; align-items: center; gap: 10px;">
                <input type="checkbox" id="disponivel" name="disponivel" value="1" <?php echo $disponivel ? 'checked' : ''; ?>>
                <label for="disponivel" style="margin-bottom: 0; font-weight: normal;">Disponível no cardápio público</label>
            </div>
            
            <button type="submit" class="btn">Salvar Alterações</button>
            <a href="cardapio_admin.php" style="margin-left: 15px;">Cancelar</a>
        </form>
    </div>
</main>

<?php
include(__DIR__ . '/includes/footer.php');
?>