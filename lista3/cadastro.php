<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cadastro</title>
</head>
<body align='middle'>
	<br><br><br>
	<?php 
		$conexao;
		conectar('localhost','id1996929_macielbarbosa','mbs1994','id1996929_iot_db');
		cadastro($_POST['usuario'],$_POST['nome'],$_POST['sobrenome'],$_POST['senha'],$_POST['cpf'],$_POST['idade']);
        
        function conectar($servidor,$usuario,$senha,$banco){
        	global $conexao;
        	$conexao = new mysqli($servidor, $usuario, $senha, $banco);
			if ($conexao->connect_error){
			    die ('Nao conectado. Erro: ' . $conn->connect_error);
			}
			else{
				echo "Conectado com sucesso<br><br><br><br>";
			}
        }

        function cadastro($usuario,$nome,$sobrenome,$senha,$cpf,$idade){
			global $conexao;
        	$inserir = "INSERT INTO usuarios (usuario, nome, sobrenome, senha, cpf, idade) VALUES ('".$usuario."', '".$nome."', '".$sobrenome."', '".$senha."', '".$cpf."', ".$idade.")";
			if ($conexao->query($inserir) === TRUE) {
			    echo "Cadastro realizado com sucesso";
			} else {
			    echo "Error: " . $inserir . "<br>" . $conexao->error;
			}
			$conexao->close();
		}
	 ?>
	 <br><br>
	 <a href="login.html">Retornar para o login</a>
</body>
</html>