<?php
include "funcoes.php";
if(isset($_POST['inserir_aula']) == true){
	$dia_aula = filter_var($_POST['dia_aula']);
	$horas = filter_var($_POST['horas']);
	$id_turma = filter_var($_POST['turma']);

	$con = connectar();

	$sql = $con->prepare("INSERT INTO aulas (dia, horas, id_turma) VALUES (?,?,?)");
	$sql->bindParam(1, $dia_aula);
	$sql->bindParam(2, $horas);
	$sql->bindParam(3, $id_turma);
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
	<form action="index.php" method="post">
		<div>
			<div>Selecionar aulas</div>
			<div>
				<div>Dia</div>
				<select name="dia_aula">
					<option value="1">Segunda-Feira</option>
					<option value="2">Terça-Feira</option>
					<option value="3">Quarta-Feira</option>
					<option value="4">Quinta-Feira</option>
					<option value="5">Sexta-Feira</option>
				</select>
			</div>			
			<div>Horas</div>
			<div>
				<select name="horas">
					<option>1</option>
					<option>2</option>
				</select>
			</div>
			<div>Turma</div>
			<div>
				<select name="turma">
					<?php
					$con = connectar();
					$get_turmas = $con->prepare("SELECT * FROM turmas");
					$get_turmas->execute();
					while($row_turma = $get_turmas->fetch(PDO::FETCH_ASSOC)){
					
					
					?>
					<option value="<?php echo $row_turma['id_turmas']; ?>"><?php echo $row_turma['ano_turma'] . "º " . $row_turma['letra_turma']; ?></option>
					<?php
					}
					?>
				</select>
			</div>
			<div>
				<input type="submit" name="inserir_aula">
			</div>
		</div>
	</form>

</body>
</html>