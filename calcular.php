<?php

include "funcoes.php";
if(isset($_POST['calcular']) == true){
	$inicio = filter_var($_POST['ano_inicio'] . "-" . $_POST['mes_inicio'] . "-" . $_POST['dia_inicio']);
	$fim = filter_var($_POST['ano_fim'] . "-" . $_POST['mes_fim'] . "-" . $_POST['dia_fim']);
	$id_turma = filter_var($_POST['turma']);
	
	$start_date = strtotime($inicio);
	$end_date = strtotime($fim);
	$start_date1 = new DateTime($inicio);
	$end_date1 = new DateTime($fim);
	$aulas = array();

	$con = connectar();
	$sql = $con->prepare("SELECT * FROM aulas WHERE id_turma = ?");
	$sql->bindParam(1, $id_turma);
	$sql->execute();
	while($row = $sql->fetch(PDO::FETCH_ASSOC)){
		array_push($aulas, $row['dia']);
	}

	
	$count = 0;
	$count1 = 0;
	$count2 = 0;
	$count3 = 0;
	$count4 = 0;
	$count_dias = count($aulas);
	$y = 0;
	//$z = round(($end_date - $start_date)/(60*60*24));
	//echo $start_date1->format('N');
	//exit();
	

		while($start_date1 <= $end_date1){
			
			if(in_array($start_date1->format('N'), $aulas)){
				if($start_date1->format('N') == 1){
					$count++;
				}
				elseif($start_date1->format('N') == 2){
					$count1++;
					
					//continue;
				}
				elseif($start_date1->format('N') == 3){
					$count2++;
					
					//continue;
				}
				elseif($start_date1->format('N') == 4){
					$count3++;
					
					//continue;
				}
				elseif($start_date1->format('N') == 5){
					$count4++;
					
					//continue;
				}
				$start_date1->modify('+1 day');

			}
			else{
				$start_date1->modify('+1 day');
			}

			
		}
		
	$sql_feriados = $con->prepare("SELECT * FROM feriados");
	$sql_feriados->execute();
	$feriados = array();

	while($row = $sql_feriados->fetch(PDO::FETCH_ASSOC)){
		array_push($feriados, new DateTime($row['ano_feriado'] . "-" . $row['mes_feriado'] . "-" . $row['dia_feriado']));
	}

	$t = 0;
	$conta_t = count($feriados);
	$start_date1 = new DateTime($inicio);
	while($start_date1 <= $end_date1){
		
		//echo strtotime($start_date1->format('Y-m-d'));
		//echo "<br>";
		if(in_array($start_date1, $feriados)){
			if($start_date1->format('N') == 1){
					if($count > 0){$count--;}
				}
				elseif($start_date1->format('N') == 2){
					if($count1 > 0){$count1--;}
					
					//continue;
				}
				elseif($start_date1->format('N') == 3){
					if($count2 > 0){$count2--;}
					
					//continue;
				}
				elseif($start_date1->format('N') == 4){
					if($count3 > 0){$count3--;}
					
					//continue;
				}
				elseif($start_date1->format('N') == 5){
					if($count4 > 0){$count4--;}
					
					//continue;
				}
		}
		$start_date1->modify('+1 day');
	}


	//echo $start_date;
	
	$sql_horas = $con->prepare("SELECT * FROM aulas");
	$sql_horas->execute();

	while($row = $sql_horas->fetch(PDO::FETCH_ASSOC)){
		$hora = $row['horas'];
		$dia = $row['dia'];
		if($dia == 1){
			$count = $count * $hora;
		}
		elseif($dia == 2){
			$count1 = $count1 * $hora;
		}
		elseif($dia == 3){
			$count2 = $count2 * $hora;
		}
		elseif($dia == 4){
			$count3 = $count3 * $hora;
		}
		elseif($dia == 5){
			$count4 = $count4 * $hora;
		}
	}
	//echo $count . "-" . $count1 . "-" . $count2 . "-" . $count3 . "-" . $count4;
	echo "Segunda-Feira: " . $count;
	echo "<br>";
	echo "Terça-Feira: " . $count1;
	echo "<br>";
	echo "Quarta-Feira: " . $count2;
	echo "<br>";
	echo "Quinta-Feira: " . $count3;
	echo "<br>";
	echo "Sexta-Feira: " . $count4;
	echo "<br>";
	echo "Total: " . $count + $count1 + $count2 + $count3 + $count4;
	echo "<br>";
	//print_r($days_to_count);
	exit();

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
	<form action="calcular.php" method="post">
		<div>
			<div>Periodo de tempo - Inicio</div>
			<div>
				<div>Dia</div>
				<select name="dia_inicio">
					<?php
						for ($i=1; $i < 32; $i++) { 
							echo "<option>" . $i . "</option>";
						}
					?>
				</select>
			</div>
			<div>
				<div>Mes</div>
				<select name="mes_inicio">
					<?php
						for ($i=1; $i < 13; $i++) { 
							echo "<option>" . $i . "</option>";
						}
					?>
				</select>
			</div>
			<div>
				<div>Ano</div>
				<select name="ano_inicio">
					<?php
						for ($i=23; $i < 25; $i++) { 
							echo "<option>" . $i . "</option>";
						}
					?>
				</select>
			</div>

			<div>Periodo de tempo - Fim</div>
			<div>
				<div>Dia</div>
				<select name="dia_fim">
					<?php
						for ($i=1; $i < 32; $i++) { 
							echo "<option>" . $i . "</option>";
						}
					?>
				</select>
			</div>
			<div>
				<div>Mes</div>
				<select name="mes_fim">
					<?php
						for ($i=1; $i < 13; $i++) { 
							echo "<option>" . $i . "</option>";
						}
					?>
				</select>
			</div>
			<div>
				<div>Ano</div>
				<select name="ano_fim">
					<?php
						for ($i=23; $i < 25; $i++) { 
							echo "<option>" . $i . "</option>";
						}
					?>
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
				<input type="submit" name="calcular">
			</div>
		</div>
	</form>

</body>
</html>