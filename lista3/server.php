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
		echo "Atenção! Seu login é: ";
		if ($_SERVER["REQUEST_METHOD"] == "GET") 
			echo $_GET['login'];
    	else
        	echo $_POST['login'];
	 ?>
</body>
</html>