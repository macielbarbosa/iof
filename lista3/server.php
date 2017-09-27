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
		$conexao;
		conectar('localhost','id1996929_macielbarbosa','mbs1994','id1996929_iot_db');
		login($_POST['login'],$_POST['senha']);
        
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
			global $conexao;
        	$consulta = "SELECT nome, sobrenome FROM usuarios WHERE usuario='".$usuario."' AND senha='".$senha."'";
			$resultado = $conexao->query($consulta);
			if($resultado->num_rows > 0){
				while ($linha = $resultado->fetch_assoc()) {
				    echo "<h3>Seja bem vindo ".$linha['nome']." ".$linha['sobrenome']."<h3>";
				}
			}
			else{
				echo "Usuário ou senha incorreta";
			}
			$conexao->close();
		}
	 ?>
</body>
</html>