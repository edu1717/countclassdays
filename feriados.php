<?php

include "funcoes.php";
if(isset($_POST['inserir_feriado']) == true){
	$dia_feriado = filter_var($_POST['dia_feriado']);
	$mes_feriado = filter_var($_POST['mes_feriado']);
	$ano_feriado = filter_var($_POST['ano_feriado']);


	$con = connectar();

	$sql = $con->prepare("INSERT INTO feriados (dia_feriado, mes_feriado, ano_feriado) VALUES (?,?,?)");
	$sql->bindParam(1, $dia_feriado);
	$sql->bindParam(2, $mes_feriado);
	$sql->bindParam(3, $ano_feriado);
	$sql->execute();

	if($sql->rowCount() == 1){
		echo "<script>alert('inserido com sucesso'); document.location = 'index.php';</script>";
	}
	else{
		echo "<script>alert('Erro'); document.location = 'index.php';</script>";
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
	<form action="feriados.php" method="post">
		<div>
			<div>Selecionar feriados</div>
			<div>
				<div>Dia</div>
				<select name="dia_feriado">
					<?php
						for ($i=1; $i < 31; $i++) { 
							echo "<option>" . $i . "</option>";
						}
					?>
				</select>
			</div>

			<div>
				<div>Mes</div>
				<select name="mes_feriado">
					<?php
						for ($i=1; $i < 13; $i++) { 
							echo "<option>" . $i . "</option>";
						}
					?>
				</select>
			</div>

			<div>
				<div>Ano</div>
				<select name="ano_feriado">
					<?php
						for ($i=23; $i < 25; $i++) { 
							echo "<option>" . $i . "</option>";
						}
					?>
				</select>
			</div>
			
			<div>
				<input type="submit" name="inserir_feriado">
			</div>
		</div>
	</form>

</body>
</html>