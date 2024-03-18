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

if ($acao === "Inserir") {
    $user = json_decode(file_get_contents('php://input'));

    // verifica se nome, email e telefone existem no objeto $user
    if (isset($user->nome) && isset($user->email) && isset($user->telefone)) {
        $nome = $user->nome;
        $email = $user->email;
        $telefone = $user->telefone;

        $sql = "INSERT INTO alunos (nome, email, telefone) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('sss', $nome, $email, $telefone);

            $resultado = $stmt->execute();

            if ($resultado) {
                $return = array("mensagem" => "Inserção realizada com sucesso.");
            } else {
                $return = array("erro" => "Falha ao inserir dados: " . $stmt->error);
            }
            $stmt->close();
        } else {
            $return = array("erro" => "Falha ao preparar a consulta.");
        }
    } else {
        $return = array("erro" => "Parâmetros nome, email e telefone não foram fornecidos corretamente.");
    }
}



if($acao === "Deletar"){
    $sql = "DELETE FROM alunos WHERE id = 1";
    $resultado = $conn->query($sql);

    if($resultado != TRUE){
        echo "falha.";
    }else{
        echo "Passou.";
    }
}

if($acao === "Atualizar"){
    $sql = "UPDATE alunos SET nome='Caue' WHERE id=2";
    $resultado = $conn->query($sql);

    if($resultado != TRUE){
        echo "Falha.";
    }else{
        echo "Passou.";
    }
}

echo json_encode($return);
?>


