<?php

function connectar(){

	try{
		$host1 = "localhost";
		$data1 = "dias_aulasv2";
		$user1 = "root";
		$pass1 = "";

		$con = new PDO("mysql:host=" . $host1 . ";dbname=" . $data1 . ";charset=utf8", $user1, $pass1);
		return $con;
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
}

function paginas($num){
	if($num == 1){
		$pagina = "Inicio";
	}
	elseif($num == 2){
		$pagina = "Feriados";
	}
	elseif($num == 3){
		$pagina = "Calcular";
	}
	elseif($num == 4){
		$pagina = "Turmas";
	}
	else{
		$pagina = "Inicio";
	}

	return $pagina;
}