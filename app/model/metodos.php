<?php
  include './conexao.php';

  //$opcao recebe valor referente ao metodo para ser chamado OK
  $opcao = $_POST['button'];

  //switch case de seleção do metodo passado em $opcao OK
  switch($opcao){
    case "entrar":
      login(); break;
    case "logout":
      logout(); break;  
    case "cadastrar":
      cadastrar(); break;
    case "atualizar":
      atualizar(); break;  
    case "excluir":
      excluir(); break;
    case "buscarTudo":
      buscarTudo(); break;
    case "editar":
      buscarUmRegistro(); break;

  }

  /*---------------------------------------------METODOS----------------------------------------------*/

  //função gravar OK!
  function gravar($nome, $email, $cpf, $senha){

    $connect = getConexao();

    $sql = 'INSERT INTO cadastros(nome, email, cpf, senha) VALUES(:nome, :email, :cpf, :senha)';
    
    $cmd = $connect->prepare($sql);
    $cmd->bindValue(":nome", $nome);
    $cmd->bindValue(":email", $email);
    $cmd->bindValue(":cpf", $cpf);
    $cmd->bindValue(":senha", $senha);
    
    if($cmd->execute()){
      echo "OK! ";
    } else {
      echo "Não foi possível salvar! ";
    }
  }

  //função Verifica OK!
  function verificaBancoDados($email){

    $connect = getConexao();

    $sql = 'SELECT id FROM cadastros WHERE email = :email';

    $cmd = $connect->prepare($sql);
    $cmd->bindValue(":email", $email);
    $cmd->execute();

    if($cmd->rowCount() > 0){ //verifica se retorna linha com email igual ao enviado pelo form.
      return true;
    } else {
      return false;
    }
  }

  //funcão cadastrar OK!
  function cadastrar(){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];
    
    if(verificaBancoDados($email)){
      echo "E-mail já cadastrado no sistema";
    } else {
      gravar($nome, $email, $cpf, $senha);
      echo "Salvo com Sucesso";
    }

  }
  
  //função buscar dados do banco e retornar em json. OK!
  function buscarTudo(){

    $connect = getConexao();
    
    $sql = 'SELECT * FROM cadastros ORDER BY nome';

    $cmd = $connect->prepare($sql);
    $cmd->execute();

    if($cmd->rowCount() >= 1){
      echo json_encode($cmd->fetchAll(PDO::FETCH_ASSOC));
    } else {
      echo json_encode("Nenhum dado encontado");
    }

  }

  //funçao excluir OK!
  function excluir(){

    $id = $_POST['id'];

    $connect = getConexao();

    $sql = 'DELETE FROM cadastros WHERE id = :id';

    $cmd = $connect->prepare($sql);

    $cmd->bindValue(":id", $id);

    if($cmd->execute()){
      echo "Registro excluido com sucesso!";
    } else {
      echo "Não foi possível excluir";
    }

  }

  //função buscar um registro OK!
  function buscarUmRegistro(){

    $id = $_POST['id'];

    $connect = getConexao();
    
    $sql = 'SELECT * FROM cadastros WHERE id = :id';

    $cmd = $connect->prepare($sql);
    $cmd->bindValue(":id", $id);
    $cmd->execute();

    echo json_encode($cmd->fetch(PDO::FETCH_ASSOC));

  }

  //funçao atualizar
  function atualizar(){

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];

    $connect = getConexao();

    $sql = 'UPDATE cadastros SET nome = :nome, email = :email, cpf = :cpf, senha = :senha WHERE id = :id';

    $cmd = $connect->prepare($sql);
    $cmd->bindValue(':nome', $nome);
    $cmd->bindValue(':email', $email);
    $cmd->bindValue(':cpf', $cpf);
    $cmd->bindValue(':senha', $senha);
    $cmd->bindValue(':id', $id);
    $cmd->execute();

    echo "Atualizado com Sucesso!";
  }

//--------------------------------------------------------- metodos de autenticação ---------------------------------

  //funcão login verifica o retorno da autenticacão e abre uma session para o usuario .
  function login(){
    
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    $connect = getConexao();

    $sql = 'SELECT * FROM adm_usuarios WHERE email = :email AND senha = :senha';

    $cmd = $connect->prepare($sql);
    $cmd->bindValue(':email', $email);
    $cmd->bindValue(':senha', $senha);
    $cmd->execute();
    $resultado = $cmd->fetch(PDO::FETCH_ASSOC);

    if($cmd->rowCount() == 0){

      echo json_encode ($resultado); //retorna falso quando não encontra registro

    } else {
      
      if(!isset($_SESSION)){
        session_start();		
        //Abrindo seções
		    $_SESSION['nome']=$resultado['nome']; 		
        $_SESSION['email']=$resultado['email'];
        echo json_encode($_SESSION);
        exit;
      }     
      
    }
  }

  //fecha a sessão OK!
  function logout(){
    session_start();
    
    if(isset($_SESSION)){
      
      session_destroy();
      echo 0;

    }
  }
?>