<?php
if(isset($_GET['pag']) == true){
	$num = filter_var($_GET['pag']);
	$pagina = paginas($num);
}
else{
	$pagina = "Inicio";
}
?>
<div>Calculo de número de Aulas</div>
<div><?php echo $pagina;?></div>
<div><a href="index.php">Inicio</a></div>
<div><a href="feriados.php?pag=2">Inserir feriados</a></div>
<div><a href="calcular.php?pag=3">Calcular</a></div>
<div><a href="turmas.php?pag=4">Turmas</a></div>