<?php
  function getConexao(){
    //conexao banco de dados retorna $pdo
    $dsn = 'mysql:host=localhost;dbname=crud_bd;charset=utf8';
    $usuario = 'root';
    $senha = '';

    try{
      $pdo = new PDO($dsn, $usuario, $senha);
      return $pdo;
    } catch(PDOException $e) {
      echo "Erro com banco de dados: " . $e->getMessage();
      exit();
    } catch(Exception $e){
      echo "Erro Generico: " . $e->getMessage();
      exit();
    }
  }