<?php

include '../Config/Conexao.php';

$acao = $_REQUEST['acao'];
$return = array();

if($acao === "Consultar"){
    $sql = "SELECT * FROM alunos";
    $resultado = $conn->query($sql);

    if ($resultado) {
        while ($data = $resultado->fetch_assoc()) {
            $return = array(
                "nome"      => $data['nome'],
                "email"     => $data['email'],
                "telefone"  => $data['telefone']
            );
        }
    }
}

if($acao === "Inserir"){
    $sql = "INSERT INTO alunos (nome, email, telefone) VALUES ('Vinicius', 'vinicius.dantas.336@gmail.com', '11 9 4258-7920')";
    $resultado = $conn->query($sql);

    if($resultado != TRUE){
        echo "falha.";
    }else{
        echo "Passou.";
    }
}

echo json_encode($return);
?>


