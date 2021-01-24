<?php
    include '../model/verificaSessao.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Painel de Cadastros</title>
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="../../css/bootstrap-theme.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body class="container">
    
    <section class="section">
        <p>Olá, 
            <?php
                echo $_SESSION['nome'];
            ?>
        </p>
        <button class="btn btn-primary" type="submit" id="logout" value="logout">Logout</button>
    </section>

    <h1 class="text-center">Cadastro de Pessoas</h1>
    
    <form class="form" id="form" method="POST">

        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="hidden" id="id-hide" name="id"><!--input tipo hidden para receber o id-->
            <input type="text" id="nome" name="nome" class="form-control" required autofocus/>        
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" class="form-control" required/>        
        </div>  
        
        <div class="form-group">
            <label for="cpf">CPF</label>
            <input type="text" id="cpf" name="cpf" class="form-control" required/>        
        </div>

        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="text" id="senha" name="senha" class="form-control" required/>        
        </div> 
        
        <div id='btn-area'>
          <button class="btn btn-primary" type="submit" id="cadastrar" value="cadastrar">Cadastrar</button>
        </div>
        
    </form>
    
    <br>
    <br>

    <table class="table table-hover table-bordered" id="action">
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>CPF</th>
                <th>Senha</th>
                <th>Ação</th>
            </tr>
        </thead>
        
        <tbody class="table-data">
            
        </tbody>
    </table>
    <script src="../../js/jquery.js"></script>
    <script src="../../js/script.js"></script>
</body>
    
</html>