<?PHP 
	ob_start();

	include '../conect.php';
	include 'u_funcoes.php';


	session_start();
 
	if ( !isset($_SESSION['login'])) {
		session_destroy();
		unset ($_SESSION['login']);
		unset ($_SESSION['nome']);
		unset ($_SESSION["usu_cpf"]);
		header('location:login.php');
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema de Atendimento - DITI</title>
<!-- *************************************************************************************************************** -->
<!-- ***************************                   SCRIPTS                 ***************************************** -->
<!-- *************************************************************************************************************** -->
<?PHP include '@main_scripts.php';?>	
	

</head>

<body>

    <div id="wrapper">

<!-- *************************************************************************************************************** -->
<!-- ***************************                    MENUS                  ***************************************** -->
<!-- *************************************************************************************************************** -->
<?PHP include '@main_bar_nav.php';?>

<!-- *************************************************************************************************************** -->
<!-- ***************************                  CONTEUDO                 ***************************************** -->
<!-- *************************************************************************************************************** -->
<?php
	$LabelTKT = 'Computadores';
	$Mensagem='';
	$Imagem='';
	$NTKT='';
	if(isset($_REQUEST["numb"])){
				$LabelTKT = 'Computador n° ' . $_REQUEST["numb"];
				$Mensagem = "<br><br><br><a class='ref3'>" . $_REQUEST["numb"] . "</a>";
				$NTKT=$_REQUEST["numb"];
	}
	else{
				$LabelTKT = 'Computadores';
				$Mensagem='';			
	}									
?>
        <div id="page-wrapper">
			<div class="row">
			<BR>
            </div>

			<!-- *************************************************************************************************************** -->
			<!-- ***************************                   LINHA 1                 ***************************************** -->
			<!-- *************************************************************************************************************** -->
            <div class="row">
				<!-- *************************************************************************************************************** -->
				<!-- ***************************                 FORMULARIO                ***************************************** -->
				<!-- *************************************************************************************************************** -->
				<div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-edit fa-fw"></i> <?php echo $LabelTKT;?>
                            <div class="pull-right">
				<?PHP
	if ($NTKT<>''){
		$sql = "SELECT tb_unidade.unidade, tb_comput.id_comput, tb_comput.id_unidade, tb_comput.comput_name, tb_comput.comput_ip, tb_comput.datahora, tb_comput.online, tb_comput.online_datahora, tb_comput.online_mens
                FROM tb_unidade INNER JOIN tb_comput ON tb_unidade.id_unidade = tb_comput.id_unidade where (tb_comput.id_comput='". $NTKT."');";
		$rs_access=$connect->prepare($sql);
		if($rs_access->execute()){
			$resultados = $rs_access->rowCount();
			if($resultados>=1){
				if($registro_access= $rs_access->fetch(PDO::FETCH_OBJ)){

					if ($registro_access->online == 1) {$Imagem = '<img src="../img/on.jpg" height="26" width="78">';}
					else{$Imagem = '<img src="../img/off.jpg" height="26" width="78">';};


                    echo $Imagem; //$= <img src="../img/off.jpg" height="26" width="78">
                    echo '</div></div><div class="panel-body">';
					echo '<div class="form-group">';
		    			echo '<label>Computador ID: </label> ' . $registro_access->id_comput . '<br>';
		    			echo '<label>Computador NAME: </label> ' . $registro_access->comput_name . '<br>';
		    			echo '<label>Computador IP: </label> ' . $registro_access->comput_ip . '<br>';
		    			echo '<label>Unidade: </label> ' . $registro_access->id_unidade . ' - ' . $registro_access->unidade . '<br>';	
					echo '</div>';
				}
			}
		}
	}
	else{
                 echo '</div></div><div class="panel-body">';
//					echo '<div class="form-group">';
					echo '<div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Unidade</th>
                                            <th>Quantidade</th>
                                        </tr>
                                    </thead>
                                    <tbody>';



					$sql = "SELECT tb_unidade.id_unidade, tb_unidade.unidade, count(tb_comput.id_comput) as ntotcomp
										FROM tb_unidade INNER JOIN tb_comput ON tb_unidade.id_unidade = tb_comput.id_unidade
										GROUP BY tb_unidade.id_unidade, tb_unidade.unidade ORDER BY tb_unidade.id_unidade;";
								$rs_access=$connect->prepare($sql);
								if($rs_access->execute()){
								$resultados = $rs_access->rowCount();
									if($resultados>=1){
										
										
										while($registro_access= $rs_access->fetch(PDO::FETCH_OBJ)){ 
										
										
                                        echo '<tr><td>'.$registro_access->unidade.'</td><td>'.$registro_access->ntotcomp.'</td></tr>';
//											echo '<br><b>'.$registro_access->unidade.' - Quant. '.$registro_access->ntotcomp.'</b><br><br>';
										}
									}
								}	

								
                    echo '                </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>';
//					echo '</div>';		
	}

				?>			
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.col-lg-8 -->
<!-- *************************************************************************************************************** -->
<!-- ***************************            LISTA DE COMPUTADORES          ***************************************** -->
<!-- *************************************************************************************************************** -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-desktop fa-fw"></i> Computadores
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
								<?PHP
								$sql = "SELECT tb_unidade.id_unidade, tb_unidade.unidade, count(tb_comput.id_comput) as ntotcomp
										FROM tb_unidade INNER JOIN tb_comput ON tb_unidade.id_unidade = tb_comput.id_unidade
										GROUP BY tb_unidade.id_unidade, tb_unidade.unidade ORDER BY tb_unidade.id_unidade;";
								$rs_access=$connect->prepare($sql);
								if($rs_access->execute()){
								$resultados = $rs_access->rowCount();
									if($resultados>=1){
										while($registro_access= $rs_access->fetch(PDO::FETCH_OBJ)){ 
											echo '<br><b>'.$registro_access->unidade.' - Quant. '.$registro_access->ntotcomp.'</b><br><br>';
											
											$sql1 = "SELECT tb_comput.id_comput,tb_comput.comput_name FROM tb_comput WHERE tb_comput.id_unidade = '".$registro_access->id_unidade."';";
											$rs=$connect->prepare($sql1);
											if($rs->execute()){
											$resultados1 = $rs->rowCount();
												if($resultados1>=1){
													while($registro= $rs->fetch(PDO::FETCH_OBJ)){ 
														echo '<a href=?numb=' . $registro->id_comput . ' class="list-group-item">';
														echo $registro->comput_name . ' (' . $registro->id_comput.')</a>';
													}
												}
											}
										}
									}
								}	
								?>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
				</div>
                <!-- /.col-lg-4 -->
<!-- *************************************************************************************************************** -->
				
            </div>
            <!-- /.row -->			
        </div>
    </div>
    <!-- /#wrapper -->


</body>

</html>
<?
  ob_flush();
?> 