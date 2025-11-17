<?php
// src/pedidos_novo.php

// 1. LÓGICA PRIMEIRO
require_once(__DIR__ . '/includes/auth_check.php');
require_once(__DIR__ . '/includes/db_connect.php');

$errors = [];
$clientes = [];
$pratos = [];

// 2. BUSCAR DADOS PARA OS DROPDOWNS (CLIENTES E PRATOS)
try {
    // Busca clientes
    $stmt_clientes = $pdo->query("SELECT id, nome FROM clientes ORDER BY nome ASC");
    $clientes = $stmt_clientes->fetchAll(PDO::FETCH_ASSOC);

    // Busca pratos disponíveis no cardápio
    $stmt_pratos = $pdo->query("SELECT id, nome, preco FROM cardapio_pratos WHERE disponivel = 1 ORDER BY nome ASC");
    $pratos = $stmt_pratos->fetchAll(PDO::FETCH_ASSOC);
    
    // Converte os pratos para JSON para o JavaScript usar
    $pratos_json = json_encode(array_column($pratos, null, 'id'));

} catch (PDOException $e) {
    $errors[] = "Erro ao carregar dados: " . $e->getMessage();
}


// 3. PROCESSAMENTO DO POST (QUANDO FINALIZA O PEDIDO)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $cliente_id = $_POST['cliente_id'] ?? null;
    $funcionario_id = $_SESSION['funcionario_id']; // Pega o ID do funcionário logado
    $prato_ids = $_POST['prato_id'] ?? []; // Array de IDs
    $quantidades = $_POST['quantidade'] ?? []; // Array de quantidades
    $total_final = 0;

    // Validação
    if (empty($cliente_id)) { $cliente_id = null; } // Permite pedido sem cliente
    if (empty($prato_ids)) { $errors[] = "Você deve adicionar pelo menos um prato ao pedido."; }

    if (empty($errors)) {
        
        // Inicia a Transação
        $pdo->beginTransaction();
        
        try {
            // --- ETAPA 1: Criar o Pedido ---
            // Insere o pedido com um total temporário de 0
            $sql_pedido = "INSERT INTO pedidos (cliente_id, funcionario_id, total, status) 
                           VALUES (?, ?, 0, 'Pendente')";
            $stmt_pedido = $pdo->prepare($sql_pedido);
            $stmt_pedido->execute([$cliente_id, $funcionario_id]);
            
            // Pega o ID do pedido que acabamos de criar
            $pedido_id = $pdo->lastInsertId();

            // --- ETAPA 2: Inserir os Itens do Pedido ---
            foreach ($prato_ids as $index => $prato_id) {
                $quantidade = $quantidades[$index];
                
                // Pega o preço do prato (do banco, para segurança)
                $stmt_preco = $pdo->prepare("SELECT preco FROM cardapio_pratos WHERE id = ?");
                $stmt_preco->execute([$prato_id]);
                $prato = $stmt_preco->fetch(PDO::FETCH_ASSOC);
                
                if (!$prato) {
                    throw new Exception("Prato com ID $prato_id não encontrado.");
                }
                
                $preco_unitario = $prato['preco'];
                $total_final += ($preco_unitario * $quantidade); // Calcula o total

                // Insere o item
                $sql_item = "INSERT INTO pedidos_itens (pedido_id, prato_id, quantidade, preco_unitario) 
                             VALUES (?, ?, ?, ?)";
                $stmt_item = $pdo->prepare($sql_item);
                $stmt_item->execute([$pedido_id, $prato_id, $quantidade, $preco_unitario]);
            }

            // --- ETAPA 3: Atualizar o Pedido com o Total Correto ---
            $sql_update_total = "UPDATE pedidos SET total = ? WHERE id = ?";
            $stmt_update_total = $pdo->prepare($sql_update_total);
            $stmt_update_total->execute([$total_final, $pedido_id]);

            // Se tudo deu certo, confirma
            $pdo->commit();
            
            header("Location: pedidos.php?feedback=" . urlencode("Pedido #" . $pedido_id . " registrado com sucesso!"));
            exit;

        } catch (Exception $e) {
            // Se algo deu errado, desfaz tudo
            $pdo->rollBack();
            $errors[] = "Erro grave ao registrar o pedido: ". $e->getMessage();
        }
    }
}

// 4. HTML SÓ AGORA
include(__DIR__ . '/includes/header.php');
echo "<title>Registrar Novo Pedido</title>";
?>

<main>
    <div class="form-container" style="max-width: 900px;">
        <h1>Registrar Novo Pedido</h1>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <form action="pedidos_novo.php" method="POST" id="form-pedido">
            
            <div class="form-group">
                <label for="cliente_id">Cliente (Opcional)</label>
                <select id="cliente_id" name="cliente_id" style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;">
                    <option value="">-- Consumidor Final (Sem cadastro) --</option>
                    <?php foreach ($clientes as $cliente): ?>
                        <option value="<?php echo $cliente['id']; ?>">
                            <?php echo htmlspecialchars($cliente['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <hr style="margin: 2rem 0;">

            <h2>Itens do Pedido</h2>
            <div class="form-group" style="display: flex; gap: 10px; align-items: flex-end; background: #f9f9f9; padding: 1rem; border-radius: 5px;">
                <div style="flex-grow: 1;">
                    <label for="prato-select">Selecionar Prato</label>
                    <select id="prato-select" style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;">
                        <option value="">-- Escolha um prato --</option>
                        <?php foreach ($pratos as $prato): ?>
                            <option value="<?php echo $prato['id']; ?>" data-nome="<?php echo htmlspecialchars($prato['nome']); ?>" data-preco="<?php echo $prato['preco']; ?>">
                                <?php echo htmlspecialchars($prato['nome']); ?> (R$ <?php echo number_format($prato['preco'], 2, ',', '.'); ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="prato-qtd">Qtd.</label>
                    <input type="number" id="prato-qtd" value="1" min="1" style="width: 70px; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;">
                </div>
                <button type="button" class="btn" id="btn-add-prato" style="background-color: #007bff;">Adicionar</button>
            </div>

            <div id="itens-pedido-container" style="margin-top: 1.5rem;">
                </div>
            
            <div style="margin-top: 2rem; text-align: right;">
                <h3 id="total-pedido">Total: R$ 0,00</h3>
                <button type="submit" class="btn">Finalizar Pedido</button>
                <a href="pedidos.php" style="margin-left: 15px;">Cancelar</a>
            </div>

        </form>
    </div>
</main>

<script>
// Passa os dados dos pratos do PHP para o JavaScript
const pratosDisponiveis = <?php echo $pratos_json; ?>;

// Pega os elementos do DOM
const btnAddPrato = document.getElementById('btn-add-prato');
const selectPrato = document.getElementById('prato-select');
const inputQtd = document.getElementById('prato-qtd');
const containerItens = document.getElementById('itens-pedido-container');
const totalDisplay = document.getElementById('total-pedido');

let itensNoPedido = {}; // Objeto para guardar os itens e atualizar o total

// Função para quando o botão "Adicionar" é clicado
function adicionarPrato() {
    const pratoId = selectPrato.value;
    const quantidade = parseInt(inputQtd.value);

    // Validação
    if (!pratoId) {
        alert('Por favor, selecione um prato.');
        return;
    }
    if (isNaN(quantidade) || quantidade <= 0) {
        alert('Por favor, insira uma quantidade válida.');
        return;
    }

    // Pega os dados do prato
    const pratoInfo = pratosDisponiveis[pratoId];
    if (!pratoInfo) {
        alert('Erro: Prato não encontrado.');
        return;
    }
    
    // Adiciona/atualiza o item no nosso objeto
    if (itensNoPedido[pratoId]) {
        // Se já existe, apenas soma a quantidade
        itensNoPedido[pratoId].quantidade += quantidade;
    } else {
        // Se é novo, adiciona
        itensNoPedido[pratoId] = {
            id: pratoId,
            nome: pratoInfo.nome,
            preco: parseFloat(pratoInfo.preco),
            quantidade: quantidade
        };
    }

    // Redesenha a lista de itens e atualiza o total
    atualizarListaEtotal();

    // Limpa os campos
    selectPrato.value = '';
    inputQtd.value = 1;
}

// Função principal que redesenha a lista e o total
function atualizarListaEtotal() {
    // Limpa o container
    containerItens.innerHTML = '';
    let totalGeral = 0;
    
    // Passa por todos os itens no objeto 'itensNoPedido'
    for (const id in itensNoPedido) {
        const item = itensNoPedido[id];
        const subtotal = item.preco * item.quantidade;
        totalGeral += subtotal;

        // Cria o HTML para o item
        const itemHtml = `
            <div style="background: #fff; padding: 1rem; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 10px; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <strong>${item.nome}</strong> (Qtd: ${item.quantidade})
                    <br>
                    <small>R$ ${item.preco.toFixed(2)} un. | Subtotal: R$ ${subtotal.toFixed(2)}</small>
                </div>
                <button type="button" class="btn-remover" data-id="${id}" style="background: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer;">Remover</button>
                
                <input type="hidden" name="prato_id[]" value="${item.id}">
                <input type="hidden" name="quantidade[]" value="${item.quantidade}">
            </div>
        `;
        containerItens.insertAdjacentHTML('beforeend', itemHtml);
    }
    
    // Atualiza o total na tela
    totalDisplay.textContent = `Total: R$ ${totalGeral.toFixed(2)}`;
}

// Função para remover um item
function removerItem(pratoId) {
    if (itensNoPedido[pratoId]) {
        delete itensNoPedido[pratoId];
        atualizarListaEtotal();
    }
}

// "Ouvinte" do botão de adicionar
btnAddPrato.addEventListener('click', adicionarPrato);

// "Ouvinte" para os botões de remover (usando delegação de evento)
containerItens.addEventListener('click', function(event) {
    if (event.target.classList.contains('btn-remover')) {
        const idParaRemover = event.target.getAttribute('data-id');
        removerItem(idParaRemover);
    }
});

</script>

<?php
include(__DIR__ . '/includes/footer.php');
?>