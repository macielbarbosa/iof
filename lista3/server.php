<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Server PHP</title>
</head>
<body align='middle'>
	<br><br>
	<h2>Seus dados foram validados com sucesso!</h2>
	<br>
	<?php
		$conexao; $nome; $sobrenome; $cpf; $idade; $logado=false;
		$usuario = $_POST['login'];
		$senha = $_POST['senha'];
		
		conectar('localhost','id1996929_macielbarbosa','mbs1994','id1996929_iot_db');
		login($usuario,$senha);
		if($logado==true)
			mostrarDados($nome,$sobrenome,$cpf,$idade);

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

        function login($usuario,$senha){
			global $conexao, $nome, $sobrenome, $cpf, $idade, $logado;
        	$consulta = "SELECT nome, sobrenome, cpf, idade FROM usuarios WHERE usuario='".$usuario."' AND senha='".$senha."'";
			$resultado = $conexao->query($consulta);
			if($resultado->num_rows > 0){
				$logado = true;
				while ($linha = $resultado->fetch_assoc()) {
				    echo "<h3>Seja bem vindo ".$linha['nome']." ".$linha['sobrenome']."</h3>";
				    $nome = $linha['nome'];
				    $sobrenome = $linha['sobrenome'];
				    $cpf = $linha['cpf'];
				    $idade = $linha['idade'];
				}
			}
			else{
				echo "Usuário ou senha incorreta";
			}
			$conexao->close();
		}

		function mostrarDados($nome,$sobrenome,$cpf,$idade){
			echo "<br><br>Nome: ".$nome;
			echo "<br><br>Sobrenome: ".$sobrenome;
			echo "<br><br>CPF: ".$cpf;
			echo "<br><br>Idade: ".$idade;
		}
	 ?>
</body>
</html>