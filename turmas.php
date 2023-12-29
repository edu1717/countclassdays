<?php

include "funcoes.php";
if(isset($_POST['inserir_turma']) == true){
	$ano_turma = filter_var($_POST['ano_turma']);
	$letra_turma = filter_var($_POST['letra_turma']);


	$con = connectar();

	$sql = $con->prepare("INSERT INTO turmas (ano_turma, letra_turma) VALUES (?,?)");
	$sql->bindParam(1, $ano_turma);
	$sql->bindParam(2, $letra_turma);
	$sql->execute();

	if($sql->rowCount() == 1){
		echo "<script>alert('inserido com sucesso'); document.location = 'turmas.php';</script>";
	}
	else{
		echo "<script>alert('Erro'); document.location = 'turmas.php';</script>";
	}

}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<?php include "links.php";?>
	<form action="turmas.php" method="post">
		<div>
			<div>Inserir Turmas</div>
			<div>Ano</div>
			<div>
				<select name="ano_turma">
					<?php
						for ($i=7; $i < 10; $i++) { 
							echo "<option>" . $i . "</option>";
						}
					?>
				</select>
			</div>
			<div>Letra</div>
			<div>
				<select name="letra_turma">
					<option>A</option>
					<option>B</option>
					<option>C</option>
					<option>D</option>
					<option>E</option>
					<option>F</option>
					<option>G</option>			
				</select>
			</div>
			<div>
				<input type="submit" name="inserir_turma">
			</div>
		</div>
	</form>

</body>
</html>