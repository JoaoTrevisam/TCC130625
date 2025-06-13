<?php

include("../Classe/Conexao.php");

$nome = isset($_POST["nome"]) ? $_POST["nome"] : NULL;
$tipo_exercicio = isset($_POST["exercicio"]) ? $_POST["exercicio"] : NULL;
$grupo_muscular = isset($_POST["grupo"]) ? $_POST["grupo"] : NULL;


$sql = ("INSERT INTO `exercicio` 
    (
        `nome`, 
        `tipo_exercicio`, 
        `grupo_muscular`
    ) 
    VALUES 
    (
        :nome,
        :tipo_exercicio,
        :grupo_muscular
)");

$executar = Db::conexao()->prepare($sql);

$executar->bindValue(":nome", $nome, PDO::PARAM_STR);
$executar->bindValue(":tipo_exercicio", $tipo_exercicio, PDO::PARAM_STR);
$executar->bindValue(":grupo_muscular", $grupo_muscular, PDO::PARAM_STR);

$executar->execute();

header("Location: index.php");