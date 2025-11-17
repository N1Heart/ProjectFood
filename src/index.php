<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SplashPage 1.0</title>
   <link rel="stylesheet" href=".\styles.css">
</head>
<body>
<?php

?>
        <header>

            <h1>Project Food</h1>
          
            
        </header>

    <main>
        <section class="hero">
            <h1>Bem-vindo!</h1>

         <div class="conteiner-botoes"> 
    <div class="grupo-botao">
        <label for="cadastropg" class="tag">Ainda não é cliente?</label>
        <a href="register.php" id="cadastropg" class="btn">Cadastre-se</a>
    </div>
    <div class="grupo-botao">
        <label for="loginpg" class="tag">Já é cliente?</label>
        <a href="login.php" id="loginpg" class="btn">Login</a>
    </div>
   
</div>
<br>
<a href="cardapio.php" class="btn">Veja nosso cardapio</a>
</div>
        </div>
    </section>
        <section class="textroda">
            <h2>Sobre Nós</h2>
            <p>Academicos da turma Eng. de Software 2023: Matheus de Farias, Enzo Rafael, Vitor Nascimento e Enio Lopes</p>
        </section>
    </main>
    
<?php 
include("includes/footer.php");
?>

 
</body>
</html>
